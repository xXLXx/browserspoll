<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "polls".
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $browser
 * @property string $reason
 * @property string $ip
 * @property string $history
 * @property string $created_at
 * @property string $updated_at
 */
class Poll extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'polls';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'reason', 'browser'], 'required'],
            [['browser', 'created_at', 'updated_at'], 'integer'],
            [['reason'], 'string'],
            [['name', 'ip'], 'string', 'max' => 50],
            [['email', 'history'], 'string', 'max' => 255]
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
            'email' => 'Email',
            'browser' => 'Browser',
            'reason' => 'Reason',
            'ip' => 'User IP',
            'history' => 'Last Accessed Page',
            'created_at' => 'Created At',
            'updated_at' => 'Time Submitted',
        ];
    }

    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }
}
