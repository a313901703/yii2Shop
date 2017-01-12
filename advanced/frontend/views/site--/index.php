<?php
use frontend\assets\AppAsset;
use yii\helpers\Url;

$this->title = '首页';

AppAsset::addCss($this,Yii::$app->request->baseUrl.'/css/index.css');  
AppAsset::addScript($this,Yii::$app->request->baseUrl."/js/echarts.min.js");
AppAsset::addScript($this,Yii::$app->request->baseUrl."/js/index.js");
AppAsset::addScript($this,Yii::$app->request->baseUrl."/js/easypiechart/dist/easypiechart.min.js");
AppAsset::addScript($this,Yii::$app->request->baseUrl."/js/easypiechart/dist/jquery.easypiechart.min.js");
?>
<div class="content">
    <div class="row">
        <!-- section 1  -->
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel-widget panel-blue">
                <div class="widget-left">
                    <i class="fa fa-shopping-cart fa-4x"></i>
                </div>
                <div class="widget-right">
                    <div class="widget-title"><h3>100</h3></div>
                    <div class="widget-info"><span>订单</span></div>
                </div>
            </div> 
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel-widget panel-orange">
                <div class="widget-left">
                    <i class="fa fa-group fa-4x"></i>
                </div>
                <div class="widget-right">
                    <div class="widget-title"><h3>2000</h3></div>
                    <div class="widget-info"><span>新用户</span></div>
                </div>
            </div> 
        </div>
         <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel-widget panel-green">
                <div class="widget-left">
                    <i class="fa fa-commenting-o fa-4x"></i>
                </div>
                <div class="widget-right">
                    <div class="widget-title"><h3>17</h3></div>
                    <div class="widget-info"><span>消息</span></div>
                </div>
            </div> 
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel-widget panel-red">
                <div class="widget-left">
                    <i class="fa fa-money fa-4x"></i>
                </div>
                <div class="widget-right">
                    <div class="widget-title"><h3>200,0000</h3></div>
                    <div class="widget-info"><span>交易额</span></div>
                </div>
            </div> 
        </div>
    </div>
    <!-- section chart  -->
    <div class="row">
        <div class="col-md-12">
            <div class="main-chart-box">
                <div class="main-chart-title"><strong>Site Traffic</strong></div>
                <div class="main-chart-content">
                    <div class="chart" id="main-chart" ></div>
                </div>
            </div>
        </div>
    </div> 
    <!-- section 3  -->
    <div class="space"></div>
    <div class="row">
        <div class="col-md-8">
            <div class="chat-box">
                <div class="chat-heading">
                    <i class="icon-comment icon-1x"></i>
                    <span style="margin-right: 10px">Chat</span>
                </div>
                <div class="chat-body">
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img src="<?= Url::to('@web/imgs/avatar.png') ?>" class="avatar">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Miracle</h4>
                            <span class="chat-content">这是一些示例文本。这是一些示例文本。</span>
                        </div>
                    </div>
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img src="<?= Url::to('@web/imgs/avatar.png') ?>" class="avatar">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Miracle</h4>
                            <span class="chat-content">这是一些示例文本。这是一些示例文本。</span>
                            <div class="media">
                                <a class="pull-left" href="#">
                                   <img src="<?= Url::to('@web/imgs/avatar.png') ?>" class="avatar">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Miracle</h4>
                                    <span class="chat-content">这是一些示例文本。这是一些示例文本。</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="media">
                        <a class="media-left" href="#">
                            <img src="<?= Url::to('@web/imgs/avatar.png') ?>" class="avatar">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Miracle</h4>
                            <span class="chat-content">这是一些示例文本。这是一些示例文本。</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--todo list -->
        <div class="col-md-4">
            <div class="todolist-box">
                <ul class="list-group">
                    <li class="list-group-item active">
                        <i class='icon-check'></i>
                        list-to-do
                    </li>
                    <li class="list-group-item">
                        <div>
                            <input type="checkbox" checked="true" class="list-tood-checkbox">
                            <span class="under-line"> list-to-do 1 </span>
                        </div>
                        <div class="todo-operate">   
                            <i class="icon-pencil"> </i>
                            <i class="icon-flag"> </i>
                            <i class="icon-trash"> </i>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div>
                            <input type="checkbox" class="list-tood-checkbox">
                            <span> list-to-do 1 </span>
                        </div>
                        <div class="todo-operate">   
                            <i class="icon-pencil"> </i>
                            <i class="icon-flag"> </i>
                            <i class="icon-trash"> </i>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div>
                            <input type="checkbox" class="list-tood-checkbox">
                            <span> list-to-do 1 </span>
                        </div>
                        <div class="todo-operate">   
                            <i class="icon-pencil"> </i>
                            <i class="icon-flag"> </i>
                            <i class="icon-trash"> </i>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div>
                            <input type="checkbox" class="list-tood-checkbox"> 
                            <span> list-to-do 1 </span>
                        </div>
                        <div class="todo-operate">   
                            <i class="icon-pencil"> </i>
                            <i class="icon-flag"> </i>
                            <i class="icon-trash"> </i>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>  
</div>
