<?php
Use app\itbz\fpdf\src\fpdf\fpdf;

function angka($n) {
    // first strip any formatting;
    $n = (0+str_replace(",","",$n));
    
    // is this a number?
    if(!is_numeric($n)) return false;
    
    // now filter it;
    if($n>1000000000000) return round(($n/1000000000000),1).' T';
    else if($n>1000000000) return round(($n/1000000000),1).' M';
    else if($n>1000000) return round(($n/1000000),1).' juta';
    else if($n>1000) return round(($n/1000),1).' ribu';
    
    return number_format($n);
}

function ceklimit($y4, $y5, $y6, $y7, $y8, $y9, $y10, $data){
	$height[] = $y4 + ((strlen($data['program'])/18)*5);
	$height[] = $y5 + ((strlen($data['kegiatan_prioritas'])/18)*5);
	$height[] = $y6 + ((strlen($data['uraian'])/18)*5);
	$height[] = $y7 + ((strlen($data['kd_kelurahan'])/14)*5);
	$height[] = $y8 + ((strlen($data['volume'])/7)*5);
	$height[] = $y9 + ((strlen($data['biaya'])/7)*5);
	$height[] = $y10 + ((strlen($data['Nm_Sub_Unit'])/14)*5);

	$t = max($height);
	return $t;
}

function nama_hari($hari){
	//$hari berformat DATE('w');
    switch($hari){      
        case 0 : {
                    $hari='Minggu';
                }break;
        case 1 : {
                    $hari='Senin';
                }break;
        case 2 : {
                    $hari='Selasa';
                }break;
        case 3 : {
                    $hari='Rabu';
                }break;
        case 4 : {
                    $hari='Kamis';
                }break;
        case 5 : {
                    $hari="Jumat";
                }break;
        case 6 : {
                    $hari='Sabtu';
                }break;
        default: {
                    $hari='UnKnown';
                }break;
    }	
    return $hari;
}

function nama_bulan($bln){
	switch($bln){       
	        case 1 : {
	                    $bln='Januari';
	                }break;
	        case 2 : {
	                    $bln='Februari';
	                }break;
	        case 3 : {
	                    $bln='Maret';
	                }break;
	        case 4 : {
	                    $bln='April';
	                }break;
	        case 5 : {
	                    $bln='Mei';
	                }break;
	        case 6 : {
	                    $bln="Juni";
	                }break;
	        case 7 : {
	                    $bln='Juli';
	                }break;
	        case 8 : {
	                    $bln='Agustus';
	                }break;
	        case 9 : {
	                    $bln='September';
	                }break;
	        case 10 : {
	                    $bln='Oktober';
	                }break;     
	        case 11 : {
	                    $bln='November';
	                }break;
	        case 12 : {
	                    $bln='Desember';
	                }break;
	        default: {
	                    $bln='UnKnown';
	                }break;
	    }	
	return $bln;
}

//menugaskan variabel $pdf pada function fpdf().
$pdf = new \fpdf\FPDF();
//Menambahkan halaman, untuk menambahkan halaman tambahkan command ini. P artinya potrait dan L artinya Landscape
//Hal1 untuk pembuka berita acara-------------------------------------------------------------------
$pdf->AddPage("P","A4");
$pdf->SetAutoPageBreak(true, 10);
$pdf->AliasNbPages();
$pdf->setmargins(20,10, 10);

//$pdf->SetXY(170,10);
$pdf->SetFont('Times','B',18); 
$pdf->Cell(180,8,'BERITA ACARA',0,0,'C');
$pdf->Ln();
$pdf->SetFont('Times','B',12); 
$pdf->Cell(180,6,'MUSRENBANG KECAMATAN',0,0,'C');
$pdf->Ln();
$pdf->SetFont('Times','B',12); 
$pdf->Cell(180,6,'KABUPATEN SIMULASI',0,0,'C');
$pdf->Ln();
$pdf->SetFont('Times','BU',12); 
$pdf->Cell(180,6,Yii::$app->user->identity->tperan->kd_kecamatan <> NULL ? Yii::$app->user->identity->tperan->kecamatan->kecamatan.' TAHUN '.(DATE('Y')+1) : 'ANDA BUKAN USER KECAMATAN TAHUN '.(DATE('Y')+1),0,0,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Times','',12); 
$pdf->MultiCell(180,5,'        Pada hari '.nama_hari(DATE('w', strtotime($model->tanggal_ba))).' tanggal '.DATE('d', strtotime($model->tanggal_ba)).' bulan '.nama_bulan(DATE('m', strtotime($model->tanggal_ba))).' tahun '.DATE('Y', strtotime($model->tanggal_ba)).' bertempat di Aula Kantor Camat Samudera telah diselenggarakan Musrenbang Kecamatan kabupaten Aceh Utara yang dihadiri pemangku kepentingan sesuai dengan daftar hadir peserta yang tercantum dalam Lampiran I berita acara ini. ', '', 'L', 0);
$pdf->Ln();
$pdf->MultiCell(180,5,'        Setelah memperhatikan, mendengar dan mempertimbangkan:', '', 'L', 0);
$pdf->Ln();
$pdf->MultiCell(180,5,'1.	Sambutan-sambutan yang disampaikan oleh:', '', 'L', 0);
$pdf->SetX(30);
$pdf->MultiCell(150,5,'a.	Camat Kecamatan Samudera (Dayan Albar,S.Sos)', '', 'L', 0);
$pdf->SetX(30);
$pdf->MultiCell(150,5,'b.	Pemaparan Rencana Awal RKPD Kabupaten Aceh Utara Tahun 2015 (Zulkifli Yusuf Kepala Bappeda)', '', 'L', 0);
$pdf->SetX(30);
$pdf->MultiCell(150,5,'c.	Pokok-Pokok pikiran DPRK Terhadap RKPD Kabupaten Aceh Utara Tahun 2015 (Tgk. Abdul Hadi)', '', 'L', 0);
$pdf->Ln();
$pdf->Cell(180,6,'MENYEPAKATI',0,0,'C');
$pdf->Ln();
$ln = $pdf->GetY();
$pdf->SetXY(20,$ln);
$pdf->MultiCell(150,5,'KESATU    :', '', 'L', 0);
$pdf->SetXY(50,$ln);
$pdf->MultiCell(150,5,'Kegiatan Prioritas, Sasaran, yang disertai target dan kebutuhan pendanaan berdasarkan hasil pembobotan (skoring) pada saat diskusi kelompok dalam Daftar Prioritas Kecamatan Samudera Kabupaten Aceh Utara Tahun 2015 sebagaimana tercantum dalam Lampiran II berita acara ini. )', '', 'L', 0);
$ln = $pdf->GetY();
$pdf->SetXY(20,$ln);
$pdf->MultiCell(150,5,'KEDUA    :', '', 'L', 0);
$pdf->SetXY(50,$ln);
$pdf->MultiCell(150,5,'Usulan program dan kegiatan yang belum dapat diakomodir dalam rancangan RKPD Kabupaten Aceh Utara Tahun 2015 beserta alasan penolakannya sebagaimana tercantum dalam Lampiran III berita acara ini.', '', 'L', 0);
$ln = $pdf->GetY();
$pdf->SetXY(20,$ln);
$pdf->MultiCell(150,5,'KETIGA    :', '', 'L', 0);
$pdf->SetXY(50,$ln);
$pdf->MultiCell(150,5,'Hasil kesepakatan sidang-sidang kelompok Musrenbang Kecamatan Samudera Kabupaten Aceh Utara Tahun 2014 dan Daftar Peserta Musrenbang RKPD Kecamatan dan Dokumentasi sebagaimana tercantum dalam Lampiran IV, V dan VI yang merupakan satu kesatuan dan merupakan bagian yang tidak terpisahkan dari berita ini.', '', 'L', 0);
$ln = $pdf->GetY();
$pdf->SetXY(20,$ln);
$pdf->MultiCell(150,5,'KEEMPAT    :', '', 'L', 0);
$pdf->SetXY(50,$ln);
$pdf->MultiCell(150,5,'Berita Acara ini dijadikan sebagai bahan penyusunan rancangan RKPD Kabupaten Aceh Utara Tahun 2015 ', '', 'L', 0);
$pdf->MultiCell(180,5,'        Demikian berita acara ini dibuat dan disahkan untuk digunakan sebagaimana mestinya.', '', 'L', 0);

$pdf->SetY($pdf->GetY()+10);
$pdf->MultiCell(80,5,Yii::$app->user->identity->tperan->kd_kecamatan <> NULL ? Yii::$app->user->identity->tperan->kecamatan->kecamatan.' '.nama_hari(DATE('w', strtotime($model->tanggal_ba))).', '.DATE('d', strtotime($model->tanggal_ba)).' '.nama_bulan(DATE('m', strtotime($model->tanggal_ba))).' '.DATE('Y', strtotime($model->tanggal_ba))
	: 'Kecamatan, '.nama_hari(DATE('w', strtotime($model->tanggal_ba))).', '.DATE('d', strtotime($model->tanggal_ba)).' '.nama_bulan(DATE('m', strtotime($model->tanggal_ba))).' '.DATE('Y', strtotime($model->tanggal_ba)), '', 'C', 0);
$pdf->SetY($pdf->GetY());
$pdf->MultiCell(80,5,'Pimpinan Sidang', '', 'C', 0);
$pdf->SetY($pdf->GetY()+30);
$pdf->MultiCell(80,5,'Nama pengunggah', '', 'C', 0);	
$pdf->SetY($pdf->GetY());
$pdf->MultiCell(80,5,'NIP 19900425 201210 1 001', '', 'C', 0);	


//Menambahkan halaman, untuk menambahkan halaman tambahkan command ini. P artinya potrait dan L artinya Landscape
//Hal12 untuk pembuka berita acara-----------------------------------------------------------------
$pdf->AddPage("P","A4");
$pdf->SetAutoPageBreak(true, 10);
$pdf->AliasNbPages();
$pdf->setmargins(20,10, 10);
$pdf->SetXY(83,10);
$pdf->SetFont('Arial','',12); 
$pdf->MultiCell(135,5,'LAMPIRAN II :', '', 'L', 0);
$pdf->SetXY(111,10);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(89,5,'Berita Acara Hasil Kesepakatan Musrenbang RKPD Kabupaten Simulasi di Kecamatan Banyuasin Tahun 2017', '', 'L', 0);
$y = $pdf->GetY();
$pdf->SetXY(111, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(22,5,'Nomor', '', 'L', 0);
$pdf->SetXY(133, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(2,5,': ', '', 'L', 0);
$pdf->SetXY(135, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(65,5,'Nomor SURAT Sekian', '', 'L', 0);
$y = $pdf->GetY();
$pdf->SetXY(111, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(89,5,'Tanggal', 'B', 'L', 0);
$pdf->SetXY(133, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(2,5,': ', '', 'L', 0);
$pdf->SetXY(135, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(65,5,DATE('d-m-Y'), '', 'L', 0);

$y = $pdf->GetY();
$pdf->SetXY(10, $y+5);
$pdf->SetFont('Arial','B',12); 
$pdf->MultiCell(180,5,'Daftar Hadir Peserta Musrenbang Kecamatan', '', 'C', 0);
$y = $pdf->GetY()+5;
$pdf->SetXY(20, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(22,5,'Kecamatan', '', 'L', 0);
$pdf->SetXY(42, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(2,5,': ', '', 'L', 0);
$pdf->SetXY(44, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(65,5,Yii::$app->user->identity->tperan->kd_kecamatan <> NULL ? Yii::$app->user->identity->tperan->kecamatan->kecamatan : 'anda bukan user kecamatan', '', 'L', 0);
$y = $pdf->GetY();
$pdf->SetXY(20, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(22,5,'Tahun', '', 'L', 0);
$pdf->SetXY(42, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(2,5,': ', '', 'L', 0);
$pdf->SetXY(44, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(65,5,'2017', '', 'L', 0);
$pdf->Ln();

//bagian untuk tabel
// Column widths
$w = array(15, 55, 40, 40, 30);
/*isi ln dari string
30 = 14
40 = 18
15 = 7
*/
$header = array('No', 'Nama', 'Lembaga/Instansi', 'Alamat & No Telp.', 'Tanda Tangan');
$header2 = array('1', '2', '3', '4', '5');
// Header
$pdf->SetX(20);
$pdf->SetFont('Arial','B',10); 
for($i=0;$i<count($header);$i++)
	$pdf->Cell($w[$i],5,$header[$i],1,0,'C');
$pdf->Ln();
for($i=0;$i<count($header2);$i++)
	$pdf->Cell($w[$i],5,$header2[$i],1,0,'C');
$pdf->Ln();
$ln = $pdf->GetY();
$x = 20;
$pdf->Rect($x,$ln, $w['0'], (270-$ln));
$pdf->Rect($x+$w['0'],$ln, $w['1'], (270-$ln));
$pdf->Rect($x+$w['0']+$w['1'],$ln, $w['2'], (270-$ln));
$pdf->Rect($x+$w['0']+$w['1']+$w['2'],$ln, $w['3'], (270-$ln));
$pdf->Rect($x+$w['0']+$w['1']+$w['2']+$w['3'],$ln, $w['4'], (270-$ln));



//Menambahkan halaman, untuk menambahkan halaman tambahkan command ini. P artinya potrait dan L artinya Landscape
//hal3 untuk Lampiran II Musren---------------------------------------------------------------------
$pdf->AddPage("L","A4");
$pdf->SetAutoPageBreak(true, 10);
$pdf->AliasNbPages();
$pdf->setmargins(10,10);

$pdf->SetXY(170,10);
$pdf->SetFont('Arial','',12); 
$pdf->MultiCell(135,5,'LAMPIRAN II :', '', 'L', 0);
$pdf->SetXY(198,10);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(89,5,'Berita Acara Hasil Kesepakatan Musrenbang RKPD Kabupaten Simulasi di Kecamatan Banyuasin Tahun 2017', '', 'L', 0);
$y = $pdf->GetY();
$pdf->SetXY(198, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(22,5,'Nomor', '', 'L', 0);
$pdf->SetXY(220, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(2,5,': ', '', 'L', 0);
$pdf->SetXY(222, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(65,5,'Nomor SURAT Sekian', '', 'L', 0);
$y = $pdf->GetY();
$pdf->SetXY(198, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(89,5,'Tanggal', 'B', 'L', 0);
$pdf->SetXY(220, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(2,5,': ', '', 'L', 0);
$pdf->SetXY(222, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(65,5,DATE('d-m-Y'), '', 'L', 0);

$y = $pdf->GetY();
$pdf->SetXY(10, $y+5);
$pdf->SetFont('Arial','B',12); 
$pdf->MultiCell(277,5,'Daftar Urutan Kegiatan Prioritas Kecamatan Menurut SKPD', '', 'C', 0);
$y = $pdf->GetY()+5;
$pdf->SetXY(10, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(22,5,'Kecamatan', '', 'L', 0);
$pdf->SetXY(32, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(2,5,': ', '', 'L', 0);
$pdf->SetXY(34, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(65,5,Yii::$app->user->identity->tperan->kd_kecamatan <> NULL ? Yii::$app->user->identity->tperan->kecamatan->kecamatan : 'anda bukan user kecamatan', '', 'L', 0);
$y = $pdf->GetY();
$pdf->SetXY(10, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(22,5,'Tahun', '', 'L', 0);
$pdf->SetXY(32, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(2,5,': ', '', 'L', 0);
$pdf->SetXY(34, $y);
$pdf->SetFont('Arial','',11); 
$pdf->MultiCell(65,5,'2017', '', 'L', 0);
$pdf->Ln();

//bagian untuk tabel
// Column widths
$w = array(8, 30, 30, 40, 40, 40, 30, 15, 15, 30);
/*isi ln dari string
30 = 14
40 = 18
15 = 7
*/
$header = array('No', 'Prioritas Daerah', 'Sasaran Daerah', 'Program', 'Kegiatan Prioritas', 'Sasaran Kegiatan', 'Lokasi', 'Volume', 'Pagu', 'SKPD');
$header2 = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10');
// Header
$pdf->SetX(10);
$pdf->SetFont('Arial','B',10); 
for($i=0;$i<count($header);$i++)
	$pdf->Cell($w[$i],5,$header[$i],1,0,'C');
$pdf->Ln();
for($i=0;$i<count($header2);$i++)
	$pdf->Cell($w[$i],5,$header2[$i],1,0,'C');
$pdf->Ln();

// Data
$pdf->SetFont('Arial','',10); 
$i = 1;
$sarde = $program = $kegiatan = $sarkeg = NULL;
$y = $yst = $y1 = $y2 = $y3 = $y4 = $y5 = $y6 = $y7 = $y8 = $y9 = $y10 = $pdf->GetY();
$x = 10;
foreach ($data as $data ) {
	$height = array();
	$height[] = $y4 + ((strlen($data['program'])/18)*5);
	$height[] = $y5 + ((strlen($data['kegiatan_prioritas'])/18)*5);
	$height[] = $y6 + ((strlen($data['uraian'])/18)*5);
	$height[] = $y7 + ((strlen($data['kd_kelurahan'])/14)*5);
	$height[] = $y8 + ((strlen($data['volume'])/7)*5);
	$height[] = $y9 + ((strlen($data['biaya'])/7)*5);
	$height[] = $y10 + ((strlen($data['Nm_Sub_Unit'])/14)*5);

	$t = max($height);

	IF($t > 190 ){
		$y = max($y4, $y5, $y6, $y7, $y8, $y9, $y10);
		$pdf->Rect($x,$yst, $w['0'], ($y-$yst));
		$pdf->Rect($x+$w['0'],$yst, $w['1'], ($y-$yst));
		$pdf->Rect($x+$w['0']+$w['1'],$yst, $w['2'], ($y-$yst));
		$pdf->Rect($x+$w['0']+$w['1']+$w['2'],$yst, $w['3'], ($y-$yst));
		$pdf->Rect($x+$w['0']+$w['1']+$w['2']+$w['3'],$yst, $w['4'], ($y-$yst));
		$pdf->Rect($x+$w['0']+$w['1']+$w['2']+$w['3']+$w['4'],$yst, $w['5'], ($y-$yst));
		$pdf->Rect($x+$w['0']+$w['1']+$w['2']+$w['3']+$w['4']+$w['5'],$yst, $w['6'], ($y-$yst));
		$pdf->Rect($x+$w['0']+$w['1']+$w['2']+$w['3']+$w['4']+$w['5']+$w['6'],$yst, $w['7'], ($y-$yst));
		$pdf->Rect($x+$w['0']+$w['1']+$w['2']+$w['3']+$w['4']+$w['5']+$w['6']+$w['7'],$yst, $w['8'], ($y-$yst));
		$pdf->Rect($x+$w['0']+$w['1']+$w['2']+$w['3']+$w['4']+$w['5']+$w['6']+$w['7']+$w['8'],$yst, $w['9'], ($y-$yst));
		$pdf->AddPage("L","A4");
		$w = array(8, 30, 30, 40, 40, 40, 30, 15, 15, 30);
		$header = array('No', 'Prioritas Daerah', 'Sasaran Daerah', 'Program', 'Kegiatan Prioritas', 'Sasaran Kegiatan', 'Lokasi', 'Volume', 'Pagu', 'SKPD');
		$header2 = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10');
		// Header
		$pdf->SetX(10);
		$pdf->SetFont('Arial','B',10); 
		for($i=0;$i<count($header);$i++)
			$pdf->Cell($w[$i],5,$header[$i],1,0,'C');
		$pdf->Ln();
		for($i=0;$i<count($header2);$i++)
			$pdf->Cell($w[$i],5,$header2[$i],1,0,'C');
		$pdf->Ln();

		// Data
		$pdf->SetFont('Arial','',10); 
		$y = $yst = $y1 = $y2 = $y3 = $y4 = $y5 = $y6 = $y7 = $y8 = $y9 = $y10 = 20;
		$x = 10;	
	}



	IF($program == $data['program']){

		IF($kegiatan == $data['kegiatan_prioritas']){

			$y = max($y6, $y7, $y8, $y9, $y10);
			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['0'], 5, '', '', 'C', 0);
			$x += $w['0'];
			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['1'], 5, '', '', 'C', 0);
			$x += $w['1'];
			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['2'], 5, '', '', 'C', 0);
			$x += $w['2'];
			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['3'], 5, '', '', 'L', 0);
			$x += $w['3'];
			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['4'], 5, '', '', 'L', 0);
			$x += $w['4'];
			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['5'], 5, $data['uraian'], 'T', 'L', 0);
			$y6 = $pdf->GetY();
			$x += $w['5'];
			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['6'], 5, $data['kd_kelurahan'], 'T', 'C', 0);
			$y7 = $pdf->GetY();
			$x += $w['6'];
			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['7'], 5, $data['volume'].' '.$data['satuan'], 'T', 'L', 0);
			$y8 = $pdf->GetY();
			$x += $w['7'];
			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['8'], 5, angka($data['biaya']), 'T', 'R', 0);
			$y9 = $pdf->GetY();
			$x += $w['8'];
			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['9'], 5, $data['Nm_Sub_Unit'], 'T', 'L', 0);
			$y10 = $pdf->GetY();

			$x = 10;
		}ELSE{

			$y = max($y5, $y6, $y7, $y8, $y9, $y10);

			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['0'], 5, '', '', 'C', 0);
			$x += $w['0'];
			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['1'], 5, '', '', 'C', 0);
			$x += $w['1'];
			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['2'], 5, '', '', 'C', 0);
			$x += $w['2'];
			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['3'], 5, '', '', 'L', 0);
			$x += $w['3'];
			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['4'], 5, $data['kegiatan_prioritas'], 'T', 'L', 0);
			$y5 = $pdf->GetY();
			$x += $w['4'];
			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['5'], 5, $data['uraian'], 'T', 'L', 0);
			$y6 = $pdf->GetY();
			$x += $w['5'];
			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['6'], 5, $data['kd_kelurahan'], 'T', 'C', 0);
			$y7 = $pdf->GetY();
			$x += $w['6'];
			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['7'], 5, $data['volume'].' '.$data['satuan'], 'T', 'L', 0);
			$y8 = $pdf->GetY();
			$x += $w['7'];
			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['8'], 5, angka($data['biaya']), 'T', 'R', 0);
			$y9 = $pdf->GetY();
			$x += $w['8'];
			$pdf->SetXY($x, $y);
			$pdf->MultiCell($w['9'], 5, $data['Nm_Sub_Unit'], 'T', 'L', 0);
			$y10 = $pdf->GetY();

			$x = 10;

		}

		$kegiatan = $data['kegiatan_prioritas'];

	}ELSE{
		$y = max($y4, $y5, $y6, $y7, $y8, $y9, $y10);
		$pdf->SetXY($x, $y);
		$pdf->MultiCell($w['0'], 5, $i, '', 'C', 0);
		$x += $w['0'];
		$pdf->SetXY($x, $y);
		$pdf->MultiCell($w['1'], 5, 'Ekonomi', 'T', 'C', 0);
		$x += $w['1'];
		$pdf->SetXY($x, $y);
		$pdf->MultiCell($w['2'], 5, '', '', 'C', 0);
		$x += $w['2'];
		$pdf->SetXY($x, $y);
		$pdf->MultiCell($w['3'], 5, $data['program'], 'T', 'L', 0);
		$y4 = $pdf->GetY();		
		$x += $w['3'];
		$pdf->SetXY($x, $y);
		$pdf->MultiCell($w['4'], 5, $data['kegiatan_prioritas'], 'T', 'L', 0);
		$y5 = $pdf->GetY();		
		$x += $w['4'];
		$pdf->SetXY($x, $y);
		$pdf->MultiCell($w['5'], 5, $data['uraian'], 'T', 'L', 0);
		$y6 = $pdf->GetY();		
		$x += $w['5'];
		$pdf->SetXY($x, $y);
		$pdf->MultiCell($w['6'], 5, $data['kd_kelurahan'], 'T', 'C', 0);
		$y7 = $pdf->GetY();		
		$x += $w['6'];
		$pdf->SetXY($x, $y);
		$pdf->MultiCell($w['7'], 5, $data['volume'].' '.$data['satuan'], 'T', 'L', 0);
		$y8 = $pdf->GetY();		
		$x += $w['7'];
		$pdf->SetXY($x, $y);
		$pdf->MultiCell($w['8'], 5, angka($data['biaya']), 'T', 'R', 0);
		$y9 = $pdf->GetY();		
		$x += $w['8'];
		$pdf->SetXY($x, $y);
		$pdf->MultiCell($w['9'], 5, $data['Nm_Sub_Unit'], 'T', 'L', 0);
		$y10 = $pdf->GetY();

		$x = 10;
		$i++;
	}
	$program = $data['program'];
	$kegiatan = $data['kegiatan_prioritas'];
	
}

//Rect terakhir
$y = max($y4, $y5, $y6, $y7, $y8, $y9, $y10);
$pdf->Rect($x,$yst, $w['0'], ($y-$yst));
$pdf->Rect($x+$w['0'],$yst, $w['1'], ($y-$yst));
$pdf->Rect($x+$w['0']+$w['1'],$yst, $w['2'], ($y-$yst));
$pdf->Rect($x+$w['0']+$w['1']+$w['2'],$yst, $w['3'], ($y-$yst));
$pdf->Rect($x+$w['0']+$w['1']+$w['2']+$w['3'],$yst, $w['4'], ($y-$yst));
$pdf->Rect($x+$w['0']+$w['1']+$w['2']+$w['3']+$w['4'],$yst, $w['5'], ($y-$yst));
$pdf->Rect($x+$w['0']+$w['1']+$w['2']+$w['3']+$w['4']+$w['5'],$yst, $w['6'], ($y-$yst));
$pdf->Rect($x+$w['0']+$w['1']+$w['2']+$w['3']+$w['4']+$w['5']+$w['6'],$yst, $w['7'], ($y-$yst));
$pdf->Rect($x+$w['0']+$w['1']+$w['2']+$w['3']+$w['4']+$w['5']+$w['6']+$w['7'],$yst, $w['8'], ($y-$yst));
$pdf->Rect($x+$w['0']+$w['1']+$w['2']+$w['3']+$w['4']+$w['5']+$w['6']+$w['7']+$w['8'],$yst, $w['9'], ($y-$yst));
/*
// Closing line
$pdf->Ln();
$pdf->SetX(10);
$pdf->Cell(array_sum($w),0,'','T');
*/
	

//Untuk mengakhiri dokumen pdf, dan mengirip dokumen ke output
$pdf->Output();
exit;
?>
