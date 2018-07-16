<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <small><b>Halaman Laporan Pemesanan</b></small>
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
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-file-text fa-fw"></i> Laporan Pemesanan Barang</h3>
        </div>

        <div class="box-body">
          <div class="form-group">
            <form action="<?php echo site_url('LaporanPemesanan/CetakLapPemesanan') ?>" method="GET">
              <label class="col-sm-2 control-label" style="margin-top: 5px">Tanggal Awal : </label>
              <div class="col-sm-3">
                <input type="date" name="awal" class="form-control" required>
              </div>
              <label class="col-sm-2 control-label" style="margin-top: 5px">Tanggal Akhir : </label>
              <div class="col-sm-3">
                <input type="date" name="akhir" class="form-control" required>
              </div>
              <div class="col-sm-2">
                <button type="submit" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> PDF</button>
              </div>
              </form>
          </div>
        </div>
        <div class="box-footer">
          <center>

          </center>    
        </div>
      </div>
    </div>
  </div>
</section>



