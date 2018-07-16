<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Pelanggan extends CI_Model {

    public function __construct()
    {
		parent::__construct();
	}

	//simpan
	public function simpan($data)
	{
		$checkinsert = false;
		try{
			$this->db->insert('pelanggan',$data);
			$checkinsert = true;
		}catch (Exception $ex) {
			$checkinsert = false;
		}
		return $checkinsert;
	}

  public function getPelanggan()
  {
    $result = $this->db->query("SELECT * FROM pelanggan order by 1 desc");
    return $result->result();
  }

  //autonumber Pelanggan
  public function getKdPlg()
  {
      $q  = $this->db->query("select MAX(RIGHT(kd_plg,3)) as kd_max from pelanggan");
      $kd = "";
      if($q->num_rows() > 0) {
          foreach ($q->result() as $k) {
              $tmp = ((int)$k->kd_max)+1;
              $kd = sprintf("%03s",$tmp);
          }
      } else {
         $kd = "001";
      }
        return "PLG".$kd;
  }

  //hapus
  public function hapus($id)
  {
    $checkupdate = false;
    try{
      $this->db->where('kd_plg',$id);
      $this->db->delete('pelanggan');
      $checkupdate = true;
    }catch (Exception $ex) {
      $checkupdate = false;
    }
    return $checkupdate;
  }

  //update
  public function update($id,$data)
  {
    $checkupdate = false;
    try{
      $this->db->where('kd_plg',$id);
      $this->db->update('pelanggan',$data);
      $checkupdate = true;
    }catch (Exception $ex) {
      $checkupdate = false;
    }
    return $checkupdate;
  }

}
