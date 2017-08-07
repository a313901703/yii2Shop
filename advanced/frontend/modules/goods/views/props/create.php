<?php

use yii\helpers\{Html,Url};
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $propsModel->name;
$this->params['breadcrumbs'][] = ['label' => '商品', 'url' => ['/goods']];
$this->params['breadcrumbs'][] = ['label' => '属性', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_valueForm', [
    'model' => $model,
    'propsModel' => $propsModel
]) ?>

<div class="space"></div>

<?= GridView::widget([
    'dataProvider' => $provider,
    'options'=>['class'=>'list-table'],
    'layout'=>"{items}\n{pager}",
    'columns' => [
        ['class' => 'yii\grid\SerialColumn','header'=>'序号'],
        'name',
        [
            'label'=>'缩略图',
            'format'=>'html',
            'value'=>function($model){
                return $model->thumb ? Html::img("@web".$model->thumb,['width' =>80,'height'=>80]) : '';
            }
        ],
        'sort',
        [
            //动作列yii\grid\ActionColumn 
            'class' => 'yii\grid\ActionColumn',
            'header' => '操作', 
            'template' => '{update} &nbsp;{delete}',//只需要展示删除和更新
            'headerOptions' => ['width' => '300'],
            'buttons' => [
                'update' => function($url, $model, $key){
                    return Html::a('<i class="fa fa-pencil"></i> 修改',Url::to(['props/update-value','id'=>$key]), 
                        ['class' => 'btn btn-primary btn-sm ']);
                },
                'delete' => function($url, $model, $key){
                    return Html::a('<i class="fa fa-trash-o"></i> 删除',['delete-value', 'id' => $key], 
                        ['class' => 'btn btn-danger btn-sm','data' => ['confirm' => '你确定要删除吗？','method' => 'post']]);
                },
           ],
        ],
    ],
]); ?>
