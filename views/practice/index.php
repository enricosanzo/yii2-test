<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use yii\helpers\ArrayHelper;
use yii2tech\csvgrid\CsvGrid;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PracticeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Practices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="practice-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="form-group" style="text-align: right;">
    <?= Html::a('Export results to CSV', ['export'], ['class' => 'btn btn-success']); ?>
   <?= Html::a('Export all to CSV', ['export-all'], ['class' => 'btn btn-success']); ?>
    </div>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'creation_date',
            'practice_id',
            'practice_status',
            'customer.first_name',
            'customer.last_name',
            //'customer_id',

            ['class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '50'],
                'template' => '{view}'],

        ],
    ]);
    
    Yii::$app->session['_practices'] = $dataProvider;

    ?>


</div>
