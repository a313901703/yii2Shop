<?php
use yii\helpers\{Html};
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
/* @var $this yii\web\View */
/* @var goods/combi */

$this->title = '属性组合';
$this->params['breadcrumbs'][] = $this->title;

AppAsset::addScript($this,Yii::$app->request->baseUrl."/js/propscombi.js");
?>
<div class="flex">
    <?= $this->render('@goods/views/nav.php')?>
    <div style="flex:1">
        <?php $form = ActiveForm::begin(); ?>
        <div id="createTable">
            <table class="table table-bordered" id="combiTable">
                <thead>
                    <tr>
                        <?php foreach ($propsNames as $value): ?>
                        <th><?=$value?></th>
                        <?php endforeach ?>
                        <th>价格</th>
                        <th>成本</th>
                        <th>库存</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $this->render('@goods/views/props/_combiTr.php',['data'=>$propsValues])?>
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <button class="btn btn-success">提交</button>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
$js = <<<JS
    $(function(){
        step.testMerge("{$propsColumn}");
    })
JS;
$this->registerJs($js);
?>