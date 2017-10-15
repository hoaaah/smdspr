<?php
Use app\itbz\fpdf\src\fpdf\fpdf;

$header = array('No', 'Kegiatan', 'Pagu Musren', 'Total Usulan');


//menugaskan variabel $pdf pada function fpdf().
$pdf = new \fpdf\FPDF();
//Menambahkan halaman, untuk menambahkan halaman tambahkan command ini. P artinya potrait dan L artinya Landscape
$pdf->AddPage("P","A4");
//cara menambahkan image dalam dokumen. Urutan data-> alamat file-posisi X- posisi Y-ukuran width - ukurang high -  menambahkan link bila perlu
$pdf->Image('http://www.bpkp.go.id/public/upload/unit/gorontalo/images/logo%20bpkp%20ukuran%20sedang.jpg',25.4,10,40,20,'','http://www.belajararief.com');

$pdf->SetXY(65.4,10);
$pdf->SetFont('Arial','B',13); 
$pdf->MultiCell(135,7,'BADAN PENGAWASAN KEUANGAN DAN PEMBANGUNAN', '', 'C', 0);
$pdf->SetXY(65.4,15);
$pdf->SetFont('Arial','B',12); 
$pdf->MultiCell(135,7,'PERWAKILAN PROVINSI SUMATERA SELATAN', '', 'C', 0);
$pdf->SetXY(65.4,20);
$pdf->SetFont('Arial','',10); 
$pdf->MultiCell(135,7,'Jalan Bank Raya 2,  Demang Lebar Daun, Palembang 30128', '', 'C', 0);
$pdf->SetXY(65.4,25);
$pdf->SetFont('Arial','',10); 
$pdf->MultiCell(135,7,'Telepon 0711- 311154, 355034  Faksimile 374987', '', 'C', 0);
$pdf->SetXY(65.4,30);
$pdf->SetFont('Arial','',10); 
$pdf->MultiCell(135,7,'E-mail : sumsel@bpkp.go.id', '', 'C', 0);
$pdf->SetXY(25.4,36);
$pdf->SetFont('Arial','',10); 
$pdf->MultiCell(173,7,'', '', 'C', 0);
$pdf->SetLineWidth(0.7);
$pdf->Line(25.4,36,199.1,36);


//ISI 
$pdf->SetXY(25.4,40);
$pdf->SetFont('Arial','',12); 
$pdf->MultiCell(173,7,'Palembang, '.DATE('d M Y'), '', 'R', 0);
$pdf->SetXY(25.4,55);
$pdf->MultiCell(173,7,'Dalam rangka mendukung terciptanya transfer of knowledge dalam lingkungan Perwakilan BPKP Provinsi Sumatera Selatan, maka dibutuhkan sebuah wadah informasi sebagai pusat data yang menghimpun informasi dan materi mengenai pengembangan profesi di lingkungan kerja.', '', 'L', 0);

$pdf->SetX(25.4);
$pdf->MultiCell(173,7,'Untuk mendukung hal tersebut saya yang bertanda tangan di bawah ini telah mengupload file berupa materi PPM pada aplikasi SIMOKU dengan rincian sebagai berikut:', '', 'L', 0);
$pdf->Ln();

//bagian untuk tabel
// Column widths
$w = array(8, 100, 35, 35);
// Header
$pdf->SetX(25.4);
for($i=0;$i<count($header);$i++)
	$pdf->Cell($w[$i],7,$header[$i],1,0,'C');
$pdf->Ln();
// Data
$j = 1;
foreach ($data as $data ) {
		$pdf->SetX(25.4);
		$pdf->Cell($w[0],6,$j,'LR',0, 'C');
		$pdf->Cell($w[1],6,substr($data['kegiatan'], 0, 45),'LR');
		$pdf->Cell($w[2],6,"Rp".number_format($data['pagu_musrenbang'], 0, ',','.'),'LR',0,'R');
		$pdf->Cell($w[3],6,$data['Usulan'],'LR',0,'R');
		$pdf->Ln();		
		$j++;
}

// Closing line
$pdf->SetX(25.4);
$pdf->Cell(array_sum($w),0,'','T');


$pdf->SetFont('Arial','',12); 
$pdf->Ln();
$pdf->SetX(25.4);
$pdf->MultiCell(173,7,'Demikian surat pernyataan ini dibuat semata-mata untuk mendukung terciptanya transfer of knowledge dalam lingkungan unit kerja saya. Saya menyatakan bertanggung jawab terhadap dokumen yang saya upload tersebut beserta penggunaanya menjadi tanggung jawab user yang mengunduh untuk dapat digunakan dengan bijak.', '', 'L', 0);

//ketentuan cuti disini bisa berubah tergantung tipe cuti

	$pdf->SetXY(120,253);
	$pdf->MultiCell(60,7,'Pengunggah,'.$pdf->getY(), '', 'C', 0);
	$pdf->SetXY(120,265);
	$pdf->MultiCell(60,7,'Nama pengunggah', '', 'C', 0);	
	$pdf->SetXY(120, 267);
	$pdf->MultiCell(60,7,'NIP 19900425 201210 1 001', '', 'C', 0);	

//Untuk mengakhiri dokumen pdf, dan mengirip dokumen ke output
$pdf->Output();
exit;
?>
