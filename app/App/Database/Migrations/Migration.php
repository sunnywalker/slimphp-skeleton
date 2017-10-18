<?php
namespace App\Database\Migrations;

use Illuminate\Database\Capsule\Manager;
use Phinx\Migration\AbstractMigration;

class Migration extends AbstractMigration
{
    protected $schema;

    /**
     * Initialize the migration to use Eloquent.
     */
    public function init()
    {
        $this->schema = (new Manager)->schema();
    }
}
