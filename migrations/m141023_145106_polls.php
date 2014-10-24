<?php

use yii\db\Schema;
use yii\db\Migration;

class m141023_145106_polls extends Migration
{
    public function up()
    {
        return $this->createTable('polls', array(
            'id'            => Schema::TYPE_INTEGER.' UNSIGNED AUTO_INCREMENT PRIMARY KEY', 
            'name'          => Schema::TYPE_STRING.'(50) NOT NULL',
            'email'         => Schema::TYPE_STRING.'(255) NOT NULL',
            'browser'       => Schema::TYPE_INTEGER.' UNSIGNED',
            'reason'        => Schema::TYPE_TEXT . ' NOT NULL',
            'ip'            => Schema::TYPE_STRING.'(50)',
            'history'       => Schema::TYPE_STRING.'(255)',
            'created_at'    => Schema::TYPE_INTEGER.' UNSIGNED',
            'updated_at'    => Schema::TYPE_INTEGER.' UNSIGNED',
            ));
    }

    public function down()
    {
        return $this->dropTable('polls');
    }
}
