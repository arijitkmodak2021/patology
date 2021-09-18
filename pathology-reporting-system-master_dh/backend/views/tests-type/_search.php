<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TestsTypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tests-type-search">
    <?php 
        $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); 
    ?>
    <div class="col-sm-4">
    </br>
        <p> <?= Html::a('Create Tests Type', ['create'], ['class' => 'btn btn-success']) ?> </p>
    </div>
    <div class="col-sm-8" style="border-left: 1px solid #bababa;">
        <div class="col-sm-6"><?= $form->field($model, 'category_name')->label('Test Category') ?></div>
        <div class="col-sm-6"><?= $form->field($model, 'name')->label('Test Name') ?></div>
        <br>
        <div class="form-group col-sm-6">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    
    <?php ActiveForm::end(); ?>

    <?php // echo $form->field($model, 'comments') ?>

    

    

</div>
