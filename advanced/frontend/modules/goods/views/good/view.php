<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Goods */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-content">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'short_name',
            'keyword',
            'seo_title',
            'seo_keyword',
            'seo_content',
            'good_no',
            'weight',
            'good_cate',
            'good_brand',
            'recommend',
            'show',
            'freight',
            'market_price',
            'sale_price',
            'cost',
            'stock',
            'alert',
            'sort',
            'integral',
            'virtual_nums',
            'volume',
        ],
    ]) ?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
