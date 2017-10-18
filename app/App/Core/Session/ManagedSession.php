<?php
namespace App\Core\Session;

/**
 * Managed session key/value manager.
 *
 * @package App\Core\Session
 */
class ManagedSession extends Session
{
    /**
     * Managed keys.
     *
     * @var array
     */
    protected $keys = [];

    /**
     * Get a session value.
     *
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return array_key_exists($key, $this->keys)
            ? parent::get($key)
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
        parent::set($key, $value);
        $this->keys[$key] = 0;
    }

    /**
     * Unset a session key.
     *
     * @param string $key
     */
    public function unset($key)
    {
        parent::unset($key);
        unset($this->keys[$key]);
    }

    /**
     * Purge all known keys via {@see unset()}.
     */
    public function purge()
    {
        foreach (array_keys($this->keys) as $key) {
            $this->unset($key);
        }
    }
}
