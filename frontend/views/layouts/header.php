<?php
use yii\helpers\Html;

$connection = \Yii::$app->db;           
$tahun = $connection->createCommand('SELECT tahun FROM t_rkpd_program GROUP BY tahun')->queryAll();
IF(Yii::$app->session->get('tahun')){
    $thn = Yii::$app->session->get('tahun');
}ELSE{
    $thn = (DATE('Y')) +1;
}
$jdwl = $connection->createCommand("SELECT a.input_phased, b.keterangan, a.tgl_mulai, a.tgl_selesai
    FROM t_schedule a
    INNER JOIN r_phased b ON a.input_phased = b.id
    WHERE a.tahun = $thn")->queryAll();
function cekjadwal($mulai, $selesai){
    IF(DATE('Y-m-d') >= $mulai && DATE('Y-m-d') <= $selesai ){
        return true;
    }
}
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">SMD</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li class="dropdown tahun user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">Tahun Rencana: <?= Yii::$app->session->get('tahun') ? Yii::$app->session->get('tahun') : '<span class="label label-danger">Pilih !</span>' ?> </span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach($tahun as $tahun): ?>
                        <li><?= Html::a('<i class="fa fa-arrow-right text-blue"></i>'.$tahun['tahun'], ['/site/tahun', 'id' => $tahun['tahun']]) ?></li>
                        <?php endforeach;?>
                    </ul>
                </li>                    

                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Beberapa hal perlu anda perhatikan.</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> Usulan Kegiatan Musrenbang dibuka.
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-warning text-yellow"></i> Usulan Kegiatan Musrenbang ditutup.
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-red"></i> Anda belum terdaftar.
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-red"></i> Akun belum diaktivasi, silahkan tunggu.
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
				<?php 
				IF(!Yii::$app->user->isGuest):
				?>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!--<img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/> -->
                        <span class="hidden-xs"><i class="fa fa-dashboard"></i>  <?= Yii::$app->user->identity->username ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= \Yii\helpers\Url::to(['/']) ?>/images/logo.png" class="img-circle" alt="User Image"/>
                            <p>
                                <?php 
                                    IF(isset(Yii::$app->user->identity->tperan->kelurahan->desa)){
                                        $peran = Yii::$app->user->identity->tperan->kelurahan->desa;
                                    }ELSEIF(isset(Yii::$app->user->identity->tperan->kecamatan->kecamatan)){
                                        $peran = Yii::$app->user->identity->tperan->kecamatan->kecamatan;
                                    }ELSEIF(isset(Yii::$app->user->identity->tperan->sub->Nm_Sub_Unit)){
                                        $peran = Yii::$app->user->identity->tperan->sub->Nm_Sub_Unit;
                                    }ELSE{
                                        $peran = 'RKPD Spv';
                                    }
                                ?>
                                <?= Yii::$app->user->identity->nama.' - '.$peran ?>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                               <?= Html::a(
                                    'Profile',
                                    ['/user'],
                                    ['class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
				<?php
				ELSE:
				?>
                 <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">Login User/Registrasi</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><?= Html::a('Login', ['/site/login']) ?></li>
						<li><?= Html::a('Registrasi', ['/site/signup']) ?></li>
                    </ul>
                </li>
				<?php ENDIF; ?>

            </ul>
        </div>
    </nav>
</header>
