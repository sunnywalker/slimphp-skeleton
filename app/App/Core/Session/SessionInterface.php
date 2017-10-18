<?php
namespace App\Core\Session;

/**
 * Session key/value manager interface.
 *
 * @package App\Core\Session
 */
interface SessionInterface
{
    /**
     * Get a session value.
     *
     * @param string $key
     * @return mixed
     */
    public function get($key);

    /**
     * Set a session value.
     *
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value);

    /**
     * Unset a session key.
     *
     * @param string $key
     */
    public function unset($key);
}
