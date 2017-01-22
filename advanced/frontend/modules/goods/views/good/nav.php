<?php 
use yii\bootstrap\Nav;

 ?>
<style type="text/css">
    .nav-stacked{
        width:170px;
        height: auto;
    }
    .nav li a{
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }
    .nav li a,.nav li a:hover,.nav li a:focus,.nav li a:link,.nav li a:visited{
        background-color: transparent;
        border:0;
        border-right:1px solid #72afd2;
    }

    .nav-stacked>li.active>a, .nav-stacked>li.active>a:hover, .nav-stacked>li.active>a:focus, .nav-stacked>li.active>a:link, .nav-stacked>li.active>a:visited{
        background-color: transparent;
        border:1px solid #72afd2;
        border-right:0;
    }
    .nav-stacked > li + li{
        margin-top:0;
    }
    
</style>
<?php 
    $menuItems = [
        ['label' => '商品修改', 'url' => ['/goods/good/create']],
        ['label' => '商品图片', 'url' => '#'],
        ['label' => '商品规格', 'url' => '#'],
    ];
    echo Nav::widget([
        'options' => ['class' => 'nav nav-tabs nav-stacked','role'=>"tablist"],
        'items' => $menuItems,
    ]);
?>
