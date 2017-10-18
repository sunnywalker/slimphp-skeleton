<?php
namespace App\Models;

class User extends AbstractModel
{
    /**
     * Set the password.
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->save();
    }

    /**
     * Update last logged in date.
     */
    public function touch()
    {
        if ($this->id) {
            $this->last_logged_in_at = date('Y-m-d H:i:s');
            $this->save();
        }
    }

    /**
     * Gather validation errors on $data or $this.
     *
     * @param mixed $data
     * @return array
     */
    public function validationErrors($data = null)
    {
        $errors = [];
        $data = $this->dataOrThis($data);
        if (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address.';
        }
        return $errors;
    }
}
