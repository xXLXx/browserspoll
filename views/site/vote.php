<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title = 'Vote';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/js/vote.js', ['depends' => 'yii\web\JqueryAsset']);

?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

    <div class="alert alert-success">
        Thank you for contibuting to our site us. An email was sent to you for confirmation.
    </div>

    <p class="pull-right">-- Browsers Poll, Click Home on menu to see results.</p>

    <?php else: ?>

    <p>
        Please fill out the following form to continue your contribution to our site. Thank you.
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'browser')->dropDownList(ArrayHelper::map($browsers, 'id', 'name')) ?>
                <?= $form->field($model, 'reason')->textArea(['rows' => 6]) ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                <?= $form->field($model, 'history', ['inputOptions' => ['history-input' => ''], 'template' => '{input}']) ?>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php endif; ?>
</div>
