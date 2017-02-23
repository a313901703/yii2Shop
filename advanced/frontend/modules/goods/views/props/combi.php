<?php
use yii\helpers\{Html};
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;

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
                        <th>颜色</th>
                        <th>内存</th>
                        <th>合约</th>
                        <th>价格</th>
                        <th>库存</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>白色</td>
                        <td>16G</td>
                        <td>移动</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>白色</td>
                        <td>32G</td>
                        <td>移动</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>黑色</td>
                        <td>16G</td>
                        <td>移动</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>黑色</td>
                        <td>16G</td>
                        <td>移动</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>