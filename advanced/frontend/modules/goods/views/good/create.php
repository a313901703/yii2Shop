<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Goods */

$this->title = '新建商品';
$this->params['breadcrumbs'][] = ['label' => '商品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="form-content">
    <div class="flex">
        <?=  !$model->isNewRecord ? \Yii::$app->view->renderFile('@app/modules/goods/views/good/nav.php') : '';?>
        <div style="flex:1">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
