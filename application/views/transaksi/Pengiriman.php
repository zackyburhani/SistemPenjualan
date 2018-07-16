<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <small><b>Halaman Pengiriman Barang</b></small>
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
      <div class="panel-heading">
        <button class="btn btn-default" data-toggle="modal" href="#" data-target="#ModalEntrySJ"><i class="fa fa-plus"></i></button> <label> Tambah Surat Jalan </label>
      </div>
      <div class="panel-body">
        <table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="barang">
          <thead>
            <tr>
              <th align="center" width="20px">No. </th>
              <th align="center"><center>Nomor Surat</center></th>
              <th align="center"><center>Tanggal Surat Jalan</center></th>
              <th align="center"><center>Nomor Purchase Order</center> </th>
              <th align="center" width="130px"><center>Cetak Surat Jalan</center></th>
              <th align="center" width="130px"><center>Detail Surat Jalan</center></th>
              <th align="center" width="70px"><center>Edit</center></th>
              <!-- <th align="center" width="70px"><center>Hapus</center></th> -->
            </tr>
          </thead>
          <tbody>
          <?php $no=1; ?>
          <?php foreach($getSJ as $data){ ?>
          <tr>
            <td><center><?php echo $no++; ?></center></td>
            <td><center><?php echo $data->no_sj ?></center></td>
            <td><center><?php echo tanggal($data->tgl_sj) ?></center></td>
            <td><center><?php echo $data->no_po ?></center></td>
            <td><center>
              <a href="<?php echo site_url('Pengiriman/cetakSJ/'.$data->no_sj.'/'.$data->tgl_sj.'/'.$data->no_po) ?>" class="btn btn-info btn-circle" data-toggle="modal"><span class="glyphicon glyphicon-print"></span> </a></center>
            </td>
            <td><center>
              <a href="#Detail<?php echo $data->no_sj ?>" class="btn btn-primary btn-circle" data-toggle="modal"><span class="fa fa-folder-open"></span> </a></center>
            </td>
            <td><center>
              <a href="#Update<?php echo $data->no_sj ?>" class="btn btn-warning btn-circle" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> </a></center>
            </td>
           <!--  <td><center>
              <a href="#Hapus<?php echo $data->no_sj ?>" class="btn btn-danger btn-circle" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> </a></center>
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
<div class="modal fade" id="ModalEntrySJ" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-truck"></i> Tambah Surat Jalan</h4>
      </div>
      <form method="POST" action="<?php echo site_url('Pengiriman/simpan')?>" enctype="multipart/form-data">
        <div class="modal-body">
          
          <div class="form-group"><label>Kode Surat Jalan</label>
            <input required class="form-control required text-capitalize" value="<?php echo $kd_SJ ?>" data-placement="top" data-trigger="manual" type="text" name="no_sj" readonly>
          </div>

          <div class="form-group"><label>Nomor Purchase Order</label>
            <div class="custom-select">
              <select class="form-control" name="no_po">
                <?php foreach($getPO as $po){ ?>
                <option value="<?php echo $po->no_po ?>"><?php echo $po->no_po ?></option>
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
<?php foreach($getSJ as $data){ ?>
<div class="modal fade" id="Update<?php echo $data->no_sj ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-truck"></i> Ubah Data Surat Jalan</h4>
      </div>
      <form method="POST" action="<?php echo site_url('Pengiriman/ubah')?>" enctype="multipart/form-data">
        <div class="modal-body">
          
         <div class="form-group"><label>Kode Surat Jalan</label>
            <input required class="form-control required text-capitalize" value="<?php echo $data->no_sj ?>" data-placement="top" data-trigger="manual" type="text" name="no_sj" readonly>
          </div>

           <div class="form-group"><label>Nomor Purchase Order</label>
            <div class="custom-select my-1 mr-sm-2">
              <select class="form-control" name="no_po">
                <?php foreach($getPO as $po){ ?>
                <option <?php if($data->no_po === $po->no_po): echo "selected"; endif; ?> value="<?php echo $po->no_po ?>"><?php echo $po->no_po ?></option>
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

<?php foreach($getSJ as $data){ ?>
<div class="modal fade" id="Detail<?php echo $data->no_sj ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-truck"></i> Ubah Data Surat Jalan</h4>
      </div>
       <div class="modal-body">
          
         <div class="row">
          <div class="col-md-6">
          <?php $cari_fetch = $this->Model_Pengiriman->lapPengiriman_fetch($data->no_sj) ?>
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
              <th align="center"><center>Jenis Barang</center> </th>
              <th align="center"><center>Satuan</center> </th>
              <th align="center"><center>Jumlah</center> </th>
            </tr>
          </thead>
          <tbody>
          <?php $no=1; ?>
          <?php $lapPengiriman = $this->Model_Pengiriman->lapPengiriman($data->no_sj) ?>
          <?php foreach($lapPengiriman as $data){ ?>
          <tr>
            <td><center><?php echo $no++; ?></center></td>
            <td><center><?php echo $data->kd_brg ?></center></td>
            <td><center><?php echo $data->nm_brg ?></center></td>
            <td><center><?php echo $data->jns_brg ?></center></td>
            <td><center><?php echo $data->satuan ?></center></td>
            <td><center><?php echo $data->jml_brg ?></center></td>
          <?php } ?>
        </table>

        </div>
        <div class="modal-footer">
        </div>
    </div>
  </div>
</div>
<?php } ?>

<?php foreach($getSJ as $data){ ?>
<div class="modal fade" id="Hapus<?php echo $data->no_sj ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash fa-fw"></i>Konfirmasi Hapus</h4>
      </div>
      <div class='modal-body'>Anda yakin ingin menghapus ?
      </div>
      <div class='modal-footer'>
        <form class="" action="<?php echo site_url('Pengiriman/hapus') ?>" method="post">
          <input type="hidden" value="<?php echo $data->no_sj ?>" name="no_sj">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button class="btn btn-danger" aria-label="Delete" type="submit" name="hapus"><i class="fa fa-trash fa-fw"></i> Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } ?>