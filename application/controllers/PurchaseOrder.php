<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class PurchaseOrder extends CI_Controller{
     
    public function __construct(){
        parent::__construct();
        $this->load->model(['Model_Barang','Model_PO','Model_Pelanggan']);
        $this->load->library('session');
    }
 
    public function index()
    {
        $data = [
            'PO' => $this->Model_PO->getAllPO(),
            'Validasi' => $this->Model_PO->Validasi(),
            'getKdPlg' => $this->Model_Pelanggan->getKdPlg(),
            'detilPesan' => $this->Model_PO->getPO(),
            'data' => $this->Model_Barang->getBarang(),
            'getKdPO' => $this->Model_PO->getKdPO()
        ];
        $this->load->view('template/V_Header',$data);
        $this->load->view('template/V_Sidebar');
        $this->load->view('transaksi/PO');
        $this->load->view('template/V_Footer');
    }

    public function detilPesan()
    {
        $kd_brg = $this->input->post('kd_brg');
        $qty = $this->input->post('qty');
        $barang = $this->Model_PO->getPO();
        $tampung = array();

        $cek_stok = $this->Model_PO->getBrg($kd_brg);
        if($qty > $cek_stok->stok){
            echo "<script type='text/javascript'>
                    alert ('Jumlah Stok Tidak Cukup !');
                    window.location.replace('index');
                </script>"; 
        } else {

            if($barang == null){
                $data = [
                        'kd_brg' => $kd_brg,
                        'jml_brg' => $qty
                    ];
                $result = $this->Model_PO->simpanDetil($data);
                redirect('PurchaseOrder');
            } else {

                $getKode = $this->Model_PO->getPO_fetch($kd_brg);

                if($getKode == null){
                    $data = [
                        'kd_brg' => $kd_brg,
                        'jml_brg' => $qty
                    ];
                    $result = $this->Model_PO->simpanDetil($data);
                    redirect('PurchaseOrder');
                } else {
                    $jml = $getKode->jml_brg+$qty;
                    $data = [
                        'jml_brg' => $jml,
                    ];    
                    $result = $this->Model_PO->updateDetil($kd_brg,$data);
                    redirect('PurchaseOrder');
                }

                // foreach ($barang as $key) {
                    
                //     if($key->kd_brg == $kd_brg){
                //         $jml = $key->jml_brg+$qty;
                //         $data = [
                //             'jml_brg' => $jml,
                //         ];    
                //         $result = $this->Model_PO->updateDetil($kd_brg,$data);
                              
                //     } else {
                //         $data = [
                //             'kd_brg' => $kd_brg,
                //             'jml_brg' => $qty
                //         ];
                //         $result = $this->Model_PO->simpanDetil($data);
                //         redirect('PurchaseOrder');
                //     }
                //     redirect('PurchaseOrder');      

                // }

            }
        }

    }

    public function hapusDetil($kd_brg)
    {
        $result = $this->Model_PO->hapusDetil($kd_brg);
        redirect('PurchaseOrder');
    }

    public function hapusSemua()
    {
        $result = $this->Model_PO->hapusPO();
        redirect('PurchaseOrder');
    }

    public function simpan()
    {
        $kd_plg = $this->input->post('kd_plg');
        $nm_plg = $this->input->post('nm_plg');
        $telepon = $this->input->post('telepon');
        $alamat = $this->input->post('alamat');
        $no_po = $this->input->post('no_po');
        $tgl_po = $this->input->post('tgl_po');
        $tgl_kirim = $this->input->post('tgl_kirim');

        if($tgl_kirim < $tgl_po){
            echo "<script type='text/javascript'>
                    alert ('Tanggal Kirim Tidak Valid !');
                    window.location.replace('index');
                </script>"; 
        } else {
            $data_pelanggan = [
               'kd_plg' => $kd_plg,
                'nm_plg' => $nm_plg,
                'alamat' => $alamat,
                'telepon' => $telepon
            ];
            
            $data_po = [
                'no_po' => $no_po,
                'tgl_po' => $tgl_po,
                'kd_plg' => $kd_plg
            ];

            $baris = $this->Model_PO->barisDPO();
            $po = $this->Model_PO->getPO();

            $stok = array();
            $update_stok = array();
            foreach ($po as $key) {
                $stok[] = $key->stok - $key->jml_brg;
                $update_stok[] = $key->kd_brg;
            }

            for($i=0; $i<$baris; $i++){
                $result1 = $this->Model_PO->updateStok($stok[$i],$update_stok[$i]);
            }

            $result2 = $this->Model_Pelanggan->simpan($data_pelanggan);
            $result3 = $this->Model_PO->simpan($data_po);

            for($i=0; $i<$baris; $i++){
                $result4 = $this->Model_PO->simpanDetilPesan($no_po,$tgl_kirim);
            }

            redirect('PurchaseOrder');
        }
       
    }
}