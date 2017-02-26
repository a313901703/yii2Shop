<?php 
use yii\bootstrap\Nav;

 ?>
<style type="text/css">
    .goodsLeftNav{
        width:170px;
        height: auto;
    }
    .goodsLeftNav li a{
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }
    .goodsLeftNav li a,.goodsLeftNav li a:hover,.goodsLeftNav li a:focus,.goodsLeftNav li a:link,.goodsLeftNav li a:visited{
        background-color: transparent;
        border:0;
        border-right:1px solid #72afd2;
    }

    .goodsLeftNav>li.active>a, .goodsLeftNav>li.active>a:hover, .goodsLeftNav>li.active>a:focus, .goodsLeftNav>li.active>a:link, .goodsLeftNav>li.active>a:visited{
        color:#72afd2;
        background-color: transparent;
        border:1px solid #72afd2;
        border-right:0;
    }
    .goodsLeftNav > li + li{
        margin-top:0;
    }
    .goodsLeftNav{
        border-bottom:0;
    }
    
</style>
<?php 
    $id = Yii::$app->redis->get(Yii::$app->user->id.'_currentGoods');
    $menuItems = [
        ['label' => '商品修改', 'url' => ['/goods/good/update','id'=>$id]],
        ['label' => '商品图片', 'url' => ['/goods/images']],
        ['label' => '销售属性', 'url' => ['/goods/props/index']],
        ['label' => '销售组合', 'url' => ['/goods/props/combi']],
    ];
    echo Nav::widget([
        'options' => ['class' => 'nav nav-tabs nav-stacked goodsLeftNav','role'=>"tablist"],
        'items' => $menuItems,
    ]);
?>
