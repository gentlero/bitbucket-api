<?php
/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bitbucket\API\Http\Listener;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Helper for `Pager`
 *
 * Inserts pagination metadata (_as is expected by `Pager`_),
 * in any response coming from v1 of the API which contains
 * a collection.
 *
 * @author Alexandru Guzinschi <alex@gentle.ro>
 */
class ApiOneCollectionListener implements ListenerInterface
{
    /** @var array */
    private $urlComponents;

    /** @var string */
    private $resource;

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'api_one_collection';
    }

    /**
     * {@inheritDoc}
     * @codeCoverageIgnore
     */
    public function preSend(RequestInterface $request)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function postSend(RequestInterface $request, ResponseInterface $response)
    {
        if ($this->isLegacyApiVersion($request)) {
            $this->parseRequest($request);

            if ($this->canPaginate($response)) {
                $content = $this->insertPaginationMeta(
                    $this->getContent($response),
                    $this->getPaginationMeta($response)
                );

                $response->setContent(json_encode($content));
            }
        }
    }

    /**
     * @access public
     * @param  RequestInterface $request
     * @return bool
     */
    private function isLegacyApiVersion(RequestInterface $request)
    {
        /** @var RequestInterface $request */
        return strpos($request->getResource(), '/1.0/') !== false;
    }

    /**
     * @access public
     * @param  RequestInterface $request
     * @return void
     */
    private function parseRequest(RequestInterface $request)
    {
        if ($request->getUri()->getQuery()) {
            parse_str($this->urlComponents['query'], $this->urlComponents['query']);
        } else {
            $this->urlComponents['query'] = [];
        }

        $this->urlComponents['query']['start'] = array_key_exists('start', $this->urlComponents['query']) ?
            (int)$this->urlComponents['query']['start'] :
            0
        ;
        $this->urlComponents['query']['limit'] = array_key_exists('limit', $this->urlComponents['query']) ?
            (int)$this->urlComponents['query']['limit'] :
            15
        ;

        $pcs = explode('/', $this->urlComponents['path']);
        $this->resource = strtolower(array_pop($pcs));
    }

    /**
     * @access public
     * @param  ResponseInterface $response
     * @return bool
     */
    private function canPaginate(ResponseInterface $response)
    {
        $content = $this->getContent($response);
        return array_key_exists('count', $content) && array_key_exists($this->resource, $content);
    }

    /**
     * @access private
     * @param  ResponseInterface $response
     * @return array
     */
    private function getContent(ResponseInterface $response)
    {
        $content = json_decode($response->getBody()->getContents(), true);

        if (is_array($content) && JSON_ERROR_NONE === json_last_error()) {
            return $content;
        }

        return [];
    }

    /**
     * @access private
     * @param  array $content
     * @param  array $pagination
     * @return array
     */
    private function insertPaginationMeta(array $content, array $pagination)
    {
        // This is just a reference because duplicate data in response could create confusion between some users.
        $content['values']  = '.'.$this->resource;
        $content['size']    = $content['count'];
        $parts              = $this->urlComponents;

        // insert pagination links only if everything does not fit in a single page
        if ($content['count'] > count($content[$this->resource])) {
            if ($pagination['page'] > 1 || $pagination['page'] === $pagination['pages']) {
                $query = $parts['query'];
                $query['start'] -= $parts['query']['limit'];

                $content['previous'] = sprintf(
                    '%s://%s%s?%s',
                    $parts['scheme'],
                    $parts['host'],
                    $parts['path'],
                    http_build_query($query)
                );
            }

            if ($pagination['page'] < $pagination['pages']) {
                $query = $parts['query'];
                $query['start'] += $parts['query']['limit'];

                $content['next'] = sprintf(
                    '%s://%s%s?%s',
                    $parts['scheme'],
                    $parts['host'],
                    $parts['path'],
                    http_build_query($query)
                );
            }
        }

        return $content;
    }

    /**
     * @access private
     * @param  ResponseInterface $response
     * @return array
     */
    private function getPaginationMeta(ResponseInterface $response)
    {
        $meta = [];

        $content        = $this->getContent($response);
        $meta['total']  = $content['count'];
        $meta['pages']  = (int)ceil($meta['total'] / $this->urlComponents['query']['limit']);
        $meta['page']   = ($this->urlComponents['query']['start']/$this->urlComponents['query']['limit']) === 0 ?
            1 :
            ($this->urlComponents['query']['start']/$this->urlComponents['query']['limit'])+1
        ;

        if ($meta['page'] > $meta['pages']) {
            $meta['page'] = $meta['pages'];
        }

        return $meta;
    }
}
