<?php
namespace App\Core\AuthN;

use App\Core\Session\SessionInterface;
use App\Models\User;

class AuthN
{
    /**
     * Name of the session variable for the user id.
     *
     * @var string
     */
    protected $session_id = 'user_id';

    /**
     * Name of the session variable for the user level.
     *
     * @var string
     */
    protected $session_level = 'user_level';

    /**
     * Session manager.
     *
     * @var SessionInterface
     */
    protected $session_manager;

    /**
     * AuthN constructor.
     *
     * @param SessionInterface $session_manager
     */
    public function __construct(SessionInterface $session_manager)
    {
        $this->session_manager = $session_manager;
    }

    /**
     * Get the currently logged in user's data.
     *
     * @return User|null
     */
    public function user()
    {
        return $this->isLoggedIn()
            ? User::find($this->session_manager->get($this->session_id))
            : null;
    }

    /**
     * Is there a user currently logged in?
     *
     * @return bool
     */
    public function isLoggedIn()
    {
        return (bool)$this->session_manager->get($this->session_id);
    }

    /**
     * Is the user at least a specified level?
     *
     * @param int $level
     * @return bool
     */
    public function isLevel($level)
    {
        return $this->isLoggedIn()
            && ($this->session_manager->get($this->session_level) >= $level);
    }

    /**
     * Attempt a user login with provided credentials.
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function attemptLogIn($email, $password)
    {
        if ($user = User::where('email', $email)->first()) {
            if (password_verify($password, $user->password)) {
                $this->session_manager->set($this->session_id, $user->id);
                $this->session_manager->set($this->session_level, $user->user_level);
                return true;
            }
        }
        return false;
    }

    /**
     * Log the user out.
     */
    public function logOut()
    {
        $this->session_manager->unset($this->session_id);
        $this->session_manager->unset($this->session_level);
    }
}
