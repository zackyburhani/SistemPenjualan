<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Model_Barang');
		$this->load->library('session');
	}

	//halaman awal
	public function index()
	{

		$getBarang = $this->Model_Barang->getBarang();
		$kd_brg = $this->Model_Barang->getKdBrg();

		$data = [
			'kd_brg' => $kd_brg,
			'getBarang' => $getBarang
		];

		$this->load->view('template/V_Header',$data);
		$this->load->view('template/V_Sidebar');
		$this->load->view('master/Barang');
		$this->load->view('template/V_Footer');
	}

	public function simpan()
	{
		$kd_brg = $this->input->post('kd_brg');
		$nm_brg = $this->input->post('nm_brg');
		$jns_brg = $this->input->post('jns_brg');
		$satuan = $this->input->post('satuan');
		$harga = $this->input->post('harga');
		$stok = $this->input->post('stok');

		$data = [
			'kd_brg' => $kd_brg,
			'nm_brg' => ucwords($nm_brg),
			'jns_brg' => ucwords($jns_brg),
			'satuan' => ucwords($satuan),
			'harga' => $harga,
			'stok' => $stok
		];

		$result = $this->Model_Barang->simpan($data);

		if($result){
			$this->session->set_flashdata('pesan','Data Berhasil Disimpan');
		   	redirect('Barang');
		} else{
			$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Disimpan');
    		redirect('Barang');
		}
	}

	public function ubah()
	{
		$kd_brg = $this->input->post('kd_brg');
		$nm_brg = $this->input->post('nm_brg');
		$jns_brg = $this->input->post('jns_brg');
		$satuan = $this->input->post('satuan');
		$harga = $this->input->post('harga');
		$stok = $this->input->post('stok');

		$data = [
			'nm_brg' => ucwords($nm_brg),
			'jns_brg' => ucwords($jns_brg),
			'satuan' => ucwords($satuan),
			'harga' => $harga,
			'stok' => $stok
		];

		$result = $this->Model_Barang->update($kd_brg,$data);

		if($result){
			$this->session->set_flashdata('pesan','Data Berhasil Diubah');
		   	redirect('Barang');
		} else{
			$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Disimpan');
    		redirect('Barang');
		}
	}

	public function hapus()
	{
		$kd_brg = $this->input->post('kd_brg');
		$result = $this->Model_Barang->hapus($kd_brg);
		if($result){
			$this->session->set_flashdata('pesan','Data Berhasil Dihapus');
		   	redirect('Barang');
		} else{
			$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Dihapus');
    		redirect('Barang');
		}
	}

}
