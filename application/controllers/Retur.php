<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model(['Model_Retur']);
	}

	//halaman awal
	public function index()
	{
		$getRetur = $this->Model_Retur->getRetur();

		$data = [
			'getRetur' => $getRetur
		];

		$this->load->view('template/V_Header',$data);
		$this->load->view('template/V_Sidebar');
		$this->load->view('transaksi/Retur');
		$this->load->view('template/V_Footer');
	}

	public function Cari()
	{
		$cari = $this->input->get('faktur');

		$faktur = $this->Model_Retur->cari($cari);
		$cari_fetch = $this->Model_Retur->cari_fetch($cari);
		$no_retur = $this->Model_Retur->getKdRetur();
		$getRetur = $this->Model_Retur->getRetur();
		
		$data = [
			'getRetur' => $getRetur,
			'no_retur' => $no_retur,
			'no_faktur' => $cari,
			'cari_fetch' => $cari_fetch,
			'Faktur' => $faktur
		];

		$this->load->view('template/V_Header',$data);
		$this->load->view('template/V_Sidebar');
		$this->load->view('transaksi/Retur');
		$this->load->view('template/V_Footer');	
	}

	public function ReturBarang()
	{
		$no_faktur = $this->input->post('no_faktur');
		$no_retur = $this->input->post('no_retur');
		$baris = $this->Model_Retur->baris($no_faktur);

		$b = "barang";
		$barang = array();
		for($i=1; $i<=$baris; $i++){
			$barang[] = $this->input->post($b.$i);
		}
		
		$barang1 = array_filter($barang);
		$barang1 = array_values($barang1);

		$lemparBaris = count($barang1);
		$konten = array();
		$q=0;
		for($i=1; $i<=$lemparBaris; $i++){
			$konten[] = $this->Model_Retur->retur($barang1[$q++]);
		}		

		if($konten == null){
			$this->session->set_flashdata('pesanGagal','Data Tidak Ditemukan');
			redirect('Retur');
		}

		$variable = [
			'baris' => $lemparBaris,
			'no_faktur' => $no_faktur,
			'no_retur' => $no_retur,
			'konten' =>$konten
		];

		$this->load->view('template/V_Header',$variable);
		$this->load->view('template/V_Sidebar');
		$this->load->view('transaksi/UbahRetur');
		$this->load->view('template/V_Footer');	
		
	}

	public function simpan()
	{
		$no_retur = $this->input->post('no_retur');
		$baris = $this->input->post('baris');
		$no_faktur = $this->input->post('no_faktur');

		$b = "barang";
		$barang = array();
		for($i=1; $i<=$baris; $i++){
			$barang[] = $this->input->post($b.$i);
		}

		$j = "jml_retur";
		$jml_brg = array();
		for($i=1; $i<=$baris; $i++){
			$jml_retur[] = $this->input->post($j.$i);
		}

		//cek jumlah barang retur
		$b=0;
		$r=0;
		$n=0;
		for($i=1; $i<=$baris; $i++){
			$jmlBrg = $this->Model_Retur->getJmlBrg_fetch($barang[$b++]);
			if($jml_retur[$r++] > $jmlBrg->jml_brg){
				$this->session->set_flashdata('pesanGagal','Jumlah Retur Tidak Boleh Lebih Dari Jumlah Pesan');
				redirect('Retur');
			} 
		}

		$data = [
			'no_retur' => $no_retur,
			'tgl_retur' => date('Y-m-d'),
			'no_faktur' => $no_faktur
		];

		$result = $this->Model_Retur->simpan($data);

		$q=0;
		$m=0;
		for($i=1; $i<=$baris; $i++){
			$detailretur = [
				'no_retur' => $no_retur,
				'kd_brg' => $barang[$q++],
				'jml_retur' => $jml_retur[$m++]
			];
			$result2 = $this->Model_Retur->simpanDetail($detailretur);
		}

		//update stok barang setelah retur
		$n=0;
		$m=0;
		$b=0;
		for($i=1; $i<=$baris; $i++){
			$stok = $this->Model_Retur->getJmlBrg_fetch($barang[$b++]);
			$kurang = $stok->stok-$jml_retur[$m++];
			$update = [
				'stok' => $kurang
			];
			$result3 = $this->Model_Retur->updateStok($barang[$n++],$update);
		}

		if($result && $result2){
			$this->session->set_flashdata('pesan','Data Berhasil Disimpan');
		   	redirect('Retur');
		} else{
			$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Disimpan');
    		redirect('Retur');
		}
	}

	public function cetakRetur($no_retur,$tgl_faktur,$no_faktur)
	{
		$pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        //cetak gambar
        $image1 = "assets/img/logo.png";
        $pdf->Cell(1, 0, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 35.20), 0, 0, 'L', false );
        // mencetak string
        $pdf->Cell(186,10,'PT. Trimitra Inti Gemilang',0,1,'C');
        $pdf->Cell(9,1,'',0,1);
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(186,1,'Komplek Duta Harapan Indah Blok ii No.24',0,1,'C');
        $pdf->Cell(186,7,'Jl. Kapuk Muara No.7 Jakarta Utara',0,1,'C');
        $pdf->Cell(186,1,'Telp : (021) 6683836',0,1,'C');
        $pdf->Cell(186,6,'Fax : (021) 6683325',0,1,'C');
        $pdf->Cell(186,1,'Email : tigemilang@yahoo.com',0,1,'C');

        $pdf->Line(10, 42, 210-11, 42); 
        $pdf->SetLineWidth(0.5); 
        $pdf->Line(10, 42, 210-11, 42);
        $pdf->SetLineWidth(0);     
            
        $pdf->ln(6);        
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(190,10,'RETUR',0,1,'C');
        
        $pdf->Cell(10,-1,'',0,1);

        $retur = $this->Model_Retur->cetakRetur($no_retur);

        $retur_fetch = $this->Model_Retur->cetakRetur_fetch($no_retur);

        $pdf->SetFont('Arial','',9);

        $pdf->Cell(25,6,'Nomor Retur',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$retur_fetch->no_retur,0,0,'L');
        
        $pdf->Cell(65,6,'',0,0,'C');
        $pdf->Cell(30,6,'Tanggal Retur',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(20,6,''.tanggal($retur_fetch->tgl_retur),0,1,'L');

        $pdf->Cell(25,6,'Kepada',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$retur_fetch->nm_plg,0,0,'L');
        
        $pdf->Cell(65,6,'',0,0,'C');
        $pdf->Cell(30,6,'Nomor Faktur',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(20,6,''.$no_faktur,0,1,'L');

		$pdf->Cell(25,6,'Telepon',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$retur_fetch->telepon,0,1,'L');

        $pdf->Cell(25,6,'Alamat',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$retur_fetch->alamat,0,1,'L');

        $pdf->Cell(190,5,' ',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,1,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(10,6,'No.',1,0,'C');
        $pdf->Cell(40,6,'Kode Barang',1,0,'C');
        $pdf->Cell(110,6,'Nama Barang',1,0,'C');
        $pdf->Cell(30,6,'Jumlah Retur',1,1,'C');
        $pdf->SetFont('Arial','',8);

        $tampung = array();
        $no = 1;
        foreach ($retur as $row)
        {
            $pdf->Cell(10,6,$no++.".",1,0,'C');
            $pdf->Cell(40,6,$row->kd_brg,1,0,'C');
            $pdf->Cell(110,6,ucwords($row->nm_brg),1,0);
            $pdf->Cell(30,6,$row->jml_retur,1,1,'C');
        }

        $pdf->Cell(10,20,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(63,6,'Tanda Terima',0,0,'C');
        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(63,6,'Hormat Kami',0,1,'C');

        $pdf->Cell(10,20,'',0,1);

        $pdf->Cell(63,6,'( '.$retur_fetch->nm_plg.' )',0,0,'C');
        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(63,6,'( Admininstrator )',0,0,'C');
        

        $pdf->Output();
	}

}
