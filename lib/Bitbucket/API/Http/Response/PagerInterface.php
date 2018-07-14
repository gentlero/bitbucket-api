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

use Psr\Http\Message\ResponseInterface;

/**
 * @author Alexandru Guzinschi <alex@gentle.ro>
 */
interface PagerInterface
{
    /**
     * @access public
     * @return bool
     */
    public function hasNext();

    /**
     * @access public
     * @return bool
     */
    public function hasPrevious();

    /**
     * Fetch next page and return http response
     *
     * @access public
     * @return ResponseInterface|null
     */
    public function fetchNext();

    /**
     * Fetch previous page and return http response
     *
     * @access public
     * @return ResponseInterface|null
     */
    public function fetchPrevious();

    /**
     * Fetch all available pages.
     *
     * @access public
     * @return ResponseInterface
     */
    public function fetchAll();

    /**
     * Get current http response.
     *
     * @access public
     * @return ResponseInterface
     */
    public function getCurrent();
}
