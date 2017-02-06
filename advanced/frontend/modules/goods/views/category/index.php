<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Category */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分类列表';
$this->params['breadcrumbs'][] = $this->title;

AppAsset::addScript($this,Yii::$app->request->baseUrl."/js/cat.js?".time());

?>
<style>
    tbody tr td:first-child{
        text-align: left;
        padding-left: 20px;
    }
    .cat:not(.cat-1){
        display: none;
    }
    .cat-icon{
        margin-right: 10px;
    }
    .cat-2 td:first-child{
        padding-left: 40px;
    }
    .cat-3 td:first-child{
        padding-left: 60px;
    }
</style>

<p>
   <?= Html::a('新建分类', ['create'], ['class' => 'btn btn-success']) ?> 
</p>

<div class="category-index">
    <table class="table table-bordered list-table">
        <thead>
            <tr>
                <th>分类名称</th>
                <th>父级ID</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $key => $category): ?>
            <tr class="cat cat-<?= $category['level']+1 ?>" data-value='<?= $category['id'] ?>' data-pid='<?= $category['pid'] ?>'>
                <td> <i class="fa fa-chevron-right cat-icon"></i> <?= $category['name'] ?></td>
                <td><?= $category['pid'] ?></td>
                <td>
                    <a class="btn btn-primary btn-sm">修改</a>
                    <?= Html::a('删除', ['delete','id'=>$category['id']], [
                        'class' => 'btn btn-danger btn-sm',
                        'title' => '删除',
                        'data-confirm' => Yii::t('yii', '你确定删除该分类么?'),
                        'data-method' => 'post',
                    ]);?>
                </td>
            </tr>   
            <?php endforeach ?>
        </tbody>
    </table>
    
</div>


