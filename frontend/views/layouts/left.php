<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= \Yii\helpers\Url::to(['/']) ?>/images/logo.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <h4>Kabupaten Simulasi</h4>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?php
        echo dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    //['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Beranda', 'icon' => 'home',  'url' => Yii::$app->homeUrl],
                    [
                        'label' => 'Rencana Pembangunan',
                        'icon' => 'bar-chart-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Rencana Jangka Panjang', 'icon' => 'bar-chart-o', 'url' => ['#'],],
                            ['label' => 'Rencana Jangka Menengah', 'icon' => 'bar-chart-o', 'url' => ['#'],],
                        ],
                    ],
                    [
                        'label' => 'Rencana Kerja '.(DATE('Y')+1),
                        'icon' => 'play',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Daftar Program dan Kegiatan', 'icon' => 'edit', 'url' => ['/musrenrw/renjaprogram'],],
                            ['label' => 'Daftar Program dan Kegiatan', 'icon' => 'circle-o', 'url' => ['/musrenbang/list'],],
                            ['label' => 'Input Usulan', 'icon' => 'edit', 'url' => ['/musrenrw/renjakegiatan'], 'visible' => !Yii::$app->user->isGuest],
                            ['label' => 'Usulan Saya', 'icon' => 'edit', 'url' => ['/musrenrw/subkegiatan'], 'visible' => !Yii::$app->user->isGuest],
                        ],
                    ],
                    [
                        'label' => 'Data Historis',
                        'icon' => 'table',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'RPJPD',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => '2012-2032', 'icon' => 'circle-o', 'url' => '#',],
                                ],
                            ],
                            [
                                'label' => 'RPJMD',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => '2001-2005', 'icon' => 'circle-o', 'url' => '#',],
                                    ['label' => '2006-2010', 'icon' => 'circle-o', 'url' => '#',],
                                    ['label' => '2011-2015', 'icon' => 'circle-o', 'url' => '#',],
                                    ['label' => '2016-2020', 'icon' => 'circle-o', 'url' => '#',],
                                ],
                            ],                            
                            ['label' => 'Renja', 'icon' => 'file-code-o', 'url' => ['#'],],
                            ['label' => 'Daftar Usulan Ditolak', 'icon' => 'dashboard', 'url' => ['#'],],
                            ['label' => 'Daftar Usulan Ditangguhkan', 'icon' => 'dashboard', 'url' => ['#'],],
                        ],
                    ],
                    ['label' => 'Bantuan dan FAQ', 'icon' => 'bookmark', 'url' => ['/user']],
                ],
            ]
        ) ?>

    </section>

</aside>
