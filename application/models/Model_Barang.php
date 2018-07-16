<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Barang extends CI_Model {

    public function __construct()
    {
		parent::__construct();
	}

	//simpan
	public function simpan($data)
	{
		$checkinsert = false;
		try{
			$this->db->insert('barang',$data);
			$checkinsert = true;
		}catch (Exception $ex) {
			$checkinsert = false;
		}
		return $checkinsert;
	}
	
	//ambil semua data barang
	public function getBarang()
	{
		$result = $this->db->query("SELECT * FROM barang order by 1 desc");
		return $result->result();
	}

	//update
	public function update($id,$data)
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

	//hapus
	public function hapus($id)
	{
		$checkupdate = false;
		try{
			$this->db->where('kd_brg',$id);
			$this->db->delete('barang');
			$checkupdate = true;
		}catch (Exception $ex) {
			$checkupdate = false;
		}
		return $checkupdate;
	}

	//autonumber
	public function getKdBrg()
    {
       	$q  = $this->db->query("select MAX(RIGHT(kd_brg,4)) as kd_max from barang");
       	$kd = "";
    	if($q->num_rows() > 0) {
        	foreach ($q->result() as $k) {
          		$tmp = ((int)$k->kd_max)+1;
           		$kd = sprintf("%04s",$tmp);
        	}
    	} else {
         $kd = "0001";
    	}
       	return "BR".$kd;
    }

    public function totalData($table)
    {
    	$result = $this->db->get($table);
		return $result->num_rows();
    }
}
