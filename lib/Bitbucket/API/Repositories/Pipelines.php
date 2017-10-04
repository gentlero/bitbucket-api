<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Repositories;

use Bitbucket\API\Api;
use Buzz\Message\MessageInterface;

/**
 * Manage the pipelines of a repository
 *
 * @author Marco Veenendaal    <marco@deinternetjongens.nl>
 */
class Pipelines extends Api
{
    /**
     * Get the information associated with a repository's pipelines
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @return MessageInterface
     */
    public function all($account, $repo)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/pipelines/', $account, $repo)
        );
    }

    /**
     * Creates a pipeline for the specified repository.
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  array|string     $params  Additional parameters as array or JSON string
     * @return MessageInterface
     */
    public function create($account, $repo, $params = array())
    {
        // allow developer to directly specify params as json if (s)he wants.
        if ('array' !== gettype($params)) {
            if (empty($params)) {
                throw new \InvalidArgumentException('Invalid JSON provided.');
            }

            $params = $this->decodeJSON($params);
        }

        return $this->getClient()->setApiVersion('2.0')->post(
            sprintf('repositories/%s/%s/pipelines/', $account, $repo),
            json_encode($params),
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * Get a specific pipeline
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  string           $uuid    The pipeline's identifier.
     * @return MessageInterface
     */
    public function get($account, $repo, $uuid)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/pipelines/%s', $account, $repo, $uuid)
        );
    }

    /**
     * Stop a specific pipeline
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  string           $uuid    The pipeline's identifier.
     * @return MessageInterface
     */
    public function stopPipeline($account, $repo, $uuid)
    {
        return $this->getClient()->setApiVersion('2.0')->post(
            sprintf('repositories/%s/%s/pipelines/%s/stopPipeline', $account, $repo, $uuid)
        );
    }

    /**
     * Get steps
     *
     * @access public
     * @return Pipelines\Steps
     *
     * @throws \InvalidArgumentException
     * @codeCoverageIgnore
     */
    public function steps()
    {
        return $this->api('Repositories\\Pipelines\\Steps');
    }
}
