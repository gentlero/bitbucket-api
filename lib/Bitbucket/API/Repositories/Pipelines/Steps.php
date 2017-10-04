<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Repositories\Pipelines;

use Bitbucket\API;
use Buzz\Message\MessageInterface;

/**
 * Manage the steps of a pipeline.
 *
 * @author Marco Veenendaal    <marco@deinternetjongens.nl>
 */
class Steps extends API\Api
{
    /**
     * Get a list of all pipeline steps
     *
     * @access public
     * @param  string           $account         The team or individual account owning the repository.
     * @param  string           $repo            The repository identifier.
     * @param  string           $pipelineUuid    UUID of the pipeline.
     * @return MessageInterface
     */
    public function all($account, $repo, $pipelineUuid)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/pipelines/%s/steps/', $account, $repo, $pipelineUuid)
        );
    }

    /**
     * Get an individual pipeline step
     *
     * @access public
     * @param  string           $account        The team or individual account owning the repository.
     * @param  string           $repo           The repository identifier.
     * @param  string           $pipelineUuid   UUID of the pipeline.
     * @param  string           $stepUuid       UUID of the step.
     * @return MessageInterface
     */
    public function get($account, $repo, $pipelineUuid, $stepUuid)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/pipelines/%s/steps/%s', $account, $repo, $pipelineUuid, $stepUuid)
        );
    }

    /**
     * Get the log of an individual pipeline step
     *
     * @access public
     * @param  string           $account        The team or individual account owning the repository.
     * @param  string           $repo           The repository identifier.
     * @param  string           $pipelineUuid   UUID of the pipeline.
     * @param  string           $stepUuid       UUID of the step.
     * @return MessageInterface
     */
    public function log($account, $repo, $pipelineUuid, $stepUuid)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/pipelines/%s/steps/%s/log', $account, $repo, $pipelineUuid, $stepUuid)
        );
    }
}
