<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\assets\AppAsset;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Category */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '属性列表';
$this->params['breadcrumbs'][] = $this->title;

// AppAsset::addScript($this,Yii::$app->request->baseUrl."/js/cat.js?";
?>
<div class="table-content">
    <div class="flex">
        <?= $this->render('@goods/views/nav.php', ['id'=>1])?>
        <div style="flex:1">
            <div class="category-index">
                <p>
                    <?php $form = ActiveForm::begin([
                        'options'=>['class'=>' active-form','enctype' => 'multipart/form-data'],
                        'fieldConfig'=>[
                            'template'=> "<div class=\"form-group flex\">{label}{input}</div>\n{error}",
                        ]
                    ]); ?>
                    
                    <?= Html::a('<i class="fa fa-plus"></i>  新建属性', ['create'], ['class' => 'btn btn-success']) ?>
                    <?php ActiveForm::end(); ?>
                </p>
               <!--  <table class="table table-bordered list-table">
                    <thead>
                        <tr>
                            <th>属性名</th>
                            <th>属性值</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr >
                            <td>颜色</td>
                            <td>黑色，白色，红色，蓝色</td>
                            <td>
                                <a href="##" class="btn btn-primary">修改</a>
                                <?php // Html::a('修改', ['update', 'id' => $category['id']], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?php // Html::a('删除', ['delete','id'=>$category['id']], [
                                    // 'class' => 'btn btn-danger btn-sm',
                                    // 'title' => '删除',
                                    // 'data-confirm' => Yii::t('yii', '你确定删除该分类么?'),
                                    // 'data-method' => 'post',
                                //]);?>
                            </td>
                        </tr>   
                    </tbody>
                </table> -->
            </div>
        </div>
    </div>
</div>
    




