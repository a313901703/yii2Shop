<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '运费模板';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-content">
    <p>
        <?= Html::a('新建模板',['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterRowOptions' =>['class'=>'hidden'],
        'options'=>['class'=>'list-table'],
        'layout'=>"{items}\n{summary}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'label'=>'是否包邮',  
                'format'=>'html',
                'value' => function ($model) {
                    $html = $model->whether_post == 0 ? '<span class="label label-warning">买家承担</span>' :'<span class="label label-info">卖家承担</span>' ;
                    return $html;
                },
            ],
            [
                'label'=>'邮费',  
                //'attribute'=>'sale_price',
                'format'=>'html',
                'value' => function ($model) {
                    $units = $model->charge_rule == 1? '件' : 'KG';
                    $html = '';
                    $html .= "<span>首件:$model->base_num ($units)</span>&nbsp;&nbsp;&nbsp;<span>首费: ".$model->base_freight."元</span><br>";
                    $html .= "<span>续件:$model->renew_num ($units)</span>&nbsp;&nbsp;&nbsp;<span>续费: ".$model->renew."元</span><br>";
                    return $html;
                },
            ],
            [
                'label'=>'包邮策略',  
                //'attribute'=>'sale_price',
                'format'=>'html',
                'value' => function ($model) {
                    $free_post_units = $model->free_post == 0? '' : ($model->free_post == 1 ? '件' : '元');
                    if (!$free_post_units) {
                        return '未选择包邮策略';
                    }
                    $html = "满 ".$model->free_post_value."($free_post_units)包邮";
                    return $html;
                },
            ],
            [
                'headerOptions' => ['width' => '400'],
                'label'=>'配送区域',
                'value' => function ($model) {
                    return $model->region_name;
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} &nbsp;{delete}',//只需要展示删除和更新
            ],
        ],
    ]); ?>
</div>
