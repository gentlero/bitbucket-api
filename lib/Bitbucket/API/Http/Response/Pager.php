<?php
/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bitbucket\API\Http\Response;

use Bitbucket\API\Http\ClientInterface;
use Buzz\Message\MessageInterface;
use Buzz\Message\Response;

/**
 * @author Alexandru Guzinschi <alex@gentle.ro>
 */
class Pager implements PagerInterface
{
    /** @var ClientInterface */
    private $httpClient;

    /** @var MessageInterface */
    private $response;

    /**
     * @param ClientInterface  $httpClient
     * @param MessageInterface $response
     *
     * @throws \UnexpectedValueException
     */
    public function __construct(ClientInterface $httpClient, MessageInterface $response)
    {
        /** @var Response $response */
        if (!$response->isOk()) {
            throw new \UnexpectedValueException("Can't paginate an unsuccessful response.");
        }

        $this->httpClient = $httpClient;
        $this->response = $response;
    }

    /**
     * {@inheritDoc}
     */
    public function hasNext()
    {
        return array_key_exists('next', $this->getContent());
    }

    /**
     * {@inheritDoc}
     */
    public function hasPrevious()
    {
        return array_key_exists('previous', $this->getContent());
    }

    /**
     * {@inheritDoc}
     */
    public function fetchNext()
    {
        if ($this->hasNext()) {
            $content = $this->getContent();
            return $this->response = $this->httpClient->get($content['next']);
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function fetchPrevious()
    {
        if ($this->hasPrevious()) {
            $content = $this->getContent();
            return $this->response = $this->httpClient->get($content['previous']);
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function fetchAll()
    {
        $content = $this->getContent();
        $values = [];

        // merge all `values` and replace it inside the most recent response.
        while (true) {
            if (!array_key_exists('values', $content)) {
                break;
            }

            $values = (0 === count($values)) ? $content['values'] : array_merge($values, $content['values']);

            if (null !== ($next = $this->fetchNext())) {
                $content = $this->getContent();
                continue;
            }

            break;
        }

        $content['values'] = $values;
        $this->response->setContent(json_encode($content));

        return $this->response;
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrent()
    {
        return $this->response;
    }

    /**
     * @access private
     * @return array
     */
    private function getContent()
    {
        $content = json_decode($this->response->getContent(), true);

        if (is_array($content) && JSON_ERROR_NONE === json_last_error()) {
            // replace reference inserted by `LegacyCollectionListener` with actual data.
            if (array_key_exists('values', $content) &&
                is_string($content['values']) &&
                strpos($content['values'], '.') !== false) {
                $content['values'] = $content[str_replace('.', '', $content['values'])];
            }
            return $content;
        }

        return [];
    }
}
