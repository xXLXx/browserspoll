<?php

use yii\db\Schema;
use yii\db\Migration;

class m140821_071518_users extends Migration
{
    public function up()
    {
        return $this->createTable('users', array(
            'id'            => Schema::TYPE_INTEGER.' UNSIGNED AUTO_INCREMENT PRIMARY KEY', 
            'username'      => Schema::TYPE_STRING.'(50) NOT NULL',
            'password'      => Schema::TYPE_STRING.'(255) NOT NULL',
            'auth_key'      => Schema::TYPE_STRING,
            'access_token'  => Schema::TYPE_STRING,
            'created_at'    => Schema::TYPE_INTEGER.' UNSIGNED',
            'updated_at'    => Schema::TYPE_INTEGER.' UNSIGNED',
            ));
    }

    public function down()
    {
        return $this->dropTable('users');
    }
}
