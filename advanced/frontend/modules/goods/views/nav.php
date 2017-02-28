<?php 
use yii\bootstrap\Nav;

 ?>

<?php 
    $id = Yii::$app->redis->get(Yii::$app->user->id.'_currentGoods');
    $menuItems = [
        ['label' => '商品修改', 'url' => ['/goods/good/update','id'=>$id]],
        ['label' => '商品图片', 'url' => ['/goods/images/index']],
        ['label' => '销售属性', 'url' => ['/goods/props/index']],
        ['label' => '销售组合', 'url' => ['/goods/props/combi']],
        ['label' => '其他属性', 'url' => '#'],
        ['label' => '运费模板', 'url' => '#'],
        ['label' => '关联商品', 'url' => '#'],
    ];
    echo Nav::widget([
        'options' => ['class' => 'nav nav-tabs nav-stacked goodsLeftNav','role'=>"tablist"],
        'items' => $menuItems,
    ]);
?>
