<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Practice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="practice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'practice_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'creation_date')->widget(DatePicker::className(),
        [ 'dateFormat' => 'php:Y-m-d',
            'clientOptions' => [
                'changeYear' => true,
                'changeMonth' => true,
                'yearRange' => '-50:-12',
            ]], '')
        ->textInput(['placeholder' => Yii::t('app', 'yyyy/m/d')]) ?>

    <?= $form->field($model, 'practice_status')->dropDownList([ 'open' => 'Open', 'close' => 'Close', ]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
