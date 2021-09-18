<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TestsTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tests Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                                'label' => 'Test Name',
                                'value' => function ($data) {
                                    //return $data->comments .' ('.$data->reference_interval.')';
                                    return $data->name == '' ? 'N/A' : $data->name;
                                },
                            ],
                            [
                                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                                'label' => 'Test Category',
                                'value' => function ($data) {
                                    //return $data->comments .' ('.$data->reference_interval.')';
                                    return $data->category_name == '' ? 'N/A' : $data->category_name;
                                },
                            ],
                            [
                                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                                'label' => 'Normal Range (Unit)',
                                'value' => function ($data) {
                                    //return $data->comments .' ('.$data->reference_interval.')';
                                    return $data->comments == '' ? 'N/A' : $data->comments .' ('.$data->reference_interval.')';
                                },
                            ],
                            [
                                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                                'label' => 'Cost (Inr)',
                                'value' => function ($data) {
                                    return '₹ '.$data->cost;
                                },
                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
