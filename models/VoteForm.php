<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * VoteForm is the model behind the vote form.
 */
class VoteForm extends Model
{
    public $name;
    public $email;
    public $browser;
    public $reason;
    public $history;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'browser', 'reason', 'history'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    public function save()
    {   
        if (!$this->validate()) {
            return false;
        }

        if (!$poll = Poll::findOne(['email' => $this->email])) {
            $poll = new Poll();
        }
        $poll->name = $this->name;
        $poll->email = $this->email;
        $poll->browser = $this->browser;
        $poll->reason = $this->reason;
        $poll->ip = Yii::$app->request->userIp;
        $poll->history = $this->history;

        if ($poll->save()) {
            return $this->sendEmail();
        } else {
            return false;
        }
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function sendEmail()
    {
        Yii::$app->mailer->compose()
            ->setTo($this->email)
            ->setFrom([Yii::$app->params['adminEmail'] => 'BROWSER POLL'])
            ->setSubject('Vote Confirmation')
            ->setTextBody('Thank you for contibuting to our site us.')
            ->send();

        return true;
    }
}
