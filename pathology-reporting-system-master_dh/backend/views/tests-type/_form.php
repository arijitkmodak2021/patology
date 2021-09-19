<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TestsType */
/* @var $form yii\widgets\ActiveForm */

print '<pre>';
print_r($test_categories);
print '</pre>';

for 


?>

<div class="box-body pad">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_name') ->dropDownList(
            //$test_categories,           // Flat array ('id'=>'label')
            ['options' => [                        
                    
                ]
            ],
            ['prompt'=> 'Select a Catrgory']    // options
        ); 
    ?>

    <?= $form->field($model, 'reference_interval')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comments')->textInput(['maxlength' => true]) ?>
    <!-- <?= Html::activeTextInput($model, 'cost', ['placeholder' => '', 'class' => 'form-control']); ?> -->
    
    <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
