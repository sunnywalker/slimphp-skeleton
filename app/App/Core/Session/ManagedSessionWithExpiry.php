<?php
namespace App\Core\Session;

/**
 * Session key/value manager with expiring keys.
 *
 * @package App\Core\Session
 */
class ManagedSessionWithExpiry extends ManagedSession
{
    /**
     * Get a session value.
     *
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        $this->sweep($key);
        return parent::get($key);
    }

    /**
     * Set a session value.
     *
     * @param string $key
     * @param mixed  $value
     * @param int    $expires Expiry in seconds from now or 0 for never
     */
    public function set($key, $value, $expires = 0)
    {
        parent::set($key, $value);
        if ($expires) {
            $this->expires($key, $expires);
        }
    }

    /**
     * Immediately expire a key.
     *
     * @param string $key
     */
    public function expire($key)
    {
        $this->unset($key);
    }

    /**
     * (Re-)set the expiry for a key if it exists.
     *
     * @param string $key
     * @param int    $expires Expiry in seconds from now or 0 for never
     */
    public function expires($key, $expires)
    {
        if (array_key_exists($key, $this->keys)) {
            $this->keys[$key] = time() + $expires;
        }
    }

    /**
     * Get the time to live for a key, 0 for never, or
     * false if expired or it doesn't exist.
     *
     * @param $key
     * @return int|false
     */
    public function ttl($key)
    {
        $this->sweep($key);
        if (array_key_exists($key, $this->keys)) {
            if ($this->keys[$key] === 0) {
                // never expires
                return 0;
            }
            return $this->keys[$key] - time();
        }
        return false;
    }

    /**
     * Sweep key if expired or all expired keys.
     *
     * @param string $key
     */
    public function sweep($key = null)
    {
        if ($key && array_key_exists($key, $this->keys)) {
            if ($expiry = $this->keys[$key]) {
                if ($expiry < time()) {
                    $this->unset($key);
                }
            }
        } else {
            foreach ($this->keys as $key => $expiry) {
                if ($expiry && $expiry > time()) {
                    $this->unset($key);
                }
            }
        }
    }
}
