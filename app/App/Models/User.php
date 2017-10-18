<?php
namespace App\Models;

class User extends AbstractModel
{
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
}
