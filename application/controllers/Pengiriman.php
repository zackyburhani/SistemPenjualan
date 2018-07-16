<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengiriman extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Model_Pengiriman');
	}

	//halaman awal
	public function index()
	{
		$getPO = $this->Model_Pengiriman->getPO();
		$getSJ = $this->Model_Pengiriman->getSJ();
		$kd_SJ = $this->Model_Pengiriman->getKd_SJ();

		$data = [
			'getPO' => $getPO,
			'kd_SJ' => $kd_SJ,
			'getSJ' => $getSJ
		];

		$this->load->view('template/V_Header',$data);
		$this->load->view('template/V_Sidebar');
		$this->load->view('transaksi/Pengiriman');
		$this->load->view('template/V_Footer');
	}

	public function simpan()
	{
		$no_sj = $this->input->post('no_sj');
		$no_po = $this->input->post('no_po');
	
		$po = $this->Model_Pengiriman->getSuratJalan($no_po);

		$data = [
			'no_sj' => $no_sj,
			'tgl_sj' => $po->tgl_po,
			'no_po' => $no_po,
		];

		$result = $this->Model_Pengiriman->simpan($data);

		if($result){
			$this->session->set_flashdata('pesan','Data Berhasil Disimpan');
		   		redirect('Pengiriman');
		} else{
			$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Disimpan');
    		redirect('Pengiriman');
		}
	}

	public function ubah()
	{
		$no_sj = $this->input->post('no_sj');
		$no_po = $this->input->post('no_po');
	
		$po = $this->Model_Pengiriman->getSuratJalan($no_po);

		$data = [
			'tgl_sj' => $po->tgl_po,
			'no_po' => $no_po,
		];

		$result = $this->Model_Pengiriman->update($no_sj,$data);

		if($result){
			$this->session->set_flashdata('pesan','Data Berhasil Diubah');
		   		redirect('Pengiriman');
		} else{
			$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Diubah');
    		redirect('Pengiriman');
		}
	}

	public function hapus()
	{
		$no_sj = $this->input->post('no_sj');
		$result = $this->Model_Pengiriman->hapus($no_sj);

		if($result){
			$this->session->set_flashdata('pesan','Data Berhasil Dihapus');
		   		redirect('Pengiriman');
		} else{
			$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Dihapus');
    		redirect('Pengiriman');
		}
	}

	//cetak laporan SJ dalam bentuk pdf
	public function cetakSJ($no_sj,$tgl_sj,$no_po)
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
        $pdf->Cell(190,10,'Surat Jalan',0,1,'C');
        
        $pdf->Cell(10,-1,'',0,1);

        $pengiriman = $this->Model_Pengiriman->lapPengiriman($no_sj);

        $pengiriman_fetch = $this->Model_Pengiriman->lapPengiriman_fetch($no_sj);

        $pdf->SetFont('Arial','',9);

        $pdf->Cell(25,6,'Nomor Surat',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$no_sj,0,0,'L');
        
        $pdf->Cell(55,6,'',0,0,'C');
        $pdf->Cell(40,6,'Tanggal Purchase Order',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(20,6,''.tanggal($tgl_sj),0,1,'L');

        $pdf->Cell(25,6,'Purchase Order',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$no_po,0,0,'L');
        
        $pdf->Cell(55,6,'',0,0,'C');
        $pdf->Cell(40,6,'Tanggal Pengiriman',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(20,6,''.tanggal($pengiriman_fetch->tgl_kirim),0,1,'L');

        $pdf->Cell(25,6,'Kepada',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$pengiriman_fetch->nm_plg,0,1,'L');

        $pdf->Cell(25,6,'Telepon',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$pengiriman_fetch->telepon,0,1,'L');

        $pdf->Cell(25,6,'Alamat',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$pengiriman_fetch->alamat,0,1,'L');


        $pdf->Cell(190,5,' ',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,1,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(10,6,'No.',1,0,'C');
        $pdf->Cell(40,6,'Kode Barang',1,0,'C');
        $pdf->Cell(60,6,'Nama Barang',1,0,'C');
        $pdf->Cell(40,6,'Jenis Barang',1,0,'C');
        $pdf->Cell(20,6,'Satuan',1,0,'C');
        $pdf->Cell(20,6,'Jumlah',1,1,'C');
        $pdf->SetFont('Arial','',8);

        $tampung = array();
        $no = 1;
        foreach ($pengiriman as $row)
        {
            $pdf->Cell(10,6,$no++.".",1,0,'C');
            $pdf->Cell(40,6,$row->kd_brg,1,0,'C');
            $pdf->Cell(60,6,ucwords($row->nm_brg),1,0);
            $pdf->Cell(40,6,$row->jns_brg,1,0,'C');
            $pdf->Cell(20,6,$row->satuan,1,0,'C');
            $pdf->Cell(20,6,$row->jml_brg,1,1,'C');
            $tampung[] = $row->jml_brg*$row->harga;
        }
        
        $pdf->Cell(10,10,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(63,6,'Tanda Terima',0,0,'C');
        $pdf->Cell(63,6,'Kurir',0,0,'C');
        $pdf->Cell(64,6,'Hormat Kami',0,1,'C');

        $pdf->Cell(10,20,'',0,1);

        $pdf->Cell(63,6,'( '.$pengiriman_fetch->nm_plg.' )',0,0,'C');
        $pdf->Cell(63,6,'(.....................................)',0,0,'C');
        $pdf->Cell(64,6,'( Admininstrator )',0,0,'C');
        

        $pdf->Output();
    }

}
