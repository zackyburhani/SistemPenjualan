<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_PO extends CI_Model {

    public function __construct()
    {
		parent::__construct();
	}

	//simpan
	public function simpan($data)
	{
		$checkinsert = false;
		try{
			$this->db->insert('po',$data);
			$checkinsert = true;
		}catch (Exception $ex) {
			$checkinsert = false;
		}
		return $checkinsert;
	}

  public function getBrg($id)
  {
    $query = $this->db->query("SELECT * FROM barang WHERE kd_brg = '$id'");
    return $query->row();
  }


  public function simpanDetil($data)
  {
    $checkinsert = false;
    try{
      $this->db->insert('detilpesan',$data);
      $checkinsert = true;
    }catch (Exception $ex) {
      $checkinsert = false;
    }
    return $checkinsert;
  }

  public function hapusDetil($id)
  {
    $result = $this->db->query("DELETE FROM detilpesan where kd_brg = '$id' and no_po is null and tgl_kirim is null");
  }

  public function getAllPO()
  {
    $result = $this->db->query("SELECT * FROM po order by no_po desc");
    return $result->result();
  }

  public function getPODetail($no_po)
  {
    $result = $this->db->query("SELECT * FROM po,detilpesan,barang where po.no_po = detilpesan.no_po AND barang.kd_brg = detilpesan.kd_brg AND po.no_po = '$no_po'");
    return $result->result();
  }

  public function getPODetail_fetch($no_po)
  {
    $result = $this->db->query("SELECT * FROM po,detilpesan,barang,pelanggan where po.no_po = detilpesan.no_po AND barang.kd_brg = detilpesan.kd_brg AND pelanggan.kd_plg = po.kd_plg AND po.no_po = '$no_po'");
    return $result->row();
  }

  public function updateDetil($id,$data)
  {
    $checkupdate = false;
    try{
      $this->db->where('kd_brg',$id);
      $this->db->update('detilpesan',$data);
      $checkupdate = true;
    }catch (Exception $ex) {
      $checkupdate = false;
    }
    return $checkupdate;
  }

  public function getPO()
  {
    $result = $this->db->query("SELECT * FROM detilpesan JOIN barang ON barang.kd_brg = detilpesan.kd_brg WHERE no_po is null and tgl_kirim is null");
    return $result->result();
  }

  public function getPO_fetch($kd_brg)
  {
    $result = $this->db->query("SELECT * FROM detilpesan JOIN barang ON barang.kd_brg = detilpesan.kd_brg WHERE no_po is null and tgl_kirim is null and barang.kd_brg = '$kd_brg'");
    return $result->row();
  }

  public function Validasi()
  {
    $result = $this->db->query("SELECT * FROM detilpesan JOIN barang ON barang.kd_brg = detilpesan.kd_brg WHERE no_po is null and tgl_kirim is null");
    return $result->row();
  }

	//autonumber PO
	public function getKdPO()
    {
       	$q  = $this->db->query("select MAX(RIGHT(no_po,4)) as kd_max from po");
       	$kd = "";
    	if($q->num_rows() > 0) {
        	foreach ($q->result() as $k) {
          		$tmp = ((int)$k->kd_max)+1;
           		$kd = sprintf("%04s",$tmp);
        	}
    	} else {
         $kd = "0001";
    	}
       	return "PO".$kd;
    }

    public function hapusPO()
    {
      $this->db->query("DELETE FROM detilpesan WHERE no_po is null and tgl_kirim is null");
    }

    public function barisDPO()
    {
      $result = $this->db->query("SELECT * FROM detilpesan where no_po is null and tgl_kirim is null");
      return $result->num_rows();
    }

    public function simpanDetilPesan($no_po,$tgl_kirim)
    {
      $this->db->query("UPDATE detilpesan set no_po = '$no_po', tgl_kirim = '$tgl_kirim' WHERE no_po is null and tgl_kirim is null");
    }

    public function updateStok($stok,$kd_brg)
    {
      $this->db->query("UPDATE barang set stok = '$stok' WHERE kd_brg = '$kd_brg'");
    }
}
