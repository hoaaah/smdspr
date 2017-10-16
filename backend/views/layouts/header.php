<?php
use yii\helpers\Html;

$connection = \Yii::$app->db;
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

                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">!</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Jadwal Input</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <?php foreach($jdwl AS $jdwl): ?>
                                <li>
                                    <a href="#">
                                        <?php 
                                        IF(cekjadwal($jdwl['tgl_mulai'], $jdwl['tgl_selesai']) == true){
                                            echo '<i class="glyphicon glyphicon-ok text-aqua"></i>'.$jdwl['keterangan'].' ('.DATE('j M', strtotime($jdwl['tgl_mulai'])).' s/d '.DATE('j M', strtotime($jdwl['tgl_selesai'])).')';    
                                        }ELSE{
                                            echo '<i class="glyphicon glyphicon-remove text-red"></i>'.$jdwl['keterangan'].' ('.DATE('j M', strtotime($jdwl['tgl_mulai'])).' s/d '.DATE('j M', strtotime($jdwl['tgl_selesai'])).')';  
                                        }
                                        ?>
                                    </a>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
				<?php 
				IF(!Yii::$app->user->isGuest):
				?>
                <li class="dropdown tahun user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">Tahun Rencana: <?= Yii::$app->session->get('tahun') ? Yii::$app->session->get('tahun') : '<span class="label label-danger">Pilih !</span>' ?> </span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        $periode = $connection->createCommand('SELECT Tahun1, Tahun2, Tahun3, Tahun4, Tahun5 FROM ta_periode')->queryAll();
                        $tahun = null;
                        foreach($periode as $periode){
                            $tahun[] = $periode['Tahun1'];
                            $tahun[] = $periode['Tahun2'];
                            $tahun[] = $periode['Tahun3'];
                            $tahun[] = $periode['Tahun4'];
                            $tahun[] = $periode['Tahun5'];
                        }
                        foreach($tahun as $tahun): ?>
                        <li><?= Html::a('<i class="fa fa-arrow-right text-blue"></i>'.$tahun, ['/site/tahun', 'id' => $tahun]) ?></li>
                        <?php endforeach;?>
                    </ul>
                </li>                
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><i class="glyphicon glyphicon-user"></i>  <?= Yii::$app->user->identity->username ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/avatar.png" class="img-circle" alt="User Image"/>
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
