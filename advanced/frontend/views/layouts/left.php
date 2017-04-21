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
        $goodsActive = ($this->context->module->id == 'goods' && in_array($this->context->id,['good','props','images'])) ? 'active' : '';
         ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => '首页', 'icon' => 'home', 'url' => ['/site/index']],
                    [
                        'label' => '商品',
                        'icon' => 'shopping-bag',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => '商品列表', 
                                'icon' => 'bars', 
                                'url' => ['/goods/good'],
                                'active'=> $goodsActive      
                            ],
                            ['label' => '商品分类', 'icon' => 'table', 'url' => ['/goods/category']],
                            ['label' => '商品品牌', 'icon' => 'list', 'url' => ['/goods/brand']],
                            ['label' => '经销商', 'icon' => 'user-secret', 'url' => '#'],
                            [
                                'label' => '运费模板', 
                                'icon' => 'truck', 
                                'url' => ['/goods/freight'],
                                'active'=>$this->context->id == 'freight'? 'active' : '' ],
                        ],
                    ],
                    ['label' => '订单', 'icon' => 'cny', 'url' => '#'],
                    ['label' => '文章', 'icon' => 'newspaper-o', 'url' => '#'],
                    [
                        'label' => '用户管理',
                        'icon' => 'users',
                        'url' => '#',
                        'items' => [
                            ['label' => '权限分配', 'icon' => 'users', 'url' => ['/admin/assignment']],
                            ['label' => '用户列表', 'icon' => 'users', 'url' => ['/admin/user']],
                            ['label' => '角色列表', 'icon' => 'users', 'url' => ['/admin/role']],
                            ['label' => '权限列表', 'icon' => 'users', 'url' => ['/admin/permission']],
                            ['label' => '路由列表', 'icon' => 'users', 'url' => ['/admin/route']],
                            ['label' => '规则列表', 'icon' => 'users', 'url' => ['/admin/rule']],
                            ['label' => '菜单列表', 'icon' => 'users', 'url' => ['/admin/menu']],
                        ],
                    ],
                    [
                        'label' => 'Tools',
                        'icon' => 'lightbulb-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                        ],
                        'visible' => YII_ENV_DEV,       //开发模式可见        
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
