<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Invoice */

$this->title = '添加';
$this->params['breadcrumbs'][] = ['label' => '发票', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-create">

    <!--h1><?php // Html::encode($this->title) ?></h1-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
