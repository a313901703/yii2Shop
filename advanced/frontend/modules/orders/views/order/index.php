<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = '订单';
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
            'order_tag',
            [
                'label'=>'商品',  
                'format'=>'html',
                'value' => function ($model) {
                    $html = '';
                    foreach ($model['products'] as $product) {
                        $html .= '<span>' . $product['product']['name'];
                        $html .= ' ('.$product['nums'] . ' 件 × ￥' . $product['price']/100 .')';
                        $html .= '</span><br/>';
                    }
                    return $html;
                },
            ],
            [
                'label'=>'订单金额',
                'value'=>function($model){
                    return '￥ '.$model->totalPrice;
                }
            ],
            [
                'label'=>'支付方式',
                'format'=>'html',
                'value'=>function($model){
                    return '微信支付';
                },
            ],
            [
                'label'=>'订单状态',
                'format'=>'html',
                'value' => function ($model) {
                    $statusText = $model['orderStatus']['status'];
                    $html = '<span class="label label-' . $statusText.'">';
                    $html.= $model['orderStatus']['value'];
                    $html.= '</span>';
                    return $html;

                },
            ],
            [
                'attribute'=>'created_at',
                'format' =>['date', 'php:Y-m-d H:i:s'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作', 
                'template' => '{view} &nbsp;{delete}',//只需要展示删除和更新
                'headerOptions' => ['width' => '80'],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
