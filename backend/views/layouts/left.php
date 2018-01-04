<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=Yii::$app->user->identity->username?></p>

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

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [

                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    [
                        'label' => '后台管理',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '后台首页', 'icon' => 'shopping-cart', 'url' => ['/admin/index'],],
                            ['label' => '添加管理员', 'icon' => 'shopping-cart', 'url' => ['/admin/add'],],
                        ],
                    ],
                    [
                        'label' => '商品板块',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '商品首页', 'icon' => 'shopping-cart', 'url' => ['/goods'],],
                            ['label' => '商品添加', 'icon' => 'shopping-cart', 'url' => ['/goods/add'],],
                            ['label' => '商品分类', 'icon' => 'shopping-basket', 'url' => ['/goods-category'],],
                            ['label' => '商品分类添加', 'icon' => 'shopping-basket', 'url' => ['/goods-category/add'],],
                        ],
                    ],
                    [
                        'label' => '文章板块',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '文章首页', 'icon' => 'shopping-cart', 'url' => ['/article'],],
                            ['label' => '文章添加', 'icon' => 'shopping-cart', 'url' => ['/article/add'],],
                            ['label' => '文章分类', 'icon' => 'shopping-basket', 'url' => ['/article-category'],],
                            ['label' => '文章分类添加', 'icon' => 'shopping-basket', 'url' => ['/article-category/add'],],
                        ],
                    ],
                    [
                        'label' => '品牌板块',
                        'icon' => 'angellist',
                        'url' => '#',
                        'items' => [
                            ['label' => '品牌首页', 'icon' => 'shopping-cart', 'url' => ['/brand'],],
                            ['label' => '品牌添加', 'icon' => 'shopping-cart', 'url' => ['/brand/add'],],
                        ],
                    ],
                    [
                        'label' => '角色板块',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '权限首页', 'icon' => 'shopping-cart', 'url' => ['/permission'],],
                            ['label' => '权限添加', 'icon' => 'shopping-cart', 'url' => ['/permission/add'],],
                            ['label' => '角色首页', 'icon' => 'shopping-cart', 'url' => ['/role'],],
                            ['label' => '角色添加', 'icon' => 'shopping-cart', 'url' => ['/role/add'],],
                        ],
                    ],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => '登陆', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ],

            ]
        ) ?>

    </section>

</aside>
