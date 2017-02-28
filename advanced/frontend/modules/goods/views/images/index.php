<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\assets\AppAsset;
use yii\helpers\{Url,ArrayHelper};


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品图片';
$this->params['breadcrumbs'][] = ['label' => '商品', 'url' => ['/goods']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="flex">
    <?= $this->render('@goods/views/nav.php')?>
    <div style="flex:1">
	<?= $this->render('_form', [
	    'model' => $model,
	]) ?>
	</div>
</div>