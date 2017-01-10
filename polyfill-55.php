<?php
/**
 * Copyright 2015 - 2016 Alexandru Guzinschi <alex@gentle.ro>
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

/**
 * Provides functions unavailable in PHP releases prior to v5.5
 */
if (PHP_VERSION_ID < 50500) {
    if (!function_exists('json_last_error_msg')) {
        function json_last_error_msg()
        {
            switch (json_last_error()) {
                case JSON_ERROR_NONE:
                    return 'No error';
                case JSON_ERROR_DEPTH:
                    return 'Maximum stack depth exceeded';
                case JSON_ERROR_STATE_MISMATCH:
                    return 'State mismatch (invalid or malformed JSON)';
                case JSON_ERROR_CTRL_CHAR:
                    return 'Control character error, possibly incorrectly encoded';
                case JSON_ERROR_SYNTAX:
                    return 'Syntax error';
                case JSON_ERROR_UTF8:
                    return 'Malformed UTF-8 characters, possibly incorrectly encoded';
                default:
                    return 'Unknown error';
            }
        }
    }
}
