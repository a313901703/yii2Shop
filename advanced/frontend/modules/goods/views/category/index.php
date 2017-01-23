<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Category */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分类列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterRowOptions' =>['class'=>'hidden'],
        'options'=>['class'=>'list-table'],
        'layout'=>"{items}\n{summary}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'sort',
            'pid',
            // 'created_at',
            // 'created_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
