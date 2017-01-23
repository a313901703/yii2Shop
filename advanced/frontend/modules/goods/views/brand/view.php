<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Brand */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '品牌', 'url' => ['/goods/brand']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'thumb',
                'format' => ['image',['width'=>'70','height'=>'70']],
            ],
            'sort',
            [
                'attribute' => 'created_at',
                'format' =>['date', 'php:Y-m-d H:i:s'],
            ],
            //'created_by',
        ],
    ]) ?>
     <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定要删除么?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
