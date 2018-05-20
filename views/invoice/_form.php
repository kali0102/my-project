<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use \yii\jui\AutoComplete;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */
/* @var $form yii\widgets\ActiveForm */

$data = [3, 17, 20, 34];

$getOpenTimeUrl = \yii\helpers\Url::to(['/invoice/get-suggest-open-time']);
$getCompanyUrl = \yii\helpers\Url::to(['/invoice/get-suggest-company']);
?>

<div class="invoice-form">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-3">{input}</div><div class="col-sm-4">{error}</div> ',
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
        ],
        'options' => ['class' => 'form-horizontal']
    ]); ?>

    <?php //$form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_name')->widget(AutoComplete::class, [
        'clientOptions' => [
            'source' => new \yii\web\JsExpression("function(request, response) {
                $.getJSON('" . $getCompanyUrl . "', {
                    term: request.term
                }, response);
            }"),
        ],
        'options' => [
            'class' => 'form-control'
        ]
    ]) ?>

    <?= $form->field($model, 'open_time')->widget(AutoComplete::class, [
        'clientOptions' => [
            'source' => new \yii\web\JsExpression("function(request, response) {
                $.getJSON('" . $getOpenTimeUrl . "', {
                    term: request.term
                }, response);
            }"),
        ],
        'options' => [
            'class' => 'form-control'
        ]
    ]) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'money')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'rate')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'rate')->widget(Select2::class, ['data' => $data,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => ['allowClear' => true],]);
    ?>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-3">
            <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
