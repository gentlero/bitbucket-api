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

use Bitbucket\API\Http\HttpPluginClientBuilder;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\MessageFactory;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Alexandru Guzinschi <alex@gentle.ro>
 */
class Pager implements PagerInterface
{
    /** @var HttpPluginClientBuilder */
    private $httpPluginClientBuilder;
    /** @var MessageFactory */
    private $messageFactory;
    /** @var ResponseInterface */
    private $response;

    /**
     * @param HttpPluginClientBuilder $httpPluginClientBuilder
     * @param ResponseInterface $response
     * @param MessageFactory $messageFactory
     *
     * @throws \UnexpectedValueException
     */
    public function __construct(
        HttpPluginClientBuilder $httpPluginClientBuilder,
        ResponseInterface $response,
        MessageFactory $messageFactory = null
    ) {
        /** @var ResponseInterface $response */
        if ($response->getStatusCode() >= 400) {
            throw new \UnexpectedValueException("Can't paginate an unsuccessful response.");
        }

        $this->httpPluginClientBuilder = $httpPluginClientBuilder;
        $this->response = $response;
        $this->messageFactory = $messageFactory ? : MessageFactoryDiscovery::find();
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
            return $this->response = $this->httpPluginClientBuilder->getHttpClient()->get($content['next']);
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
            return $this->response = $this->httpPluginClientBuilder->getHttpClient()->get($content['previous']);
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

            if (null !== $this->fetchNext()) {
                $content = $this->getContent();
                continue;
            }

            break;
        }

        $content['values'] = $values;
        $this->response = $this->messageFactory->createResponse(
            $this->response->getStatusCode(),
            $this->response->getReasonPhrase(),
            $this->response->getHeaders(),
            json_encode($content),
            $this->response->getProtocolVersion()
        );

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
        $content = json_decode($this->response->getBody()->getContents(), true);

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
