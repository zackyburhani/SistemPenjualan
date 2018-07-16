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
      <div class="panel-heading">
        <label><?php echo $no_retur ?></label>        
      </div>
      <form method="POST" action="<?php echo site_url('Retur/simpan') ?>">
      <div class="panel-body">
        <table style="table-layout:fixed" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th align="center" width="50px">No. </th>
              <th align="center"><center>Kode Barang</center></th>
              <th align="center"><center>Nama Barang</center></th>
              <th align="center"><center>Harga</center> </th>
              <th align="center"><center>Jumlah Barang</center> </th>
            </tr>
          </thead>
          <tbody>
          <?php $no=1; ?>
          <?php $brg=1; ?>
          <?php $jr=1; ?>
          <?php foreach($konten as $data){ ?>
          <tr>
            <td><center><?php echo $no++."."; ?></center></td>
            <td><center><?php echo $data->kd_brg ?></center></td>
            <input type="hidden" name="barang<?php echo $brg++ ?>" value="<?php echo $data->kd_brg ?>">
            <input type="hidden" name="no_retur" value="<?php echo $no_retur ?>">
            <input type="hidden" name="no_faktur" value="<?php echo $no_faktur ?>">
            <input type="hidden" name="baris" value="<?php echo $baris ?>">
            <td><center><?php echo $data->nm_brg ?></center></td>
            <td><center><?php echo number_format($data->harga,2,',','.') ?></center></td>
            <td><center>
              <input type="number" name="jml_retur<?php echo $jr++ ?>" value="<?php echo $data->jml_brg ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="1" required class="form-control">
            </center></td>
          </tr>
          <?php } ?>
          </tbody>
        </table>
        <hr>
        <div class="row">
          <div class="col-md-9"></div>
          <div class="col-md-3">
            <a href="<?php echo site_url('Retur/Cari?faktur='.$no_faktur) ?>" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Retur</button>
          </div>
        </div>
        </div>
        </form>
      </div>
     </div>
    </div>
  </div>
</section>


</div>