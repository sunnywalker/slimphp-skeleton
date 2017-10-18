<?php
namespace App\Core\AuthN;

use App\Models\User;

class AuthN
{
    /**
     * Get the currently logged in user's data.
     *
     * @return User|null
     */
    public function user()
    {
        return $this->isLoggedIn() ? User::find($_SESSION['user_id']) : null;
    }

    /**
     * Is there a user currently logged in?
     *
     * @return boolean
     */
    public function isLoggedIn()
    {
        return !empty($_SESSION['user_id']);
    }

    /**
     * Is the user at least a specified level?
     *
     * @param int $level
     * @return boolean
     */
    public function isLevel($level)
    {
        return $this->isLoggedIn() && ($_SESSION['user_level'] >= $level);
    }

    /**
     * Attempt a user login with provided credentials.
     *
     * @param string $email
     * @param string $password
     * @return void
     */
    public function logInAttempt($email, $password)
    {
        if ($user = User::where('email', $email)->first()) {
            if (password_verify($password, $user->password)) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_level'] = $user->user_level;
                return true;
            }
        }
        return false;
    }

    /**
     * Log the user out.
     *
     * @return void
     */
    public function logOut()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_level']);
    }
}
