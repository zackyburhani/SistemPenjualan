<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Model_Pelanggan');
	}

	//halaman awal
	public function index()
	{

		$getPelanggan = $this->Model_Pelanggan->getPelanggan();

		$data = [
			'getPelanggan' => $getPelanggan
		];

		$this->load->view('template/V_Header',$data);
		$this->load->view('template/V_Sidebar');
		$this->load->view('master/Pelanggan');
		$this->load->view('template/V_Footer');
	}

	public function ubah()
	{
		$kd_plg = $this->input->post('kd_plg');
		$nm_plg = $this->input->post('nm_plg');
		$alamat = $this->input->post('alamat');
		$telepon = $this->input->post('telepon');
	
		$data = [
			'nm_plg' => ucwords($nm_plg),
			'alamat' => $alamat,
			'telepon' => $telepon
		];

		$result = $this->Model_Pelanggan->update($kd_plg,$data);

		if($result){
			$this->session->set_flashdata('pesan','Data Berhasil Diubah');
		   	redirect('Pelanggan');
		} else{
			$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Diubah');
    		redirect('Pelanggan');
		}
	}

	public function hapus()
	{
		$kd_plg = $this->input->post('kd_plg');
		$result = $this->Model_Pelanggan->hapus($kd_plg);
		if($result){
			$this->session->set_flashdata('pesan','Data Berhasil Dihapus');
		   	redirect('Pelanggan');
		} else{
			$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Dihapus');
    		redirect('Pelanggan');
		}
	}

}
