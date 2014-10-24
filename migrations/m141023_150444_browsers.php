<?php

use yii\db\Schema;
use yii\db\Migration;

class m141023_150444_browsers extends Migration
{
    public function up()
    {
        return $this->createTable('browsers', array(
            'id'        => Schema::TYPE_INTEGER.' UNSIGNED AUTO_INCREMENT PRIMARY KEY', 
            'name'      => Schema::TYPE_STRING.'(50) NOT NULL',
            ));
    }

    public function down()
    {
        return $this->dropTable('browsers');
    }
}
