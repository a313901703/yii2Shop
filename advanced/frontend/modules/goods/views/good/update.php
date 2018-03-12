<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Goods */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '商品', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="goods-update">
    <div class="flex">
        <?= $this->render('@goods/views/nav.php')?>
        <div style="flex:1">
             <?= $this->render('_form', [
                'model' => $model,
            ]) ?>   
        </div>
    </div>
</div>
