<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '发票';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-index">

    <!--h1><?php // Html::encode($this->title) ?></h1-->
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加发票', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php if ($message = Yii::$app->session->getFlash('success')): ?>
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <?= $message; ?>
        </div>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'columns' => [
            'company_name',
            [
                'attribute' => 'open_time',
                'format' => ['date', 'php:Y-m-d'],
            ],
            'number',
            [
                'attribute' => 'money',
                'value' => function ($model) {
                    return floatval($model->money);
                }
            ],
            [
                'attribute' => 'rate',
                'value' => function ($model) {
                    return floatval($model->rate) . '%';
                }
            ],
            [
                'attribute' => 'create_time',
                'format' => ['date', 'php:Y-m-d'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}'
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
