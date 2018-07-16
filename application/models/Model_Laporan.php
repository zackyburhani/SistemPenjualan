<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Laporan extends CI_Model {

    public function __construct()
    {
		parent::__construct();
	}

	public function lapPemesanan($awal,$akhir)
	{
		$query = $this->db->query("SELECT po.no_po as no_po,tgl_po,nm_plg,nm_brg,jns_brg,satuan FROM po,pelanggan,barang,detilpesan WHERE po.kd_plg = pelanggan.kd_plg AND detilpesan.no_po = po.no_po AND barang.kd_brg = detilpesan.kd_brg AND po.tgl_po BETWEEN '$awal' AND '$akhir'");
		return $query->result();
	}


	public function lapPengiriman($awal,$akhir)
	{
		$query = $this->db->query("SELECT sj.no_sj,tgl_sj,nm_brg,jns_brg,satuan,jml_brg FROM sj,detilpesan,barang WHERE sj.no_po = detilpesan.no_po AND barang.kd_brg = detilpesan.kd_brg AND tgl_sj BETWEEN '$awal' AND '$akhir'");
		return $query->result();
	}

	public function lapPenjualan($awal,$akhir)
	{
		$query = $this->db->query("SELECT no_faktur,tgl_faktur,nm_brg,jns_brg,satuan,jml_brg,harga FROM faktur,stt,sj,detilpesan,barang WHERE faktur.no_stt = stt.no_stt AND stt.no_sj = sj.no_sj AND sj.no_po = detilpesan.no_po AND barang.kd_brg = detilpesan.kd_brg AND tgl_faktur BETWEEN '$awal' AND '$akhir'");
		return $query->result();
	} 

}
