<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanPengiriman extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Model_Laporan');
	}

	public function index()
	{
		$this->load->view('template/V_Header');
		$this->load->view('template/V_Sidebar');
		$this->load->view('laporan/LapPengiriman');
		$this->load->view('template/V_Footer');
	}

	public function cetakLapPengiriman()
    {
    	$awal = $this->input->get('awal');
    	$akhir = $this->input->get('akhir');

    	if($akhir < $awal){
            $this->session->set_flashdata('pesanGagal','Tanggal Tidak Valid');
    		redirect('LaporanPengiriman');
    	}

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
        $pdf->Cell(190,10,'LAPORAN PENGIRIMAN BARANG PERIODE '.tanggal($awal). ' SAMPAI '.tanggal($akhir),0,1,'C');
        
        $pdf->Cell(10,-1,'',0,1);

        $pemesanan = $this->Model_Laporan->lapPengiriman($awal,$akhir);

        if($pemesanan == null) {
            $this->session->set_flashdata('pesanGagal','Data Tidak Ditemukan');
        	redirect('LaporanPengiriman');
        }

        $pdf->Cell(190,5,' ',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,1,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(10,6,'No.',1,0,'C');
        $pdf->Cell(25,6,'No. Surat Jalan',1,0,'C');
        $pdf->Cell(25,6,'Tgl. Surat Jalan',1,0,'C');
        $pdf->Cell(55,6,'Nama Barang',1,0,'C');
        $pdf->Cell(30,6,'Jenis',1,0,'C');
        $pdf->Cell(20,6,'Satuan',1,0,'C');
        $pdf->Cell(25,6,'Jumlah Barang',1,1,'C');
        $pdf->SetFont('Arial','',8);

        $tampung = array();
        $no = 1;
        foreach ($pemesanan as $row)
        {
            $pdf->Cell(10,6,$no++.".",1,0,'C');
            $pdf->Cell(25,6,$row->no_sj,1,0,'C');
            $pdf->Cell(25,6,tanggal($row->tgl_sj),1,0,'C');
            $pdf->Cell(55,6,ucwords($row->nm_brg),1,0,'C');
            $pdf->Cell(30,6,ucwords($row->jns_brg),1,0,'C');
            $pdf->Cell(20,6,ucwords($row->satuan),1,0,'C');
            $pdf->Cell(25,6,$row->jml_brg,1,1,'C');
        }

        $pdf->Output();
    }

}
