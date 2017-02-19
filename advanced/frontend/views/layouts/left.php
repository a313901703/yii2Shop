<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?? ''?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <?php 
        $goodsActive = ($this->context->module->id == 'goods' && in_array($this->context->id,['good','props'])) ? 'active' : '';
         ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => '首页', 'icon' => 'fa fa-file-code-o', 'url' => ['/site/index']],
                    [
                        'label' => '商品',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => '商品详情', 
                                'icon' => 'fa fa-table', 
                                'url' => ['/goods/good'],
                                'active'=> $goodsActive      
                            ],
                            ['label' => '商品分类', 'icon' => 'fa fa-table', 'url' => ['/goods/category']],
                            ['label' => '商品品牌', 'icon' => 'fa fa-table', 'url' => ['/goods/brand']],
                        ],
                    ],
                    [
                        'label' => '用户管理',
                        'icon' => 'fa fa-users',
                        'url' => '#',
                        'items' => [
                            ['label' => '权限分配', 'icon' => 'fa fa-users', 'url' => ['/admin/assignment']],
                            ['label' => '用户列表', 'icon' => 'fa fa-users', 'url' => ['/admin/user']],
                            ['label' => '角色列表', 'icon' => 'fa fa-users', 'url' => ['/admin/role']],
                            ['label' => '权限列表', 'icon' => 'fa fa-users', 'url' => ['/admin/permission']],
                            ['label' => '路由列表', 'icon' => 'fa fa-users', 'url' => ['/admin/route']],
                            ['label' => '规则列表', 'icon' => 'fa fa-users', 'url' => ['/admin/rule']],
                            ['label' => '菜单列表', 'icon' => 'fa fa-users', 'url' => ['/admin/menu']],
                        ],
                    ],
                    [
                        'label' => 'Tools',
                        'icon' => 'fa fa-lightbulb-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                        ],
                        'visible' => YII_ENV_DEV,       //开发模式可见        
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
