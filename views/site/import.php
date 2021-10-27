<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$model = new app\models\ImportForm();

$this->title = 'File import';
$this->params['breadcrumbs'][] = 'File import';
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="import-form">
    File type:
    <div class="form-group">
        <?= Html::dropDownList('type', $model, ['C' => 'Customers', 'P' => 'Practices'], ['class' => 'btn btn-primary dropdown-toggle', 'data-toggle' => "dropdown", 'aria-haspopup' => "true",
            'aria-expanded' => "false"]) ?>
    </div>
    <div class="btn-group">
        <?= $form->field($model, 'file')->fileInput(['class' => 'custom-file'])->label('') ?></div>
</div>

<div class="form-group">
    <?= Html::submitButton('Upload', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
</div>
