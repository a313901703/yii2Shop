<?php
use frontend\assets\AppAsset;
use yii\helpers\Url;

$this->title = '首页';

AppAsset::addScript($this,Yii::$app->request->baseUrl."/js/echarts.min.js");
AppAsset::addScript($this,Yii::$app->request->baseUrl."/js/index.js");
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
                <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>64</h3>
                <p>消息</p>
            </div>
            <div class="icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                                    Call of Duty IV
                                </td>
                                <td>
                                    <span class="label label-success">
                                        <?='订单完成' ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">
                                        <?= date('Y-m-d H:i:s',$order['created_at']) ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach ?>
                            <tr>
                                <td>
                                    <a href="pages/examples/invoice.html">
                                        OR7429
                                    </a>
                                </td>
                                <td>
                                    iPhone 6 Plus
                                </td>
                                <td>
                                    <span class="label label-danger">
                                        Delivered
                                    </span>
                                </td>
                                <td>
                                    <div class="sparkbar" data-color="#f56954" data-height="20">
                                        90,-80,90,70,-61,83,63
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="pages/examples/invoice.html">
                                        OR7429
                                    </a>
                                </td>
                                <td>
                                    Samsung Smart TV
                                </td>
                                <td>
                                    <span class="label label-info">
                                        Processing
                                    </span>
                                </td>
                                <td>
                                    <div class="sparkbar" data-color="#00c0ef" data-height="20">
                                        90,80,-90,70,-61,83,63
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="pages/examples/invoice.html">
                                        OR1848
                                    </a>
                                </td>
                                <td>
                                    Samsung Smart TV
                                </td>
                                <td>
                                    <span class="label label-warning">
                                        Pending
                                    </span>
                                </td>
                                <td>
                                    <div class="sparkbar" data-color="#f39c12" data-height="20">
                                        90,80,-90,70,61,-83,68
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="pages/examples/invoice.html">
                                        OR7429
                                    </a>
                                </td>
                                <td>
                                    iPhone 6 Plus
                                </td>
                                <td>
                                    <span class="label label-danger">
                                        Delivered
                                    </span>
                                </td>
                                <td>
                                    <div class="sparkbar" data-color="#f56954" data-height="20">
                                        90,-80,90,70,-61,83,63
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="pages/examples/invoice.html">
                                        OR9842
                                    </a>
                                </td>
                                <td>
                                    Call of Duty IV
                                </td>
                                <td>
                                    <span class="label label-success">
                                        Shipped
                                    </span>
                                </td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">
                                        90,80,90,-70,61,-83,63
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">
                    Place New Order
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">
                    View All Orders
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
                            Design a nice theme
                        </span>
                        <!-- Emphasis label -->
                        <small class="label label-danger">
                            <i class="fa fa-clock-o">
                            </i>
                            2 mins
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
                        <span class="handle">
                            <i class="fa fa-ellipsis-v">
                            </i>
                            <i class="fa fa-ellipsis-v">
                            </i>
                        </span>
                        <input type="checkbox" value="">
                        <span class="text">
                            Make the theme responsive
                        </span>
                        <small class="label label-info">
                            <i class="fa fa-clock-o">
                            </i>
                            4 hours
                        </small>
                        <div class="tools">
                            <i class="fa fa-edit">
                            </i>
                            <i class="fa fa-trash-o">
                            </i>
                        </div>
                    </li>
                    <li>
                        <span class="handle">
                            <i class="fa fa-ellipsis-v">
                            </i>
                            <i class="fa fa-ellipsis-v">
                            </i>
                        </span>
                        <input type="checkbox" value="">
                        <span class="text">
                            Let theme shine like a star
                        </span>
                        <small class="label label-warning">
                            <i class="fa fa-clock-o">
                            </i>
                            1 day
                        </small>
                        <div class="tools">
                            <i class="fa fa-edit">
                            </i>
                            <i class="fa fa-trash-o">
                            </i>
                        </div>
                    </li>
                    <li>
                        <span class="handle">
                            <i class="fa fa-ellipsis-v">
                            </i>
                            <i class="fa fa-ellipsis-v">
                            </i>
                        </span>
                        <input type="checkbox" value="">
                        <span class="text">
                            Let theme shine like a star
                        </span>
                        <small class="label label-success">
                            <i class="fa fa-clock-o">
                            </i>
                            3 days
                        </small>
                        <div class="tools">
                            <i class="fa fa-edit">
                            </i>
                            <i class="fa fa-trash-o">
                            </i>
                        </div>
                    </li>
                    <li>
                        <span class="handle">
                            <i class="fa fa-ellipsis-v">
                            </i>
                            <i class="fa fa-ellipsis-v">
                            </i>
                        </span>
                        <input type="checkbox" value="">
                        <span class="text">
                            Check your messages and notifications
                        </span>
                        <small class="label label-primary">
                            <i class="fa fa-clock-o">
                            </i>
                            1 week
                        </small>
                        <div class="tools">
                            <i class="fa fa-edit">
                            </i>
                            <i class="fa fa-trash-o">
                            </i>
                        </div>
                    </li>
                    <li>
                        <span class="handle">
                            <i class="fa fa-ellipsis-v">
                            </i>
                            <i class="fa fa-ellipsis-v">
                            </i>
                        </span>
                        <input type="checkbox" value="">
                        <span class="text">
                            Let theme shine like a star
                        </span>
                        <small class="label label-default">
                            <i class="fa fa-clock-o">
                            </i>
                            1 month
                        </small>
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
                    Add item
                </button>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- 用户列表 -->
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Latest Members
                </h3>
                <div class="box-tools pull-right">
                    <span class="label label-danger">
                        8 New Members
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
                    <li>
                        <img src="/imgs/user1-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">
                            Alexander Pierce
                        </a>
                        <span class="users-list-date">
                            Today
                        </span>
                    </li>
                    <li>
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
                    </li>
                </ul>
                <!-- /.users-list -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <a href="javascript:void(0)" class="uppercase">
                    View All Users
                </a>
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- 商品列表 -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Recently Added Products
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
                    <li class="item">
                        <div class="product-img">
                            <img src="/imgs/default-50x50.gif" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <a href="javascript:void(0)" class="product-title">
                                Samsung TV
                                <span class="label label-warning pull-right">
                                    $1800
                                </span>
                            </a>
                            <span class="product-description">
                                Samsung 32" 1080p 60Hz LED Smart HDTV.
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="/imgs/default-50x50.gif" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <a href="javascript:void(0)" class="product-title">
                                Samsung TV
                                <span class="label label-warning pull-right">
                                    $1800
                                </span>
                            </a>
                            <span class="product-description">
                                Samsung 32" 1080p 60Hz LED Smart HDTV.
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="/imgs/default-50x50.gif" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <a href="javascript:void(0)" class="product-title">
                                Samsung TV
                                <span class="label label-warning pull-right">
                                    $1800
                                </span>
                            </a>
                            <span class="product-description">
                                Samsung 32" 1080p 60Hz LED Smart HDTV.
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="/imgs/default-50x50.gif" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <a href="javascript:void(0)" class="product-title">
                                Samsung TV
                                <span class="label label-warning pull-right">
                                    $1800
                                </span>
                            </a>
                            <span class="product-description">
                                Samsung 32" 1080p 60Hz LED Smart HDTV.
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <a href="javascript:void(0)" class="uppercase">
                    View All Products
                </a>
            </div>
            <!-- /.box-footer -->
        </div>
    </div>
</div>