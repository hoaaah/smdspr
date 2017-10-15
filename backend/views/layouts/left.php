<?php
/*--------------------------------------------------
Sidebar for menu. Consist of user panel sidebar and menu sidebar.
In this part I'm using Yii::$app->user->identity as driver to create visibility menu.
@hoaaah
----------------------------------------------------*/

function akses($menu){
    $akses = \app\models\RefUserMenu::find()->where(['kd_user' => Yii::$app->user->identity->kd_user, 'menu' => $menu])->one();
    IF($akses){
        return true;
    }else{
        return false;
    }
}
?>

<aside class="main-sidebar">
    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/avatar.png" class="img-circle" alt="User Image"/>
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

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    //['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Dashboard', 'icon' => 'home',  'url' => Yii::$app->homeUrl],
                    [
                        'label' => 'Management',
                        'icon' => 'chevron-circle-right',
                        'visible' => akses(101) || akses(102) || akses(103),
                        'items' => [
                            ['label' => 'Global Setting!', 'icon' => 'circle-o', 'visible' => akses(101), 'url' => ['#'],],
                            ['label' => 'User Management', 'icon' => 'circle-o', 'visible' => akses(102), 'url' => ['/parameter/user'],],
                            ['label' => 'Akses Grup', 'icon' => 'circle-o', 'visible' => 1, 'url' => ['/management/menu'],],
                        ],
                    ],
                    [
                        'label' => 'Parameter',
                        'icon' => 'chevron-circle-right',
                        'visible' => akses(201) || akses(202) || akses(203) || akses(204) || akses(205) || akses(206),
                        'items' => [
                            ['label' => 'Data Umum Pemda', 'icon' => 'circle-o', 'visible' => akses(201), 'url' => ['/parameter/pemda'],],
                            ['label' => 'Unit Organisasi', 'icon' => 'circle-o', 'visible' => akses(202), 'url' => ['/parameter/unit'],],
                            ['label' => 'Lokasi', 'icon' => 'circle-o', 'visible' => akses(203), 'url' => ['/parameter/lokasi'],],
                            ['label' => 'Data Umum OPD', 'icon' => 'circle-o', 'visible' => akses(204), 'url' => ['/parameter/subunit'],],
                            ['label' => 'Program SKPD', 'icon' => 'circle-o','visible' => akses(205), 'url' => '#',],
                            ['label' => 'Jadwal Input', 'icon' => 'circle-o','visible' => akses(206), 'url' => ['/parameter/jadwal'],],
                        ],
                    ],
                    
                    [
                        'label' => 'RPJMD-Renstra (hide)',
                        'icon' => 'chevron-circle-right',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'RPJMD',
                                'icon' => 'circle-o',
                                'items' => [
                                    ['label' => 'Input RPJMD', 'icon' => 'circle-o', 'url' => ['/rpjmdrenstra/rkpd'],],
                                    ['label' => 'Proses RPJMD', 'icon' => 'circle-o', 'url' => ['#'],],
                                ],
                            ],
                            [
                                'label' => 'Renstra',
                                'icon' => 'circle-o',
                                'items' => [
                                    ['label' => 'Input Renstra', 'icon' => 'circle-o', 'url' => ['/rpjmdrenstra/renja'],],
                                    ['label' => 'Proses Renstra', 'icon' => 'circle-o', 'url' => ['#'],],
                                    
                                ],
                            ],                                                                                    
                        ],
                    ],
                    
                    [
                        'label' => 'RPJMD',
                        'icon' => 'chevron-circle-right',
                        'visible' => akses(401) || akses(402) || akses(403) || akses(404) || akses(405) || akses(406),
                        'items' => [
                            ['label' => 'Periode', 'icon' => 'circle-o', 'visible' => akses(401), 'url' => ['/rpjmd/periode'],],
                            ['label' => 'Misi-Tujuan-Sasaran', 'icon' => 'circle-o', 'visible' => akses(403), 'url' => ['/rpjmd/rpjmd'],],
                            ['label' => 'Prioritas', 'icon' => 'circle-o', 'visible' => akses(402), 'url' => ['/rpjmd/prioritas'],],
                            ['label' => 'Program RPJMD', 'icon' => 'circle-o', 'visible' => akses(404), 'url' => ['/rpjmd/rpjmdprogram'],],
                            ['label' => 'Pendapatan dan BTL', 'icon' => 'circle-o', 'visible' => akses(405), 'url' => ['/rpjmd/rpjmdpdtbtl'],],
                            ['label' => 'Proses Data RPJMD', 'icon' => 'circle-o', 'visible' => akses(406), 'url' => ['/rpjmd/proses'],],                
                        ],
                    ],
                    [
                        'label' => 'Renstra',
                        'icon' => 'chevron-circle-right',
                        'visible' => akses(501) || akses(502) || akses(503) || akses(504) || akses(505),
                        'items' => [
                            [
                                'label' => 'Renstra',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Misi-Tujuan-Sasaran', 'icon' => 'circle-o', 'visible' => akses(501), 'url' => ['/renstra/renstra'],],
                                    ['label' => 'Program Renstra', 'icon' => 'circle-o', 'visible' => akses(502), 'url' => ['/renstra/renstraprogram'],],
                                    ['label' => 'Kegiatan Indikatif', 'icon' => 'circle-o', 'visible' => akses(503), 'url' => ['/renstra/renstrakegiatan'],],
                                    ['label' => 'Pendapatan dan BTL', 'icon' => 'circle-o', 'visible' => akses(504), 'url' => ['/renstra/renstrapdtbtl'],],
                                    ['label' => 'Proses Data Renstra', 'icon' => 'circle-o', 'visible' => akses(505), 'url' => ['/renstra/proses'],],
                                ],
                            ],                 
                        ],
                    ],                                     
                    [
                        'label' => 'RKPD',
                        'icon' => 'chevron-circle-right',
                        'visible' => akses(601) || akses(602) || akses(603) || akses(604),
                        'items' => [
                            [
                                'label' => 'RKPD Awal',
                                'icon' => 'circle-o',
                                'visible' => akses(601) || akses(602),
                                'items' => [
                                    ['label' => 'Program RKPD', 'icon' => 'circle-o', 'visible' => akses(601), 'url' => ['/rkpd/rkpdawal'],],
                                    ['label' => 'Pendapatan dan BTL', 'icon' => 'circle-o', 'visible' => akses(602), 'url' => ['/rkpd/rkpdawalpdtbtl'],],
                                ],
                            ],
                            [
                                'label' => 'Musrenbang RKPD',
                                'icon' => 'circle-o',
                                'visible' => akses(603) || akses(604),
                                'items' => [
                                    ['label' => 'Sinkronisasi RKPD-Renja', 'icon' => 'circle-o',  'visible' => akses(603), 'url' => ['/musrenbangrkpd/musrenbangrkpd'],],
                                    ['label' => 'Proses Data', 'icon' => 'circle-o',  'visible' => akses(604), 'url' => ['#'],],
                                ],
                            ],                                            
                        ],
                    ],
                    [
                        'label' => 'Renja',
                        'icon' => 'chevron-circle-right',
                        'visible' => akses(701) || akses(702) || akses(703) || akses(704) || akses(705) || akses(706) || akses(707),
                        'items' => [
                            [
                                'label' => 'Renja Awal',
                                'icon' => 'circle-o',
                                'visible' => akses(701) || akses(702) || akses(703),
                                'items' => [
                                    ['label' => 'Program/Kegiatan Renja', 'icon' => 'circle-o', 'visible' => akses(701), 'url' => ['/renja/renjaawal'],],
                                    ['label' => 'Aktivitas Musrenbang', 'icon' => 'circle-o', 'visible' => akses(702), 'url' => ['/renja/aktmusren'],],
                                    ['label' => 'Pendapatan dan BTL', 'icon' => 'circle-o', 'visible' => akses(703), 'url' => ['/renja/renjaawalpdtbtl'],],
                                ],
                            ], 
                            [
                                'label' => 'SKPD',
                                'icon' => 'chevron-circle-right',
                                'visible' => akses(704) || akses(705) || akses(706) || akses(707),
                                'items' => [
                                    [
                                        'label' => 'Usulan',
                                        'icon' => 'circle-o',
                                        'visible' => akses(704) || akses(705),
                                        'items' => [
                                            ['label' => 'Belanja Langsung', 'icon' => 'circle-o', 'visible' => akses(704), 'url' => ['/forumskpd/renjakegiatan'],],
                                            ['label' => 'Proses Usulan', 'icon' => 'circle-o', 'visible' => akses(705), 'url' => ['/forumskpd/proses'],],
                                        ],
                                    ],
                                    [
                                        'label' => 'Forum SKPD',
                                        'icon' => 'circle-o',
                                        'visible' => akses(706) || akses(707),
                                        'items' => [
                                            ['label' => 'Verifikasi Data', 'icon' => 'circle-o', 'visible' => akses(706), 'url' => ['/forumskpd/renjakegiatanforum'],],
                                            ['label' => 'Proses Forum SKPD', 'icon' => 'circle-o', 'visible' => akses(707), 'url' => ['/forumskpd/prosesforum'],],
                                            
                                        ],
                                    ],                                                                                    
                                ],
                            ],                                            
                        ],
                    ],                                         
                    [
                        'label' => 'Musrenbang',
                        'icon' => 'chevron-circle-right',
                        'url' => '#',
                        'visible' => akses(802) || akses(803) || akses(804) || akses(805),
                        'items' => [
                            [
                                'label' => 'Musrenbang Kelurahan',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'visible' => akses(802) || akses(803),
                                'items' => [
                                    ['label' => 'Verifikasi Data', 'icon' => 'circle-o', 'visible' => akses(802), 'url' => ['/musrenbangdesa/subkegiatan'],],
                                    ['label' => 'Proses Data', 'icon' => 'circle-o', 'visible' => akses(803), 'url' => ['/musrenbangdesa/proses'],],
                                ],
                            ],
                            [
                                'label' => 'Musrenbang Kecamatan',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'visible' => akses(804) || akses(805),
                                'items' => [
                                    ['label' => 'Verifikasi Data', 'icon' => 'circle-o', 'visible' => akses(804), 'url' => ['/musrenbangkecamatan/subkegiatan'],],
                                    ['label' => 'Proses Data', 'icon' => 'circle-o', 'visible' => akses(805), 'url' => ['/musrenbangkecamatan/proses'],],
                                ],
                            ],
                            /*
                            [
                                'label' => 'Forum SKPD',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Input Usulan', 'icon' => 'circle-o', 'url' => ['/forumskpd/renjakegiatan'],],
                                    ['label' => 'Proses Usulan', 'icon' => 'circle-o', 'url' => ['/forumskpd/ba'],],
                                    ['label' => 'Verifikasi Data', 'icon' => 'circle-o', 'url' => ['/forumskpd/renjaprogram'],],
                                    ['label' => 'Proses Forum SKPD', 'icon' => 'circle-o', 'url' => ['/forumskpd/ba'],],
                                    
                                ],
                            ],
                            [
                                'label' => 'Musrenbang RKPD',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Verifikasi Data dan Usulan', 'icon' => 'circle-o', 'url' => ['/musrenbangrkpd/renjaprogram'],],
                                    ['label' => 'Sinkronisasi RKPD-Renja', 'icon' => 'circle-o', 'url' => ['/musrenbangrkpd/sinkron'],],
                                    ['label' => 'Proses Data', 'icon' => 'circle-o', 'url' => ['/musrenbangrkpd/ba'],],
                                ],
                            ],
                            */                                                                                   
                        ],
                    ],
                    [
                        'label' => 'Laporan',
                        'icon' => 'chevron-circle-right',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Pemerinta Daerah', 'icon' => 'circle-o', 'url' => ['#'],],
                            ['label' => 'SKPD', 'icon' => 'circle-o', 'url' => ['#'],],
                        ],
                    ],                    
                    ['label' => 'Bantuan dan FAQ', 'icon' => 'bookmark', 'url' => ['/user']],
                    //['label' => 'Menu Yii2', 'options' => ['class' => 'header']],                    
                    //['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    //['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    /*
                    [
                        'label' => 'Same tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    */
                ],
            ]
        ) ?>

    </section>

</aside>
