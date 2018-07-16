<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <small><b>Halaman Data Pelanggan</b></small>
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
        <label><i class="fa fa-users"></i> Data Pelanggan</label>
      </div>
      <div class="panel-body">
        <table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="pelanggan">
          <thead>
            <tr>
              <th align="center" width="20px">No. </th>
              <th align="center" width="150px"><center>Kode Pelanggan</center></th>
              <th align="center" width="200px"><center>Nama Pelanggan</center></th>
              <th align="center"><center>Alamat</center> </th>
              <th align="center" width="150px"><center>Telepon</center></th>
              <th align="center" width="70px"><center>Edit</center></th>
              <th align="center" width="70px"><center>Hapus</center></th>
            </tr>
          </thead>
          <tbody>
          <?php $no=1; ?>
          <?php foreach($getPelanggan as $data){ ?>
          <tr>
            <td><center><?php echo $no++."."; ?></center></td>
            <td><center><?php echo $data->kd_plg ?></center></td>
            <td><?php echo $data->nm_plg ?></td>
            <td><?php echo $data->alamat ?></td>
            <td><?php echo $data->telepon ?></td>
            <td><center>
              <a href="#Update<?php echo $data->kd_plg ?>" class="btn btn-warning btn-circle" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> </a></center>
            </td>
            <td><center>
              <a href="#Hapus<?php echo $data->kd_plg ?>" class="btn btn-danger btn-circle" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> </a></center>
            </td>
          </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
     </div>
    </div>
  </div>
</section>

<!-- Modal Edit Data Barang -->
<?php foreach($getPelanggan as $data){ ?>
<div class="modal fade" id="Update<?php echo $data->kd_plg ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-users"></i> Ubah Data Pelanggan</h4>
      </div>
      <form method="POST" action="<?php echo site_url('Pelanggan/ubah')?>" enctype="multipart/form-data">
        <div class="modal-body">
          
          <div class="form-group"><label>Kode Pelanggan</label>
            <input required class="form-control required text-capitalize" value="<?php echo $data->kd_plg ?>" data-placement="top" data-trigger="manual" type="text" name="kd_plg" readonly>
          </div>
                
          <div class="form-group"><label>Nama Pelanggan</label>
            <input required class="form-control required text-capitalize" placeholder="Input Nama Pelanggan" data-placement="top" data-trigger="manual" type="text" value="<?php echo $data->nm_plg ?>" name="nm_plg">
          </div>

          <div class="form-group"><label>Alamat</label>
            <textarea class="form-control" name="alamat"><?php echo $data->alamat ?></textarea>
          </div>

          <div class="form-group"><label>Telepon</label>
            <input required class="form-control required text-capitalize" placeholder="Input Nomor Telepon" data-placement="top" data-trigger="manual" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $data->telepon ?>" name="telepon">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Ubah Pelanggan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>

<?php foreach($getPelanggan as $data){ ?>
<div class="modal fade" id="Hapus<?php echo $data->kd_plg ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash fa-fw"></i>Konfirmasi Hapus</h4>
      </div>
      <div class='modal-body'>Anda yakin ingin menghapus ?
      </div>
      <div class='modal-footer'>
        <form class="" action="<?php echo site_url('Pelanggan/hapus') ?>" method="post">
          <input type="hidden" value="<?php echo $data->kd_plg ?>" name="kd_plg">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button class="btn btn-danger" aria-label="Delete" type="submit" name="hapus"><i class="fa fa-trash fa-fw"></i> Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } ?>