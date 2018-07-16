<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <small><b>Halaman Data Barang</b></small>
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
        <button class="btn btn-default" data-toggle="modal" href="#" data-target="#ModalEntryBarang"><i class="fa fa-plus"></i></button> <label> Tambah Data Barang </label>
      </div>
      <div class="panel-body">
        <table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="barang">
          <thead>
            <tr>
              <th align="center" width="20px">No. </th>
              <th align="center"><center>Kode Barang</center></th>
              <th align="center"><center>Nama Barang</center></th>
              <th align="center"><center>Jenis Barang</center> </th>
              <th align="center"><center>Satuan</center></th>
              <th align="center"><center>Harga / Rp.</center></th>
              <th align="center"><center>Stok</center></th>
              <th align="center" width="70px"><center>Edit</center></th>
              <th align="center" width="70px"><center>Hapus</center></th>
            </tr>
          </thead>
          <tbody>
          <?php $no=1; ?>
          <?php foreach($getBarang as $data){ ?>
          <tr>
            <td><center><?php echo $no++; ?></center></td>
            <td><center><?php echo $data->kd_brg ?></center></td>
            <td><?php echo $data->nm_brg ?></td>
            <td><center><?php echo $data->jns_brg ?></center></td>
            <td><center><?php echo $data->satuan ?></center></td>
            <td><center><?php echo number_format($data->harga,2,',','.') ?></center></td>
            <td><center><?php echo $data->stok ?></center></td>
            <td><center>
              <a href="#Update<?php echo $data->kd_brg ?>" class="btn btn-warning btn-circle" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> </a></center>
            </td>
            <td><center>
              <a href="#Hapus<?php echo $data->kd_brg ?>" class="btn btn-danger btn-circle" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> </a></center>
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


<!-- Modal Entry Data Barang -->
<div class="modal fade" id="ModalEntryBarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cube"></i> Tambah Data Barang</h4>
      </div>
      <form method="POST" action="<?php echo site_url('Barang/simpan')?>" enctype="multipart/form-data">
        <div class="modal-body">
          
          <div class="form-group"><label>Kode Barang</label>
            <input required class="form-control required text-capitalize" value="<?php echo $kd_brg ?>" data-placement="top" data-trigger="manual" type="text" name="kd_brg" readonly>
          </div>
                
          <div class="form-group"><label>Nama Barang</label>
            <input required class="form-control required text-capitalize" placeholder="Input Nama Barang" data-placement="top" data-trigger="manual" type="text" name="nm_brg">
          </div>

          <div class="form-group"><label>Jenis Barang</label>
            <div class="custom-select my-1 mr-sm-2 ">
              <select class="form-control" name="jns_brg">
                <option value="Marine Lubricants">Marine Lubricants</option>
                <option value="Transmission Oils">Transmission Oils</option>
                <option value="Semi Synthetic Coolant">Semi Synthetic Coolant</option>
                <option value="Full Synthetic Grinding Coolant">Full Synthetic Grinding Coolant</option>
                <option value="Industrial Lubricants">Industrial Lubricants</option>
              </select>
            </div>
          </div>

          <div class="form-group"><label>Satuan</label>
            <div class="custom-select my-1 mr-sm-2">
              <select class="form-control" name="satuan">
                <option value="Pail">Pail</option>
                <option value="Drum">Drum</option>
                <option value="Tangki">Tangki</option>
                <option value="Dirigen">Dirigen</option>
              </select>
            </div>
          </div>

          <div class="form-group"><label>Harga</label>
            <input required class="form-control required text-capitalize" placeholder="Input Harga" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="0" data-placement="top" data-trigger="manual" type="number" name="harga">
          </div>

          <div class="form-group"><label>Stok</label>
            <input required class="form-control required text-capitalize" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="0" placeholder="Input Stok" data-placement="top" data-trigger="manual" type="number" name="stok">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Barang</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Edit Data Barang -->
<?php foreach($getBarang as $data){ ?>
<div class="modal fade" id="Update<?php echo $data->kd_brg ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cube"></i> Ubah Data Barang</h4>
      </div>
      <form method="POST" action="<?php echo site_url('Barang/ubah')?>" enctype="multipart/form-data">
        <div class="modal-body">
          
          <div class="form-group"><label>Kode Barang</label>
            <input required class="form-control required text-capitalize" value="<?php echo $data->kd_brg ?>" data-placement="top" data-trigger="manual" type="text" name="kd_brg" readonly>
          </div>
                
          <div class="form-group"><label>Nama Barang</label>
            <input required class="form-control required text-capitalize" placeholder="Input Nama Barang" data-placement="top" data-trigger="manual" type="text" value="<?php echo $data->nm_brg ?>" name="nm_brg">
          </div>

          <div class="form-group"><label>Jenis Barang</label>
            <div class="custom-select my-1 mr-sm-2">
              <select class="form-control" name="jns_brg">
                <option <?php if( $data->satuan=='Marine Lubricants'){echo "selected"; } ?> value="Marine Lubricants">Marine Lubricants</option>
                <option <?php if( $data->satuan=='Transmission Oils'){echo "selected"; } ?> value="Transmission Oils">Transmission Oils</option>
                <option <?php if( $data->satuan=='Semi Synthetic Coolant'){echo "selected"; } ?> value="Semi Synthetic Coolant">Semi Synthetic Coolant</option>
                <option <?php if( $data->satuan=='Full Synthetic Grinding Coolant'){echo "selected"; } ?> value="Full Synthetic Grinding Coolant">Full Synthetic Grinding Coolant</option>
                <option <?php if( $data->satuan=='Industrial Lubricants'){echo "selected"; } ?> value="Industrial Lubricants">Industrial Lubricants</option>
              </select>
            </div>
          </div>

          <div class="form-group"><label>Satuan</label>
            <div class="custom-select my-1 mr-sm-2">
              <select class="form-control" name="satuan">
                <option <?php if( $data->satuan=='Pail'){echo "selected"; } ?> value="Pail">Pail</option>
                <option <?php if( $data->satuan=='Drum'){echo "selected"; } ?> value="Drum">Drum</option>
                <option <?php if( $data->satuan=='Tangki'){echo "selected"; } ?> value="Tangki">Tangki</option>
                <option <?php if( $data->satuan=='Dirigen'){echo "selected"; } ?> value="Dirigen">Dirigen</option>
              </select>
            </div>
          </div>

          <div class="form-group"><label>Harga</label>
            <input required class="form-control required text-capitalize" placeholder="Input Harga" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="0" data-placement="top" data-trigger="manual" type="number" value="<?php echo $data->harga ?>" name="harga">
          </div>

          <div class="form-group"><label>Stok</label>
            <input required class="form-control required text-capitalize" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="0" placeholder="Input Stok" data-placement="top" data-trigger="manual" type="number" name="stok" value="<?php echo $data->stok ?>">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Ubah Barang</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>

<?php foreach($getBarang as $data){ ?>
<div class="modal fade" id="Hapus<?php echo $data->kd_brg ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash fa-fw"></i>Konfirmasi Hapus</h4>
      </div>
      <div class='modal-body'>Anda yakin ingin menghapus ?
      </div>
      <div class='modal-footer'>
        <form class="" action="<?php echo site_url('Barang/hapus') ?>" method="post">
          <input type="hidden" value="<?php echo $data->kd_brg ?>" name="kd_brg">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button class="btn btn-danger" aria-label="Delete" type="submit" name="hapus"><i class="fa fa-trash fa-fw"></i> Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } ?>