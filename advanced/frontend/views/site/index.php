<?php
use common\models\User;
use app\models\Goods;
use frontend\assets\AppAsset;
use yii\helpers\Url;

$this->title = '首页';

AppAsset::addScript($this,Yii::$app->request->baseUrl."/js/echarts.min.js");
AppAsset::addScript($this,Yii::$app->request->baseUrl."/js/index.js");

$newUsersIds = Yii::$app->authManager->getUserIdsByRole('api_vi_登录');
$newUsers = User::find()->where(['id'=>$newUsersIds])->limit(8)->orderBy('id desc')->asArray()->all();

$products = Goods::find()->limit(4)->orderBy('id desc')->asArray()->all();
?>

<div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>150</h3>
                <p>新增订单</p>
            </div>
            <div class="icon">
                <i class="fa fa-shopping-bag"></i>
            </div>
            <a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>44</h3>
                <p>新增用户</p>
            </div>
            <div class="icon">
                <i class="fa fa-user-o"></i>
            </div>
            <a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>64</h3>
                <p>消息</p>
            </div>
            <div class="icon">
                <i class="fa fa-commenting"></i>
            </div>
            <a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>12000</h3>
                <p>交易额</p>
            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>
            <a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <!-- chart -->
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    月度报告
                </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus">
                        </i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove">
                        <i class="fa fa-times">
                        </i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center">
                            <strong>
                                Sales: 1 Jan, 2014 - 30 Jul, 2014
                            </strong>
                        </p>
                        <div id="main-chart" style="height: 350px;">
                        </div>
                        <!-- /.chart-responsive -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-3 col-xs-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-green">
                                <i class="fa fa-caret-up">
                                </i>
                                17%
                            </span>
                            <h5 class="description-header">
                                $35,210.43
                            </h5>
                            <span class="description-text">
                                总营业额
                            </span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-yellow">
                                <i class="fa fa-caret-left">
                                </i>
                                0%
                            </span>
                            <h5 class="description-header">
                                $10,390.90
                            </h5>
                            <span class="description-text">
                                总消耗
                            </span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-green">
                                <i class="fa fa-caret-up">
                                </i>
                                20%
                            </span>
                            <h5 class="description-header">
                                $24,813.53
                            </h5>
                            <span class="description-text">
                                总收入
                            </span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                        <div class="description-block">
                            <span class="description-percentage text-red">
                                <i class="fa fa-caret-down">
                                </i>
                                18%
                            </span>
                            <h5 class="description-header">
                                1200
                            </h5>
                            <span class="description-text">
                                总预期
                            </span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-footer -->
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <!-- TABLE: 最新订单 -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    最新订单
                </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus">
                        </i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove">
                        <i class="fa fa-times">
                        </i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>
                                    订单号
                                </th>
                                <th>
                                    金额
                                </th>
                                <th>
                                    状态
                                </th>
                                <th>
                                    创建时间
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $key => $order): ?>
                            <tr>
                                <td>
                                    <a href="#">
                                        <?= $order['order_tag']?>
                                    </a>
                                </td>
                                <td>
                                    ￥<?= $order['total'] / 100?>
                                </td>
                                <td>
                                    <span class="label label-<?=$order['orderStatus']['status']?>">
                                        <?= $order['orderStatus']['value'] ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">
                                        <?= date('Y-m-d H:i:s',$order['created_at']) ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">
                    Place New Order
                </a> -->
                <a href="/orders.html" class="btn btn-sm btn-info btn-flat pull-right">
                    查看所有订单
                </a>
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- To Do List  -->
        <div class="box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard">
                </i>
                <h3 class="box-title">
                    To Do List
                </h3>
                <div class="box-tools pull-right">
                    <ul class="pagination pagination-sm inline">
                        <li>
                            <a href="#">
                                &laquo;
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                1
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                2
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                3
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                &raquo;
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                <ul class="todo-list">
                    <li>
                        <!-- drag handle -->
                        <span class="handle">
                            <i class="fa fa-ellipsis-v">
                            </i>
                            <i class="fa fa-ellipsis-v">
                            </i>
                        </span>
                        <!-- checkbox -->
                        <input type="checkbox" value="">
                        <!-- todo text -->
                        <span class="text">
                            一些需要添加的待办理表
                        </span>
                        <!-- Emphasis label -->
                        <small class="label label-danger">
                            <i class="fa fa-clock-o">
                            </i>
                            2 分钟
                        </small>
                        <!-- General tools such as edit or delete-->
                        <div class="tools">
                            <i class="fa fa-edit">
                            </i>
                            <i class="fa fa-trash-o">
                            </i>
                        </div>
                    </li>

                    <li>
                        <!-- drag handle -->
                        <span class="handle">
                            <i class="fa fa-ellipsis-v">
                            </i>
                            <i class="fa fa-ellipsis-v">
                            </i>
                        </span>
                        <!-- checkbox -->
                        <input type="checkbox" value="">
                        <!-- todo text -->
                        <span class="text">
                            一些需要添加的待办理表2
                        </span>
                        <!-- Emphasis label -->
                        <small class="label label-success">
                            <i class="fa fa-clock-o">
                            </i>
                            2 分钟
                        </small>
                        <!-- General tools such as edit or delete-->
                        <div class="tools">
                            <i class="fa fa-edit">
                            </i>
                            <i class="fa fa-trash-o">
                            </i>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
                <button type="button" class="btn btn-default pull-right">
                    <i class="fa fa-plus">
                    </i>
                    添加新项目
                </button>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- 用户列表 -->
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">
                    新用户
                </h3>
                <div class="box-tools pull-right">
                    <span class="label label-danger">
                        <?= count($newUsers) ?>个新用户
                    </span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus">
                        </i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove">
                        <i class="fa fa-times">
                        </i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <ul class="users-list clearfix">
                    <?php foreach ($newUsers as $key => $newUser): ?>
                    <li>
                        <img src="/imgs/user1-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">
                            <?= $newUser['username'] ?>
                        </a>
                        <span class="users-list-date">
                            Today
                        </span>
                    </li>  
                    <?php endforeach ?>
                    
                    <!-- <li>
                        <img src="/imgs/user8-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">
                            Norman
                        </a>
                        <span class="users-list-date">
                            Yesterday
                        </span>
                    </li>
                    <li>
                        <img src="/imgs/user7-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">
                            Jane
                        </a>
                        <span class="users-list-date">
                            12 Jan
                        </span>
                    </li>
                    <li>
                        <img src="/imgs/user6-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">
                            John
                        </a>
                        <span class="users-list-date">
                            12 Jan
                        </span>
                    </li>
                    <li>
                        <img src="/imgs/user2-160x160.jpg" alt="User Image">
                        <a class="users-list-name" href="#">
                            Alexander
                        </a>
                        <span class="users-list-date">
                            13 Jan
                        </span>
                    </li>
                    <li>
                        <img src="/imgs/user5-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">
                            Sarah
                        </a>
                        <span class="users-list-date">
                            14 Jan
                        </span>
                    </li>
                    <li>
                        <img src="/imgs/user4-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">
                            Nora
                        </a>
                        <span class="users-list-date">
                            15 Jan
                        </span>
                    </li>
                    <li>
                        <img src="/imgs/user3-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">
                            Nadia
                        </a>
                        <span class="users-list-date">
                            15 Jan
                        </span>
                    </li> -->
                </ul>
                <!-- /.users-list -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <a href="javascript:void(0)" class="uppercase">
                    查看全部用户
                </a>
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- 商品列表 -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    新添加的商品
                </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus">
                        </i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove">
                        <i class="fa fa-times">
                        </i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <ul class="products-list product-list-in-box">
                    <?php foreach ($products as $key => $product): ?>
                    <li class="item">
                        <div class="product-img">
                            <img src="/imgs/default-50x50.gif" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <a href="javascript:void(0)" class="product-title">
                                <?= $product['name']?>
                                <span class="label label-warning pull-right">
                                    ￥<?= $product['sale_price'] / 100 ?>
                                </span>
                            </a>
                            <span class="product-description">
                                商品描述
                            </span>
                        </div>
                    </li>      
                    <?php endforeach ?>    
                </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <a href="/goods/good.html" class="uppercase">
                    查看全部商品
                </a>
            </div>
            <!-- /.box-footer -->
        </div>
    </div>
</div>