<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Pembayaran extends CI_Model {

    public function __construct()
    {
		parent::__construct();
	}

	//simpan
	public function simpan($data)
	{
		$checkinsert = false;
		try{
			$this->db->insert('stt',$data);
			$checkinsert = true;
		}catch (Exception $ex) {
			$checkinsert = false;
		}
		return $checkinsert;
	}

	public function simpanFaktur($data)
	{
		$checkinsert = false;
		try{
			$this->db->insert('faktur',$data);
			$checkinsert = true;
		}catch (Exception $ex) {
			$checkinsert = false;
		}
		return $checkinsert;
	}

	public function cari($data)
	{
		$result = $this->db->query("SELECT * FROM sj JOIN detilpesan ON detilpesan.no_po = sj.no_po JOIN barang ON barang.kd_brg = detilpesan.kd_brg JOIN po ON po.no_po = detilpesan.no_po JOIN pelanggan ON pelanggan.kd_plg = po.kd_plg WHERE no_sj = '$data' and tgl_kirim is not null and detilpesan.no_po is not null");
		return $result->result();
	}

	public function cari_fetch($data)
	{
		$result = $this->db->query("SELECT * FROM sj JOIN detilpesan ON detilpesan.no_po = sj.no_po JOIN barang ON barang.kd_brg = detilpesan.kd_brg JOIN po ON po.no_po = detilpesan.no_po JOIN pelanggan ON pelanggan.kd_plg = po.kd_plg WHERE no_sj = '$data' and tgl_kirim is not null and detilpesan.no_po is not null");
		return $result->row();
	}
	
	//ambil semua data barang
	public function getPembayaran()
	{
		$result = $this->db->query("SELECT * FROM stt order by no_stt desc");
		return $result->result();
	}

	//update
	public function update($id,$data)
	{
		$checkupdate = false;
		try{
			$this->db->where('no_stt',$id);
			$this->db->update('stt',$data);
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
			$this->db->where('no_stt',$id);
			$this->db->delete('stt');
			$checkupdate = true;
		}catch (Exception $ex) {
			$checkupdate = false;
		}
		return $checkupdate;
	}

	//autonumber
	public function getKdSTT()
    {
       	$q  = $this->db->query("select MAX(RIGHT(no_stt,4)) as kd_max from stt");
       	$kd = "";
    	if($q->num_rows() > 0) {
        	foreach ($q->result() as $k) {
          		$tmp = ((int)$k->kd_max)+1;
           		$kd = sprintf("%04s",$tmp);
        	}
    	} else {
         $kd = "0001";
    	}
       	return "ST".$kd;
    }

    public function getKdFaktur()
    {
       	$q  = $this->db->query("select MAX(RIGHT(no_faktur,4)) as kd_max from faktur");
       	$kd = "";
    	if($q->num_rows() > 0) {
        	foreach ($q->result() as $k) {
          		$tmp = ((int)$k->kd_max)+1;
           		$kd = sprintf("%04s",$tmp);
        	}
    	} else {
         $kd = "0001";
    	}
       	return "FK".$kd;
    }

  	//validasi hapus
  	public function validasiHapus($kolom,$table,$id)
    {
     	$result = $this->db->query("SELECT $kolom FROM $table WHERE $kolom = '$id'");
     	return $result->row();
    }

    public function getSJ()
    {
    	$result = $this->db->query('SELECT * FROM sj order by no_sj desc');
		return $result->result();
    }

    public function faktur($no_stt)
    {
    	$result = $this->db->query("SELECT * FROM detilpesan,barang,sj,pelanggan,stt,po,faktur WHERE faktur.no_stt = stt.no_stt AND po.no_po = detilpesan.no_po AND po.kd_plg = pelanggan.kd_plg AND barang.kd_brg = detilpesan.kd_brg AND sj.no_sj = stt.no_sj AND detilpesan.no_po = sj.no_po AND detilpesan.tgl_kirim is not null AND detilpesan.no_po is not null AND stt.no_stt = '$no_stt'");
    	return $result->result();
    }

    public function faktur_fetch($no_stt)
    {
    	$result = $this->db->query("SELECT * FROM detilpesan,barang,sj,pelanggan,stt,po,faktur WHERE faktur.no_stt = stt.no_stt AND po.no_po = detilpesan.no_po AND po.kd_plg = pelanggan.kd_plg AND barang.kd_brg = detilpesan.kd_brg AND sj.no_sj = stt.no_sj AND detilpesan.no_po = sj.no_po AND detilpesan.tgl_kirim is not null AND detilpesan.no_po is not null AND stt.no_stt = '$no_stt'");
    	return $result->row();
    }

	public function faktur_detail($no_stt)
 	{
	    $result = $this->db->query("SELECT * FROM detilpesan,barang,sj,pelanggan,stt,po,faktur WHERE faktur.no_stt = stt.no_stt AND po.no_po = detilpesan.no_po AND po.kd_plg = pelanggan.kd_plg AND barang.kd_brg = detilpesan.kd_brg AND sj.no_sj = stt.no_sj AND detilpesan.no_po = sj.no_po AND detilpesan.tgl_kirim is not null AND detilpesan.no_po is not null AND stt.no_stt = '$no_stt'");
	      return $result->result();
	}
}
