<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

$controller = $this->context;
$route = $controller->route;
$module = $controller->module->id ?? '';

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="left-Menu">
        <div class="logoBox">
            <span>bootstrap</span>
        </div>
        <div class="userBox">
            <div class="userAvatarBox">
                <img src="<?= Url::to('@web/imgs/avatar.png') ?>">
            </div>
            <div class="userInfoBox">
                <div class="userName">
                    <strong>hi,<?=Yii::$app->user->identity->username ?? '';?></strong>
                </div>
                <div class="userStatus">
                    <small>onLine</small>
                </div>
            </div>
        </div>
        <?php 
            $menuItems = [
                ['label' => '首页', 'url' => ['/site/index'],'icon'=>'fa fa-home fa-fw'],
                [
                    'label' => '商品管理', 
                    'url' => ['/goods/good'],
                    'icon'=>'fa fa-table fa-fw',
                    'items'=>[
                        ['label'=>'商品列表','url'=>['/goods/good']],
                        ['label'=>'Brand','url'=>'javascript:void(0)'],
                    ],
                ],
                ['label' => 'Article', 'url' => 'javascript:void(0)','icon'=>'fa fa-home fa-fw'],
                ['label' => 'Others', 'url' => 'javascript:void(0)','icon'=>'fa fa-home fa-fw'],
                ['label' => 'Others', 'url' => 'javascript:void(0)','icon'=>'fa fa-home fa-fw'],
                ['label' => 'Others', 'url' => 'javascript:void(0)','icon'=>'fa fa-home fa-fw'],
            ];
            foreach ($menuItems as $key => $menu) {
                if (isset($menu['items'])) {
                    $menuItems[$key]['active'] = '';
                    foreach ($menu['items'] as $k => $item) {
                        if (strpos($route, trim($item['url'][0], '/')) === 0) {
                            $menuItems[$key]['items'][$k]['active'] = $menuItems[$key]['active'] = 'active';
                        }else{
                            $menuItems[$key]['items'][$k]['active'] = '';
                        }
                    }
                }else
                    $menuItems[$key]['active'] = strpos($route, trim($menu['url'][0], '/')) === 0 ? 'active' : '';
            }
         ?>
         <div class="menuItems ">
           <?php foreach ($menuItems as $menu): ?>
                <div class="menuItem <?= $menu['active'] ?>">
                    <a href="<?= Url::to($menu['url']) ?>"  data-target="#<?=$menu['label']?>" aria-expanded="true" aria-controls="<?=$menu['label']?>" class="menu"><i class="<?= $menu['icon'] ?>">
                        </i><span><?=$menu['label']?></span>
                    </a>
                    <?php if (isset($menu['items'])): ?>
                    <div id="<?=$menu['label']?>" class="collapse <?= $menu['active']?'in' : '' ?>">
                        <?php foreach ($menu['items'] as $item): ?>
                            <a href="<?= Url::to($item['url']) ?>" class="menu <?=$item['active']?>">
                                <span><?=$item['label']?></span>
                            </a>
                        <?php endforeach ?>
                    </div>
                    <?php endif ?>
                </div>  
           <?php endforeach ?>
         </div>
    </div>
    <div class="right">
        <?php
        NavBar::begin([
            'brandLabel' => 'WTF+',
            'brandUrl' => Yii::$app->homeUrl,
            'innerContainerOptions'=>[
                'class'=>'container',
                'style' => ['margin-right' => '0','margin-left' => '0','width'=>'100%']
            ],
        ]);
        $menuItems = [
            // ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            // $menuItems[] = [
            //     'label' => 'logout',
            //     'items' => [
            //         ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
            //             '<li class="divider"></li>',
            //             '<li class="dropdown-header">Dropdown Header</li>',
            //         ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
            //     ],
            // ];

            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget(['options'=>['style'=>'margin-bottom:0']]) ?>
        <?= $content ?>
    </div>
</div>  
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
    