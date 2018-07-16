<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <small><b>Halaman Pembayaran</b></small>
    </h1>
  </section>
<section class="content">
    
<?php if($this->session->flashdata('pesan') == TRUE ) { ?>
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-success fade in" id="alert">
        <p><center><b><?php echo $this->session->flashdata('pesan') ?></b></center></p>
      </div>
    </div>
  </div>
<?php } ?>

<?php if($this->session->flashdata('pesanGagal') == TRUE ) { ?>
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-danger" id="alert">
        <p><center><b><?php echo $this->session->flashdata('pesanGagal') ?></b></center></p>
      </div>
    </div>
  </div>
<?php } ?>

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">
          <form method="GET" action="<?php echo site_url('Pembayaran/Cari') ?>">
            <div class="col-xs-2">
              <label style="margin-top: 5px">Cari Surat Jalan</label>  
            </div>
            <div class="col-md-6">
              <input type="text" name="sj" class="form-control">
            </div>
            <div class="col-md-1">
              <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
            </div>
          </form>
        </div>
      </div>
     </div>
    </div>
  </div>

<?php if(isset($SJ)) { ?>
  <?php if($SJ != null) { ?>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <center><h4>Surat Jalan</h4></center>
        <hr>
        <div class="row">
          <div class="col-md-6">
          <table style="table-layout:fixed" class="table table-bordered ">
            <tbody>
              <tr>
                <td style="width: 150px">Nomor surat</td>
                <td style="width: 10px">:</td>
                <td><?php echo $cari_fetch->no_sj ?></td>
              </tr>
              <tr>
                <td>Purchase Order</td>
                <td>:</td>
                <td><?php echo $cari_fetch->no_po ?></td>
              </tr>
              <tr>
                <td>Kepada</td>
                <td>:</td>
                <td><?php echo $cari_fetch->nm_plg ?></td>
              </tr>
              <tr>
                <td>Telepon</td>
                <td>:</td>
                <td><?php echo $cari_fetch->telepon ?></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?php echo $cari_fetch->alamat ?></td>
              </tr>
            </tbody>
          </table>
          </div>
          <div class="col-md-6">
            <table style="table-layout:fixed" class="table table-bordered ">
            <tbody>
              <tr>
                <td style="width: 150px">Tanggal PO</td>
                <td style="width: 10px">:</td>
                <td><?php echo tanggal($cari_fetch->tgl_po) ?></td>
              </tr>
              <tr>
                <td>Tanggal Kirim</td>
                <td>:</td>
                <td><?php echo tanggal($cari_fetch->tgl_kirim) ?></td>
              </tr>
            </tbody>
          </table>
        </div>
        </div>

        <table style="table-layout:fixed" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th align="center" width="50px">No. </th>
              <th align="center"><center>Kode Barang</center></th>
              <th align="center"><center>Nama Barang</center></th>
              <th align="center"><center>Satuan</center> </th>
              <th align="center"><center>Jumlah</center> </th>
            </tr>
          </thead>
          <tbody>
          <?php $no=1; ?>
          <?php foreach($SJ as $data){ ?>
          <tr>
            <td><center><?php echo $no++; ?></center></td>
            <td><center><?php echo $data->kd_brg ?></center></td>
            <td><center><?php echo $data->nm_brg ?></center></td>
            <td><center><?php echo $data->satuan ?></center></td>
            <td><center><?php echo $data->jml_brg ?></center></td>
          <?php } ?>
        </table>
        <hr>
         <a href="<?php echo site_url('Pembayaran') ?>" class="btn btn-danger pull-right"><i class="fa fa-close"></i> Tutup</a>
      </div>
     </div>
    </div>
  </div>
  <?php } else { ?>
  <div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <center><h4>Data Tidak Ditemukan</h4></center>
      </div>
     </div>
    </div>
  </div>
  
  <?php } ?>    
<?php } ?>

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <button class="btn btn-default" data-toggle="modal" href="#" data-target="#ModalEntrySTT"><i class="fa fa-plus"></i></button> <label> Tambah Surat Tanda Terima </label>
      </div>
      <div class="panel-body">
        <table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="STT">
          <thead>
            <tr>
              <th align="center" width="20px">No. </th>
              <th align="center"><center>Nomor Surat Tanda Terima</center></th>
              <th align="center"><center>Tanggal Surat Tanda Terima</center></th>
              <th align="center"><center>Nomor Surat Jalan</center> </th>
              <th align="center" width="130px"><center>Cetak Faktur</center></th> 
              <th align="center" width="130px"><center>Detail Faktur</center></th> 
              <th align="center" width="70px"><center>Edit</center></th>
              <!-- <th align="center" width="70px"><center>Hapus</center></th> -->
            </tr>
          </thead>
          <tbody>
          <?php $no=1; ?>
          <?php foreach($getPembayaran as $data){ ?>
          <tr>
            <td><center><?php echo $no++; ?></center></td>
            <td><center><?php echo $data->no_stt ?></center></td>
            <td><center><?php echo tanggal($data->tgl_stt) ?></center></td>
            <td><center><?php echo $data->no_sj ?></center></td>
            <td><center>
              <a href="<?php echo site_url('Pembayaran/cetakSTT/'.$data->no_stt.'/'.$data->tgl_stt.'/'.$data->no_sj) ?>" class="btn btn-info btn-circle" data-toggle="modal"><span class="glyphicon glyphicon-print"></span> </a></center>
            </td>
             <td><center>
              <a href="#Detail<?php echo $data->no_stt ?>" class="btn btn-primary btn-circle" data-toggle="modal"><span class="fa fa-folder-open"></span> </a></center>
            </td>
            <td><center>
              <a href="#Update<?php echo $data->no_stt ?>" class="btn btn-warning btn-circle" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> </a></center>
            </td>
            <!-- <td><center>
              <a href="#Hapus<?php echo $data->no_stt ?>" class="btn btn-danger btn-circle" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> </a></center>
            </td> -->
          </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
     </div>
    </div>
  </div>
</section>

<!-- Modal Entry Data SJ -->
<div class="modal fade" id="ModalEntrySTT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> Tambah Surat Tanda Terima</h4>
      </div>
      <form method="POST" action="<?php echo site_url('Pembayaran/simpan')?>" enctype="multipart/form-data">
        <div class="modal-body">
          
          <div class="form-group"><label>Kode Surat Tanda Terima</label>
            <input required class="form-control required text-capitalize" value="<?php echo $kd_STT ?>" data-placement="top" data-trigger="manual" type="text" name="no_stt" readonly>
          </div>

          <div class="form-group"><label>Tanggal Surat Tanda Terima</label>
            <input required class="form-control required text-capitalize" data-placement="top" data-trigger="manual" type="date" name="tgl_stt">
          </div>

          <div class="form-group"><label>Nomor Surat Jalan</label>
            <div class="custom-select">
              <select class="form-control" name="no_sj">
                <?php foreach($getSJ as $sj){ ?>
                <option value="<?php echo $sj->no_sj ?>"><?php echo $sj->no_sj ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit Data SJ -->
<?php foreach($getPembayaran as $data){ ?>
<div class="modal fade" id="Update<?php echo $data->no_stt ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-truck"></i> Ubah Data Surat Tanda Terima</h4>
      </div>
      <form method="POST" action="<?php echo site_url('Pembayaran/ubah')?>" enctype="multipart/form-data">
        <div class="modal-body">
          
          <div class="form-group"><label>Kode Surat Tanda Terima</label>
            <input required class="form-control required text-capitalize" value="<?php echo $data->no_stt ?>" data-placement="top" data-trigger="manual" type="text" name="no_stt" readonly>
          </div>

          <div class="form-group"><label>Tanggal Surat Tanda Terima</label>
            <input required class="form-control required text-capitalize" value="<?php echo $data->tgl_stt ?>" data-placement="top" data-trigger="manual" type="date" name="tgl_stt">
          </div>

           <div class="form-group"><label>Nomor Surat Jalan</label>
            <div class="custom-select my-1 mr-sm-2">
              <select class="form-control" name="no_sj">
                <?php foreach($getSJ as $sj){ ?>
                <option <?php if($data->no_sj === $sj->no_sj): echo "selected"; endif; ?> value="<?php echo $sj->no_sj ?>"><?php echo $sj->no_sj ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Ubah</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>

<?php foreach($getPembayaran as $data){ ?>
<div class="modal fade" id="Hapus<?php echo $data->no_stt ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash fa-fw"></i>Konfirmasi Hapus</h4>
      </div>
      <div class='modal-body'>Anda yakin ingin menghapus ?
      </div>
      <div class='modal-footer'>
        <form class="" action="<?php echo site_url('Pembayaran/hapus') ?>" method="post">
          <input type="hidden" value="<?php echo $data->no_stt ?>" name="no_stt">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button class="btn btn-danger" aria-label="Delete" type="submit" name="hapus"><i class="fa fa-trash fa-fw"></i> Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<?php foreach($getPembayaran as $data){ ?>
<div class="modal fade" id="Detail<?php echo $data->no_stt ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> Detail Faktur</h4>
      </div>
      <div class="modal-body">
        <?php $detail_fetch = $this->Model_Pembayaran->faktur_fetch($data->no_stt); ?>
        <div class="col-md-6">
          <table style="table-layout:fixed" class="table table-bordered ">
            <tbody>
              <tr>
                <td style="width: 150px">Nomor Faktur</td>
                <td style="width: 10px">:</td>
                <td><?php echo $detail_fetch->no_faktur ?></td>
              </tr>
              <tr>
                <td>Kepada</td>
                <td>:</td>
                <td><?php echo $detail_fetch->nm_plg ?></td>
              </tr>
              <tr>
                <td>Telepon</td>
                <td>:</td>
                <td><?php echo $detail_fetch->telepon ?></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?php echo $detail_fetch->alamat ?></td>
              </tr>
            </tbody>
          </table>
          </div>
          <div class="col-md-6">
            <table style="table-layout:fixed" class="table table-bordered ">
            <tbody>
              <tr>
                <td style="width: 150px">Tanggal Faktur</td>
                <td style="width: 10px">:</td>
                <td><?php echo tanggal($detail_fetch->tgl_faktur) ?></td>
              </tr>
              <tr>
                <td>Nomor Surat Jalan</td>
                <td>:</td>
                <td><?php echo $detail_fetch->no_sj ?></td>
              </tr>
              <tr>
                <td>Nomor Surat Terima</td>
                <td>:</td>
                <td><?php echo $detail_fetch->no_stt ?></td>
              </tr>
            </tbody>
          </table>
        </div>


          <table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="barang">
            <thead>
              <tr>
                <th align="center" width="50px">No. </th>
                <th align="center"><center>Kode Barang</center></th>
                <th align="center"><center>Nama Barang</center></th>
                <th align="center"><center>Harga / Rp.</center> </th>
                <th align="center"><center>Jumlah</center> </th>
                <th align="center"><center>Jumlah Harga / Rp.</center> </th>
              </tr>
            </thead>
            <tbody>
            <?php $tampung = array(); ?>
            <?php $no=1; ?>
            <?php $detail = $this->Model_Pembayaran->faktur_detail($data->no_stt); ?>
            <?php foreach($detail as $data2){ ?>
            <tr>
              <td><center><?php echo $no++ ?></center></td>
              <td><center><?php echo $data2->kd_brg ?></center></td>
              <td><?php echo $data2->nm_brg ?></td>
              <td><center><?php echo number_format($data2->harga,2,',','.') ?></center></td>
              <td><center><?php echo $data2->jml_brg ?></center></td>
              <td><center><?php echo number_format($data2->jml_brg*$data2->harga,2,',','.') ?></center></td>
              <?php $tampung[] = $data2->jml_brg*$data2->harga ?>
            <?php } ?>
            </tr>
            <tr>
              <td colspan="5"><b><center>Total Harga</b></centerTotal></td>
              <td><center><b><?php echo number_format(array_sum($tampung),2,',','.') ?></b></center></td>
            </tr>
            </tbody>
          </table> 
        </div>
    </div>
  </div>
</div>
<?php } ?>


</div>