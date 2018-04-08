<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Goods */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '商品列表', 'url' => ['index']];
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
            [
                'attribute' => 'weight',
                'value' => $model->weight.'(KG)',
            ],
            'category.name',
            'brand.name',
            [
                'attribute' => 'recommend',
                'value' => $model->recommend == 0 ? '不推荐' : '首页推荐',
            ],
            [
                'attribute' => 'show',
                'value' => $model->recommend == 0 ? '上架' : '不上架',
            ],
            'freight',
            [
                'attribute' => 'market_price',
                'value' => $model->market_price.'(￥)',
            ],
            [
                'attribute' => 'sale_price',
                'value' => $model->sale_price.'(￥)',
            ],
            [
                'attribute' => 'cost',
                'value' => $model->cost.'(￥)',
            ],
            'stock',
            'alert',
            'sort',
            'integral',
            'virtual_nums',
            'volume',
        ],
    ]) ?>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除该商品么?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
