<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{
    /**
     * Get a list of all validation errors.
     *
     * @param array $data
     * @return array
     */
    public function validationErrors($data = null)
    {
        return [];
    }

    /**
     * Helper method to get data from the passed data or preserve from an instance.
     *
     * @param mixed $data
     * @return object
     */
    protected function dataOrThis(&$data = null)
    {
        if (is_null($data)) {
            return $this;
        } elseif (is_array($data)) {
            return (object)$data;
        }
        return $data;
    }
}
