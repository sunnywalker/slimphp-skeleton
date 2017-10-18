<?php
namespace App\Core\Session;

/**
 * Session key/value manager.
 *
 * @package App\Core\Session
 */
class Session implements SessionInterface
{
    /**
     * @var string
     */
    public $prefix = '';

    /**
     * Get a session value.
     *
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return array_key_exists($this->prefix.$key, $_SESSION)
            ? $_SESSION[$this->prefix.$key]
            : null;
    }

    /**
     * Set a session value.
     *
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value)
    {
        $_SESSION[$this->prefix.$key] = $value;
    }

    /**
     * Unset a session key.
     *
     * @param string $key
     */
    public function unset($key)
    {
        unset($_SESSION[$this->prefix.$key]);
    }
}
