<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "browsers".
 *
 * @property string $id
 * @property string $name
 */
class Browser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'browsers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getVotes()
    {
        return $this->hasMany(Poll::className(), ['browser' => 'id']);
    }
}
