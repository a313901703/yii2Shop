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
            'type',
            'base_freight',
            'renew',
            'whether_post',
            'free_post',
            'charge_rule',
            'region',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
