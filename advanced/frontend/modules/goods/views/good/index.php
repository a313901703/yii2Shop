<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Goods */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Goods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-content">
<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterRowOptions' =>['class'=>'hidden'],
        'options'=>['class'=>'list-table'],
        'layout'=>"{items}\n{summary}\n{pager}",

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'good_no',
            'name',
            // [
            //     'label'=>'缩略图',
            //     'format'=>'html',
            //     'value'=>function($model){
            //         return Html::img("@web/imgs/uploads/1/f40abf6242-503008.png",['width' =>100,'height'=>100]);
            //     }
            // ],
            'brand.name',
            'category.name',
            [
                'label'=>'价格',  
                //'attribute'=>'sale_price',
                'format'=>'html',
                'value' => function ($model) {
                    $html = '';
                    $html .= "<span>市场价: ".$model->market_price."</span><br>";
                    $html .= "<span>售价: ".$model->sale_price."</span><br>";
                    $html .= "<span>成本: ".$model->cost."</span><br>";
                    return $html;
                },
            ],
            [
                'label'=>'详细信息',  
                //'attribute'=>'sale_price',
                'format'=>'html',
                'value' => function ($model) {
                    $html = '';
                    $html .= "<span>库存: ".$model->stock."</span><br>";
                    $html .= "<span>销售: ".$model->volume."</span><br>";
                    $html .= "<span>重量: ".$model->weight." kg</span><br>";
                    $html .= "<span>推荐类型: ".$model->recommend."</span><br>";
                    return $html;
                },
            ],
            [
                'label'=>'是否上架',  
                'format'=>'html',
                'value' => function ($model) {
                    $html = $model->show == 0 ? '<span class="label label-success">上架</span>' :'<span class="label label-danger">下架</span>' ;
                    return $html;
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
