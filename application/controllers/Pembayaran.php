<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Model_Pembayaran');
	}

	//halaman awal
	public function index()
	{
		$getPembayaran = $this->Model_Pembayaran->getPembayaran();
		$kd_stt = $this->Model_Pembayaran->getKdSTT();
		$getSJ = $this->Model_Pembayaran->getSJ();
		$data = [
			'getSJ' => $getSJ,
			'kd_STT' => $kd_stt,
			'getPembayaran' => $getPembayaran
		];

		$this->load->view('template/V_Header',$data);
		$this->load->view('template/V_Sidebar');
		$this->load->view('transaksi/Pembayaran');
		$this->load->view('template/V_Footer');
	}

    public function Cari()
    {
        $cari = $this->input->get('sj');

        $getPembayaran = $this->Model_Pembayaran->getPembayaran();
        $kd_stt = $this->Model_Pembayaran->getKdSTT();
        $getSJ = $this->Model_Pembayaran->getSJ();
        $result = $this->Model_Pembayaran->cari($cari);
        $cari_fetch = $this->Model_Pembayaran->cari_fetch($cari);

        $data = [
            'cari_fetch' => $cari_fetch,
            'SJ' => $result ,
            'getSJ' => $getSJ,
            'kd_STT' => $kd_stt,
            'getPembayaran' => $getPembayaran
        ];
     
        $this->load->view('template/V_Header',$data);
        $this->load->view('template/V_Sidebar');
        $this->load->view('transaksi/Pembayaran');
        $this->load->view('template/V_Footer');
    }



	public function simpan()
	{
		$no_stt = $this->input->post('no_stt');
		$no_sj = $this->input->post('no_sj');
		$tgl_stt = $this->input->post('tgl_stt');

        $no_faktur = $this->Model_Pembayaran->getKdFaktur();

        $data_faktur = [
            'no_faktur' => $no_faktur,
            'tgl_faktur' => $tgl_stt,
            'no_stt' => $no_stt
        ]; 

		$data = [
			'no_stt' => $no_stt,
			'tgl_stt' => $tgl_stt,
			'no_sj' => $no_sj,
		];

		$result = $this->Model_Pembayaran->simpan($data);
        $result2 = $this->Model_Pembayaran->simpanFaktur($data_faktur);

		if($result && $result2){
			$this->session->set_flashdata('pesan','Data Berhasil Disimpan');
		   		redirect('Pembayaran');
		} else{
			$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Disimpan');
    		redirect('Pembayaran');
		}
	}

	public function ubah()
	{
		$no_stt = $this->input->post('no_stt');
		$no_sj = $this->input->post('no_sj');
		$tgl_stt = $this->input->post('tgl_stt');

		$data = [
			'tgl_stt' => $tgl_stt,
			'no_sj' => $no_sj,
		];

		$result = $this->Model_Pembayaran->update($no_stt,$data);

		if($result){
			$this->session->set_flashdata('pesan','Data Berhasil Diubah');
		   		redirect('Pembayaran');
		} else{
			$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Diubah');
    		redirect('Pembayaran');
		}
	}


	public function hapus()
	{
		$no_stt = $this->input->post('no_stt');

		$result = $this->Model_Pembayaran->hapus($no_stt);

		if($result){
			$this->session->set_flashdata('pesan','Data Berhasil Dihapus');
		   		redirect('Pembayaran');
		} else{
			$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Dihapus');
    		redirect('Pembayaran');
		}
	}

	//cetak laporan SJ dalam bentuk pdf
	public function cetakSTT($no_stt,$tgl_stt,$no_sj)
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
        $pdf->Cell(190,10,'FAKTUR',0,1,'C');
        
        $pdf->Cell(10,-1,'',0,1);

        $pembayaran = $this->Model_Pembayaran->faktur($no_stt);

        $pembayaran_fetch = $this->Model_Pembayaran->faktur_fetch($no_stt);

        $pdf->SetFont('Arial','',9);

        $pdf->Cell(25,6,'Nomor Faktur',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$pembayaran_fetch->no_faktur,0,0,'L');
        
        $pdf->Cell(65,6,'',0,0,'C');
        $pdf->Cell(30,6,'Tanggal Faktur',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(20,6,''.tanggal($pembayaran_fetch->tgl_faktur),0,1,'L');

        $pdf->Cell(25,6,'Kepada',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$pembayaran_fetch->nm_plg,0,0,'L');
        
        $pdf->Cell(65,6,'',0,0,'C');
        $pdf->Cell(30,6,'Nomor Surat Jalan',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(20,6,''.$no_sj,0,1,'L');

		$pdf->Cell(25,6,'Telepon',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$pembayaran_fetch->telepon,0,0,'L');

        $pdf->Cell(65,6,'',0,0,'C');
        $pdf->Cell(30,6,'Nomor Surat Terima',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(20,6,''.$no_stt,0,1,'L');

        $pdf->Cell(25,6,'Alamat',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$pembayaran_fetch->alamat,0,1,'L');

        $pdf->Cell(190,5,' ',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,1,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(10,6,'No.',1,0,'C');
        $pdf->Cell(40,6,'Kode Barang',1,0,'C');
        $pdf->Cell(60,6,'Nama Barang',1,0,'C');
        $pdf->Cell(20,6,'Harga',1,0,'C');
        $pdf->Cell(20,6,'Jumlah',1,0,'C');
        $pdf->Cell(40,6,'Jumlah Harga',1,1,'C');
        $pdf->SetFont('Arial','',8);

        $tampung = array();
        $no = 1;
        foreach ($pembayaran as $row)
        {
            $pdf->Cell(10,6,$no++.".",1,0,'C');
            $pdf->Cell(40,6,$row->kd_brg,1,0,'C');
            $pdf->Cell(60,6,ucwords($row->nm_brg),1,0);
            $pdf->Cell(20,6,number_format($row->harga,2,',','.'),1,0,'C');
            $pdf->Cell(20,6,$row->jml_brg,1,0,'C');
            $pdf->Cell(40,6,number_format($row->jml_brg*$row->harga,2,',','.'),1,1,'C');   
        	$tampung[] = $row->jml_brg*$row->harga;
        }

       
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(150,6,'Total Harga',1,0,'C');
        $pdf->Cell(40,6,'Rp. '.number_format(array_sum($tampung),2,',','.'),1,1,'C');
        $pdf->SetFont('Arial','',8);
        
        $pdf->Cell(10,20,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(63,6,'Tanda Terima',0,0,'C');
        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(63,6,'Hormat Kami',0,1,'C');

        $pdf->Cell(10,20,'',0,1);

        $pdf->Cell(63,6,'( '.$pembayaran_fetch->nm_plg.' )',0,0,'C');
        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(63,6,'( Admininstrator )',0,0,'C');
        

        $pdf->Output();
    }

}
