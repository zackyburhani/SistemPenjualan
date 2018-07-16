<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Model_Barang');
	}

	//halaman awal
	public function index()
	{
		$data = [
			'totalPelanggan' => $this->Model_Barang->totalData('pelanggan'),
			'totalBarang' => $this->Model_Barang->totalData('barang'),
			'totalPO' => $this->Model_Barang->totalData('po'),
			'totalFaktur' => $this->Model_Barang->totalData('faktur'),
			'totalRetur' => $this->Model_Barang->totalData('retur'),
		];

		$this->load->view('template/V_Header',$data);
		$this->load->view('template/V_Sidebar');
		$this->load->view('index');
		$this->load->view('template/V_Footer');
	}
}
