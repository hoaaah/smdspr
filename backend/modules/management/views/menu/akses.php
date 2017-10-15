<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;
function akses($id, $menu){
	$akses = \app\models\RefUserMenu::find()->where(['kd_user' => $id, 'menu' => $menu])->one();
	IF($akses) return true;
}
?> 
<table class="table table-hover">
	<tbody>
		<tr>
			<th>Main Menu</th>
			<th>Sub Menu</th>
			<th>Sub Sub Menu</th>
			<th>Akses</th>
		</tr>
		<!--Menu 1 -->
		<tr>
			<td rowspan="3">Pengaturan</td>
			<td>Pengaturan Global</td>
			<td>-</td>
			<td>
			<?php
				$menu = 101;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>
		<tr>
			<td>User Management</td>
			<td>-</td>
			<td>
			<?php
				$menu = 102;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>		
		<tr>
			<td>Grup User dan Akses</td>
			<td>-</td>
			<td>
			<?php
				$menu = 103;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>		
		<!--end of menu-->
		<!--Menu 2 -->
		<tr>
			<td rowspan="6">Parameter</td>
			<td>Data Umum Pemda</td>
			<td>-</td>
			<td>
			<?php
				$menu = 201;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>
		<tr>
			<td>Unit Organisasi</td>
			<td>-</td>
			<td>
			<?php
				$menu = 202;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>		
		</tr>
		<tr>
			<td>Lokasi</td>
			<td>-</td>
			<td>
			<?php
				$menu = 203;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>		
		</tr>
		<tr>
			<td>Data Umum SKPD</td>
			<td>-</td>
			<td>
			<?php
				$menu = 204;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>		
		</tr>
		<tr>
			<td>Program SKPD</td>
			<td>-</td>
			<td>
			<?php
				$menu = 205;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>		
		</tr>
		<tr>
			<td>Jadwal Input</td>
			<td>-</td>
			<td>
			<?php
				$menu = 206;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>		
		</tr>				
		<!--end of menu-->
		<!--Menu 3 -->
		<tr>
			<td rowspan="1">Data Management</td>
			<td>Batch Process</td>
			<td>-</td>
			<td>
			<?php
				$menu = 301;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>
		<!--Menu 4 -->
		<tr>
			<td rowspan="6">RPJMD</td>
			<td rowspan="6">RPJMD</td>
			<td>Periode</td>
			<td>
			<?php
				$menu = 401;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>
		<tr>
			<td>Prioritas</td>
			<td>
			<?php
				$menu = 402;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>		
		<tr>
			<td>Misi/Tujuan/Sasaran</td>
			<td>
			<?php
				$menu = 403;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>		
		<tr>
			<td>Program</td>
			<td>
			<?php
				$menu = 404;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>		
		<tr>
			<td>Pendapatan dan BTL</td>
			<td>
			<?php
				$menu = 405;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>		
		<tr>
			<td>Proses Data RPJMD</td>
			<td>
			<?php
				$menu = 406;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>
		<!--end of menu-->
		<!--Menu 5 -->
		<tr>
		<td rowspan="5">Renstra</td>
		<td rowspan="5">Renstra</td>
		<td>Misi/Tujuan/Sasaran</td>
		<td>
		<?php
			$menu = 501;
			IF(akses($model->id, $menu) === true){
				echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
						[
						 // 'class' => 'ajaxAkses',
						 'id' => 'access-'.$menu,
					  ]);							
			}ELSE{
				echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
						[  
						 'id' => 'access-'.$menu,
					  ]);
			}

		?>
		</td>
		</tr>
		<tr>
			<td>Program</td>
			<td>
			<?php
				$menu = 502;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
							[
							// 'class' => 'ajaxAkses',
							'id' => 'access-'.$menu,
						]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
							[  
							'id' => 'access-'.$menu,
						]);
				}

			?>
			</td>
		</tr>		
		<tr>
			<td>Kegiatan Indikatif</td>
			<td>
			<?php
				$menu = 503;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
							[
							// 'class' => 'ajaxAkses',
							'id' => 'access-'.$menu,
						]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
							[  
							'id' => 'access-'.$menu,
						]);
				}

			?>
			</td>
		</tr>		
		<tr>
			<td>Pendapatan dan BTL</td>
			<td>
			<?php
				$menu = 504;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
							[
							// 'class' => 'ajaxAkses',
							'id' => 'access-'.$menu,
						]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
							[  
							'id' => 'access-'.$menu,
						]);
				}

			?>
			</td>
		</tr>		
		<tr>
			<td>Proses Data Renstra</td>
			<td>
			<?php
				$menu = 505;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
							[
							// 'class' => 'ajaxAkses',
							'id' => 'access-'.$menu,
						]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
							[  
							'id' => 'access-'.$menu,
						]);
				}

			?>
			</td>
		</tr>				
		<!--end of menu-->
		<!--Menu 6 -->
		<tr>
			<td rowspan="4">RKPD</td>
			<td rowspan="2">RKPD Awal</td>
			<td>Program RKPD</td>
			<td>
			<?php
				$menu = 601;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>
		<tr>
			<td>Pendapatan dan BTL</td>
			<td>
			<?php
				$menu = 602;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>
		<tr>
			<td rowspan="2">Musrenbang RKPD</td>
			<td>Sinkronisasi RKPD/Renja</td>
			<td>
			<?php
				$menu = 603;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>				
		<tr>
			<td>Proses Data</td>
			<td>
			<?php
				$menu = 604;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>
		<!--end of menu-->		
		<!--Menu 7 -->
		<tr>
			<td rowspan="7">Renja</td>
			<td rowspan="3">Renja Awal</td>
			<td>Program/Kegiatan</td>
			<td>
			<?php
				$menu = 701;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>
		<tr>
			<td>Aktivitas Musrenbang</td>
			<td>
			<?php
				$menu = 702;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>
		<tr>
			<td>Pendapatan dan BTL</td>
			<td>
			<?php
				$menu = 703;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>
		<tr>
			<td rowspan="2">SKPD Usulan</td>
			<td>Belanja Langsung</td>
			<td>
			<?php
				$menu = 704;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>				
		<tr>
			<td>Proses Usulan</td>
			<td>
			<?php
				$menu = 705;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>
		<tr>
			<td rowspan="2">Forum SKPD</td>
			<td>Verifikasi Data</td>
			<td>
			<?php
				$menu = 706;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>				
		<tr>
			<td>Proses Forum</td>
			<td>
			<?php
				$menu = 707;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>		
		<!--end of menu-->
		<!--Menu 8 -->
		<tr>
			<td rowspan="5">Musrenbang</td>
			<td>Musrenbang RW</td>
			<td>Frontend</td>
			<td>
			<?php
				$menu = 801;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>
		<tr>
			<td rowspan="2">Musrenbang Kelurahan</td>
			<td>Verifikasi Data</td>
			<td>
			<?php
				$menu = 802;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>				
		<tr>
			<td>Proses Data</td>
			<td>
			<?php
				$menu = 803;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>
		<tr>
			<td rowspan="2">Musrenbang Kecamatan</td>
			<td>Verifikasi Data</td>
			<td>
			<?php
				$menu = 804;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>				
		<tr>
			<td>Proses Data</td>
			<td>
			<?php
				$menu = 805;
				IF(akses($model->id, $menu) === true){
					echo Html::a('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 0 ],
                            [
                             // 'class' => 'ajaxAkses',
                             'id' => 'access-'.$menu,
                          ]);							
				}ELSE{
					echo Html::a('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>', ['give', 'id' => $model->id, 'menu' => $menu, 'akses' => 1 ],
                            [  
                             'id' => 'access-'.$menu,
                          ]);
				}

			?>
			</td>
		</tr>		
		<!--end of menu-->							
	</tbody>
</table>
<script>
    $('a[id^="access-"]').on("click", function(event) {
        event.preventDefault();
        var href = $(this).attr('href');
        var id = $(this).attr('id');
		var status = href.slice(-1);
		status = parseInt(status);
		status == 1 ? confirmMessage = 'Berikan akses?' : confirmMessage = 'Hapus Akses?'
		var confirmation = confirm(confirmMessage);
        object = $(this);
		if(confirmation == true){
			$(this).html('<i class=\"fa fa-spinner fa-spin\"></i>');
			$.ajax({
			    url: href,
			    type: 'post',
			    data: $(this).serialize(),
			    beforeSend: function(){
			            // create before send here
			        },
			        complete: function(){
			            // create complete here
			        },
			    success: function(data) {
					if(data == 1)
					{
						if(status == 1){
							$(object).html('<span class = "label label-success"><i class="fa  fa-sign-in bg-white"></i></span>');
							href = href.replace('akses=1', 'akses=0');
							$(object).attr('href', href);
						}else{
							$(object).html('<span class = "label label-danger"><i class="fa  fa-lock bg-white"></i></span>');
							href = href.replace('akses=0', 'akses=1');
							$(object).attr('href', href);
						}
					}else{
						$(object).html('<span class = "label label-danger">Gagal!</span>');
					}
			    }
			});
		}
    });   
</script>