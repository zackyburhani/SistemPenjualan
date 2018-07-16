<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Pengiriman extends CI_Model {

    public function __construct()
    {
		parent::__construct();
	}

	//simpan
	public function simpan($data)
	{
		$checkinsert = false;
		try{
			$this->db->insert('sj',$data);
			$checkinsert = true;
		}catch (Exception $ex) {
			$checkinsert = false;
		}
		return $checkinsert;
	}

	public function getSuratJalan($no_po)
	{
		$result = $this->db->query("SELECT * FROM po WHERE no_po = '$no_po' ");
		return $result->row();		
	}

	public function getSJ()
	{
		$result = $this->db->query("SELECT * FROM sj order by no_sj desc");
		return $result->result();
	}

	public function getPO()
	{
		$result = $this->db->query("SELECT * FROM po order by no_po desc");
		return $result->result();
	}

	//update
	public function update($id,$data)
	{
		$checkupdate = false;
		try{
			$this->db->where('no_sj',$id);
			$this->db->update('sj',$data);
			$checkupdate = true;
		}catch (Exception $ex) {
			$checkupdate = false;
		}
		return $checkupdate;
	}

	//hapus
	public function hapus($id)
	{
		$checkupdate = false;
		try{
			$this->db->where('no_sj',$id);
			$this->db->delete('sj');
			$checkupdate = true;
		}catch (Exception $ex) {
			$checkupdate = false;
		}
		return $checkupdate;
	}

	//autonumber
	public function getKd_SJ()
    {
       	$q  = $this->db->query("select MAX(RIGHT(no_sj,4)) as kd_max from sj");
       	$kd = "";
    	if($q->num_rows() > 0) {
        	foreach ($q->result() as $k) {
          		$tmp = ((int)$k->kd_max)+1;
           		$kd = sprintf("%04s",$tmp);
        	}
    	} else {
         $kd = "0001";
    	}
       	return "SJ".$kd;
    }

  	//validasi hapus
  	public function validasiHapus($kolom,$table,$id)
    {
     	$result = $this->db->query("SELECT $kolom FROM $table WHERE $kolom = '$id'");
     	return $result->row();
    }

    public function lapPengiriman($no_sj)
    {
    	$result = $this->db->query("SELECT * FROM sj JOIN detilpesan ON detilpesan.no_po = sj.no_po JOIN barang ON barang.kd_brg = detilpesan.kd_brg JOIN po ON po.no_po = detilpesan.no_po JOIN pelanggan ON pelanggan.kd_plg = po.kd_plg WHERE no_sj = '$no_sj' and tgl_kirim is not null and detilpesan.no_po is not null");
    	return $result->result();
    }

    public function lapPengiriman_fetch($no_sj)
    {
    	$result = $this->db->query("SELECT * FROM sj JOIN detilpesan ON detilpesan.no_po = sj.no_po JOIN barang ON barang.kd_brg = detilpesan.kd_brg JOIN po ON po.no_po = detilpesan.no_po JOIN pelanggan ON pelanggan.kd_plg = po.kd_plg WHERE no_sj = '$no_sj' and tgl_kirim is not null and detilpesan.no_po is not null");
    	return $result->row();
    }

}
