<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Retur extends CI_Model {

    public function __construct()
    {
		parent::__construct();
	}

	//simpan
	public function simpan($data)
	{
		$checkinsert = false;
		try{
			$this->db->insert('retur',$data);
			$checkinsert = true;
		}catch (Exception $ex) {
			$checkinsert = false;
		}
		return $checkinsert;
	}

  public function getRetur()
  {
    $result = $this->db->query("SELECT * FROM retur order by 1 desc");
    return $result->result();
  }

  public function getJmlBrg_fetch($kd_brg)
  {
    $result = $this->db->query("SELECT stok,jml_brg FROM barang,detilpesan WHERE barang.kd_brg = detilpesan.kd_brg AND barang.kd_brg = '$kd_brg'");
    return $result->row();
  }

  public function simpanDetail($data)
  {
    $checkinsert = false;
    try{
      $this->db->insert('detilretur',$data);
      $checkinsert = true;
    }catch (Exception $ex) {
      $checkinsert = false;
    }
    return $checkinsert;
  }

  public function updateStok($id,$data)
  {
    $checkupdate = false;
    try{
      $this->db->where('kd_brg',$id);
      $this->db->update('barang',$data);
      $checkupdate = true;
    }catch (Exception $ex) {
      $checkupdate = false;
    }
    return $checkupdate;
  }

  public function retur($kd_brg)
  {
    $result = $this->db->query("SELECT * FROM barang JOIN detilpesan ON barang.kd_brg = detilpesan.kd_brg WHERE barang.kd_brg = '$kd_brg'");
    return $result->row();
  }

  public function getKdRetur()
  {
      $q  = $this->db->query("select MAX(RIGHT(no_retur,3)) as kd_max from retur");
      $kd = "";
      if($q->num_rows() > 0) {
          foreach ($q->result() as $k) {
              $tmp = ((int)$k->kd_max)+1;
              $kd = sprintf("%04s",$tmp);
          }
      } else {
         $kd = "0001";
      }
        return "RT".$kd;
  }

  public function cari($faktur)
  {
    $result = $this->db->query("SELECT * FROM detilpesan,barang,sj,pelanggan,stt,po,faktur WHERE faktur.no_stt = stt.no_stt AND po.no_po = detilpesan.no_po AND po.kd_plg = pelanggan.kd_plg AND barang.kd_brg = detilpesan.kd_brg AND sj.no_sj = stt.no_sj AND detilpesan.no_po = sj.no_po AND detilpesan.tgl_kirim is not null AND detilpesan.no_po is not null AND no_faktur = '$faktur'");
      return $result->result();
  }

  public function baris($faktur)
  {
    $result = $this->db->query("SELECT * FROM detilpesan,barang,sj,pelanggan,stt,po,faktur WHERE faktur.no_stt = stt.no_stt AND po.no_po = detilpesan.no_po AND po.kd_plg = pelanggan.kd_plg AND barang.kd_brg = detilpesan.kd_brg AND sj.no_sj = stt.no_sj AND detilpesan.no_po = sj.no_po AND detilpesan.tgl_kirim is not null AND detilpesan.no_po is not null AND no_faktur = '$faktur'");
      return $result->num_rows();
  }

  public function cari_fetch($faktur)
  {
    $result = $this->db->query("SELECT * FROM detilpesan,barang,sj,pelanggan,stt,po,faktur WHERE faktur.no_stt = stt.no_stt AND po.no_po = detilpesan.no_po AND po.kd_plg = pelanggan.kd_plg AND barang.kd_brg = detilpesan.kd_brg AND sj.no_sj = stt.no_sj AND detilpesan.no_po = sj.no_po AND detilpesan.tgl_kirim is not null AND detilpesan.no_po is not null AND no_faktur = '$faktur'");
      return $result->row();
  }

  public function cetakRetur($retur)
  {
    $result = $this->db->query("SELECT * FROM retur,detilretur,barang,pelanggan,stt,sj,faktur,po WHERE po.kd_plg = pelanggan.kd_plg AND sj.no_po = po.no_po AND sj.no_sj = stt.no_sj AND faktur.no_stt = stt.no_stt AND retur.no_faktur = faktur.no_faktur AND retur.no_retur = detilretur.no_retur AND barang.kd_brg = detilretur.kd_brg AND retur.no_retur = '$retur'");
      return $result->result();
  }

  public function cetakRetur_fetch($retur)
  {
    $result = $this->db->query("SELECT * FROM retur,detilretur,barang,pelanggan,stt,sj,faktur,po WHERE po.kd_plg = pelanggan.kd_plg AND sj.no_po = po.no_po AND sj.no_sj = stt.no_sj AND faktur.no_stt = stt.no_stt AND retur.no_faktur = faktur.no_faktur AND retur.no_retur = detilretur.no_retur AND barang.kd_brg = detilretur.kd_brg AND retur.no_retur = '$retur'");
      return $result->row();
  }
  

}
