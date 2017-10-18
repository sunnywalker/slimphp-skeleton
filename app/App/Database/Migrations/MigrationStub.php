<?php
use $useClassName;
use Illuminate\Database\Schema\Blueprint;

class $className extends $baseClassName
{
    public function up()
    {
        $this->schema->create('tablename', function (Blueprint $table) {
            $table->increments('id');
            //
            $table->timestamps();
        });
        $this->schema->table('tablename', function (Blueprint $table) {
            //
        });
    }

    public function down()
    {
        $this->schema->drop('tablename');
        $this->schema->table('tablename', function (Blueprint $table) {
            // $table->dropColunn('');
        });
    }
}
