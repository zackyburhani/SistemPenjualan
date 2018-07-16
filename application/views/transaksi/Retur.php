<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <small><b>Halaman Retur Barang</b></small>
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
          <form method="GET" action="<?php echo site_url('Retur/Cari') ?>">
            <div class="col-xs-2">
              <label style="margin-top: 5px">Cari Faktur</label>  
            </div>
            <div class="col-md-6">
              <input type="text" name="faktur" class="form-control">
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

<?php if(isset($Faktur)) { ?>
  <?php if($Faktur != null) { ?>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <center><h4>Faktur</h4></center>
        <hr>
        <div class="row">
          <div class="col-md-6">
            <table style="table-layout:fixed" class="table table-bordered ">
            <tbody>
              <tr>
                <td style="width: 150px">Nomor Faktur</td>
                <td style="width: 10px">:</td>
                <td><?php echo $cari_fetch->no_faktur ?></td>
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
                <td style="width: 150px">Tanggal Faktur</td>
                <td style="width: 10px">:</td>
                <td><?php echo tanggal($cari_fetch->tgl_faktur) ?></td>
              </tr>
              <tr>
                <td>Nomor Surat Jalan</td>
                <td>:</td>
                <td><?php echo $cari_fetch->no_sj ?></td>
              </tr>
              <tr>
                <td>Nomor Surat Terima</td>
                <td>:</td>
                <td><?php echo $cari_fetch->no_stt ?></td>
              </tr>
            </tbody>
          </table>
          </div>
        </div>

        <form method="POST" action="<?php echo site_url('Retur/ReturBarang') ?>">
          <table style="table-layout:fixed" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th align="center"><center>Kode Barang</center></th>
                <th align="center"><center>Nama Barang</center></th>
                <th align="center"><center>Harga / Rp.</center> </th>
                <th align="center"><center>Jumlah</center> </th>
                <th align="center"><center>Jumlah Harga / Rp.</center> </th>
                <th align="center" width="50px">Pilih </th>
              </tr>
            </thead>
            <tbody>
            <?php $no=1; ?>
            <?php $jml=1; ?>
            <?php $tampung = array();?>
            <?php foreach($Faktur as $data){ ?>
            <tr>
              <td><center><?php echo $data->kd_brg ?></center></td>
              <td><?php echo $data->nm_brg ?></td>
              <td><center><?php echo number_format($data->harga,2,',','.') ?></center></td>
              <td><center><?php echo $data->jml_brg ?></center></td>
              <td><center><?php echo number_format($data->jml_brg*$data->harga,2,',','.') ?></center></td>
              <?php $tampung[] = $data->jml_brg*$data->harga ?>
              <td><center>
                  <input type="checkbox" name="barang<?php echo $no++; ?>" value="<?php echo $data->kd_brg ?>">
                  <input type="hidden" name="no_faktur" value="<?php echo $no_faktur ?>">
                  <input type="hidden" name="no_retur" value="<?php echo $no_retur ?>">
                </center></td>
            <?php } ?>
            </tr>
            </tbody>
          </table> 
          <hr>
          <div class="row pull-right">
            <div class="col-xs-12">
            <a href="<?php echo site_url('Retur') ?>" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Proses Retur</button> 
          </div>
          </div>
        </div>
      </form>
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
      <div class="panel-body">
         <table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="barang">
            <thead>
              <tr>
                <th align="center" width="50px">No. </th>
                <th align="center"><center>Nomor Retur</center></th>
                <th align="center"><center>Tanggal Retur</center></th>
                <th align="center"><center>Nomor Faktur</center> </th>
                <th align="center"><center>Cetak</center> </th>
                <th align="center"><center>Detail</center> </th>
              </tr>
            </thead>
            <tbody>
            <?php $no=1; ?>
            <?php foreach($getRetur as $data){ ?>
            <tr>
              <td><center><?php echo $no++ ?></center></td>
              <td><center><?php echo $data->no_retur ?></center></td>
              <td><center><?php echo tanggal($data->tgl_retur) ?></center></td>
              <td><center><?php echo $data->no_faktur ?></center></td>
              <td><center> <a href="<?php echo site_url('Retur/cetakRetur/'.$data->no_retur.'/'.$data->tgl_retur.'/'.$data->no_faktur) ?>" class="btn btn-info btn-circle" data-toggle="modal"><span class="glyphicon glyphicon-print"></span> </a></center>
              </td>
              <td><center>
                <a href="#Detail<?php echo $data->no_retur ?>" class="btn btn-primary btn-circle" data-toggle="modal"><span class="fa fa-folder-open"></span> </a></center>
              </td>
            <?php } ?>
            </tr>
            </tbody>
          </table> 
      </div>
     </div>
    </div>
  </div>


</section>

<?php foreach($getRetur as $data){ ?>
<div class="modal fade" id="Detail<?php echo $data->no_retur ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-wrench"></i> Detail Retur <?php echo $data->no_retur ?></h4>
      </div>
      <div class="modal-body">
        <?php $detail_fetch = $this->Model_Retur->cetakRetur_fetch($data->no_retur); ?>
        <div class="col-md-6">
          <table style="table-layout:fixed" class="table table-bordered ">
            <tbody>
              <tr>
                <td style="width: 150px">Nomor Retur</td>
                <td style="width: 10px">:</td>
                <td><?php echo $detail_fetch->no_retur ?></td>
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
                <td style="width: 150px">Tanggal Retur</td>
                <td style="width: 10px">:</td>
                <td><?php echo tanggal($detail_fetch->tgl_retur) ?></td>
              </tr>
              <tr>
                <td>Nomor Faktur</td>
                <td>:</td>
                <td><?php echo $detail_fetch->no_faktur ?></td>
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
                <th align="center"><center>Jumlah Retur</center> </th>
              </tr>
            </thead>
            <tbody>
            <?php $no=1; ?>
            <?php $detail = $this->Model_Retur->cetakRetur($data->no_retur); ?>
            <?php foreach($detail as $data){ ?>
            <tr>
              <td><center><?php echo $no++ ?></center></td>
              <td><center><?php echo $data->kd_brg ?></center></td>
              <td><center><?php echo $data->nm_brg ?></center></td>
              <td><center><?php echo $data->jml_retur ?></center></td>
            <?php } ?>
            </tr>
            </tbody>
          </table> 
        </div>
    </div>
  </div>
</div>
<?php } ?>


</div>