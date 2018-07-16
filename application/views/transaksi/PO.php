<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <small><b>Halaman Data Purchase Order</b></small>
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
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <i class="fa fa-tag"></i>
          <span> Tambah Purchase Order</span>
       </strong>
      </div>
      <div class="panel-body">
        <form method="POST" action="<?php echo base_url('PurchaseOrder/detilPesan') ?>">
          <div class="form-group">
            <div class="row">
              <div class="col-md-1">
                <label class="control-label">Barang</label>
              </div>
              <div class="col-md-4">
                <select class="form-control" name="kd_brg">
                  <?php foreach($data as $barang) { ?>
                  <option value="<?php echo $barang->kd_brg ?>"><?php echo $barang->nm_brg ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-1">
                <label class="control-label">Jumlah</label>
              </div>
              <div class="col-md-3">
                <input type="number" name="qty" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="1" required class="form-control">
              </div>
              <div class="col-md-3">
                <button type="submit" class="btn btn-primary btn-md btn-block" ><span class="fa fa-plus"></span> Tambah Data</button>
              </div>
            </div>
          </div>
          <hr>
        </form>
      </div>
    </div>
  </div>
</div>

<?php if(isset($Validasi)) { ?>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <label>Detail Purchase Order</label>
      </div>
      <div class="panel-body">
        <table style="table-layout:fixed" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th align="center" width="50px">No. </th>
              <th align="center"><center>Kode Barang</center></th>
              <th align="center"><center>Nama Barang</center></th>
              <th align="center"><center>Harga</center></th>
              <th align="center"><center>Jumlah</center></th>
              <th align="center"><center>Jumlah Harga / Rp.</center></th>
              <th align="center"><center>Hapus</center></th>
            </tr>
          </thead>
          <tbody>
            <form method="POST" action="<?php echo site_url('PurchaseOrder/simpan')?>" enctype="multipart/form-data">
            <?php $no=1; ?>
            <?php $total = array(); ?>
            <?php foreach($detilPesan as $data) { ?>
            <tr>
              <td><center><?php echo $no++."."; ?></center></td>
              <td><center><?php echo $data->kd_brg ?></center></td>
              <td><?php echo $data->nm_brg ?></td>
              <td><center><?php echo number_format($data->harga,2,',','.') ?></center></td>
              <td><center><?php echo $data->jml_brg ?></center></td>
              <td><center><?php echo number_format($data->jml_brg*$data->harga,2,',','.') ?></center></td>
              <?php $total[] = $data->jml_brg*$data->harga ?>
              <td><center><a href="<?php echo site_url('PurchaseOrder/hapusDetil/'.$data->kd_brg) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a></center></td>
            </tr>
            <?php } ?>
            <tr>
              <td colspan="5"><center><b>TOTAL</b></center></td>
              <?php $tampung = (array_sum($total)) ?>
              <td><center><b><?php echo number_format($tampung,2,',','.') ?></b></center></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="panel-footer">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-4"></div>
          <div class="col-md-3">
            <a href="<?php echo site_url('PurchaseOrder/hapusSemua'); ?>" type="submit" class="btn btn-danger btn-md btn-block" ><span class="fa fa-close"></span> Batal</a>
          </div>
          <div class="col-md-3">
            <button type="button" data-target="#ModalEntryPO" data-toggle="modal" class="btn btn-primary btn-md btn-block" ><span class="fa fa-sign-out"></span> Proses Pesanan</button>
          </div>
        </div>
      </div>
     </div>
    </div>
  </div>

<?php } ?>

<div class="modal fade" id="ModalEntryPO" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cube"></i> ID Purchase Order <?php echo $getKdPO ?></h4>
          <input type="hidden" name="no_po" value="<?php echo $getKdPO ?>">
      </div>
        <div class="modal-body">
          
           <div class="form-group">
            <div class="row">
              <div class="col-md-2">
                <label class="control-label">Tanggal PO</label>
              </div>
              <div class="col-md-4">
                <input type="date" name="tgl_po" value="<?php echo date("Y-m-d");?>" id="tgl_po" readonly class="form-control">  
              </div>
              <div class="col-md-2">
                <label class="control-label">Tanggal Kirim</label>
              </div>
              <div class="col-md-4">
                <input required type="date" name="tgl_kirim" id="tgl_kirim" placeholder="Input Nama Pelanggan" class="form-control">  
              </div>
            </div>
          </div>

          <hr>

          <div class="form-group">
            <div class="row">
              <div class="col-md-2">
                <label class="control-label">Kode Pelanggan</label>
              </div>
              <div class="col-md-4">
                <input type="text" name="kd_plg" value="<?php echo $getKdPlg ?>" readonly class="form-control">  
              </div>
              <div class="col-md-2">
                <label class="control-label">Nama Pelanggan</label>
              </div>
              <div class="col-md-4">
                <input required type="text" name="nm_plg" placeholder="Input Nama Pelanggan" class="form-control">  
              </div>
            </div>
          </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-2">
                  <label class="control-label">Telepon</label>
                </div>
                <div class="col-md-4">
                  <input required type="text" placeholder="Input Nomor Telepon" name="telepon" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control">  
                </div>
                <div class="col-md-2">
                  <label class="control-label">Alamat</label>
                </div>
                <div class="col-md-4">
                  <textarea required name="alamat" class="form-control"></textarea>  
                </div>
              </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Purhase Order</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default" style="margin-bottom: 100px">
      <div class="panel-heading">
        <label>Detail Purchase Order</label>
      </div>
      <div class="panel-body">
        <table style="table-layout:fixed" id="barang" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th align="center" width="50px">No. </th>
              <th align="center"><center>Nomor Purchase Order</center></th>
              <th align="center"><center>Tanggal Purchase Order</center></th>
              <th align="center"><center>Kode Pelanggan</center></th>
              <th align="center"><center>Detail</center></th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; ?>
            <?php foreach($PO as $data) { ?>
            <tr>
              <td><center><?php echo $no++."."; ?></center></td>
              <td><center><?php echo $data->no_po ?></center></td>
              <td><center><?php echo tanggal($data->tgl_po) ?></center></td>
              <td><center><?php echo $data->kd_plg ?></center></td>
              <td><center>
              <a href="#Detail<?php echo $data->no_po ?>" class="btn btn-primary btn-circle" data-toggle="modal"><span class="fa fa-folder-open"></span> </a></center>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
     </div>
    </div>
  </div>


<?php foreach($PO as $data) { ?>
<div class="modal fade" id="Detail<?php echo $data->no_po ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-tag"></i> Detail Purchase Order <?php echo $data->no_po ?></h4>
      </div>
        <div class="modal-body">
          <?php $fetch = $this->Model_PO->getPODetail_fetch($data->no_po); ?>
          <div class="col-md-6">
          <table style="table-layout:fixed" class="table table-bordered ">
            <tbody>
              <tr>
                <td style="width: 150px">Dari</td>
                <td style="width: 10px">:</td>
                <td><?php echo $fetch->nm_plg ?></td>
              </tr>
              <tr>
                <td>Telepon</td>
                <td>:</td>
                <td><?php echo $fetch->telepon ?></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?php echo ucwords($fetch->alamat) ?></td>
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
                <td><?php echo tanggal($fetch->tgl_po) ?></td>
              </tr>
              <tr>
                <td>Kode Pelanggan</td>
                <td>:</td>
                <td><?php echo $fetch->kd_plg ?></td>
              </tr>
            </tbody>
          </table>
        </div>
          
        <table style="table-layout:fixed" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th align="center" width="50px">No. </th>
              <th align="center"><center>Kode Barang</center></th>
              <th align="center"><center>Nama Barang</center></th>
              <th align="center"><center>Harga</center></th>
              <th align="center"><center>Jumlah</center></th>
              <th align="center"><center>Jumlah Harga / Rp.</center></th>
            </tr>
          </thead>
          <tbody>
            <?php $total = array(); ?>
            <?php $no=1; ?>
            <?php $detil = $this->Model_PO->getPODetail($data->no_po); ?>
            <?php foreach($detil as $key) { ?>
            <tr>
              <td><center><?php echo $no++."."; ?></center></td>
              <td><center><?php echo $key->kd_brg ?></center></td>
              <td><?php echo ucwords($key->nm_brg) ?></td>
              <td><center><?php echo number_format($key->harga,2,',','.') ?></center></td>
              <td><center><?php echo $key->jml_brg ?></center></td>
              <td><center><?php echo number_format($key->jml_brg*$key->harga,2,',','.') ?></center></td>
              <?php $total[] = $key->jml_brg*$key->harga ?>
            </tr>
            <?php } ?>
            <tr>
              <td colspan="5"><center><b>TOTAL</b></center></td>
              <?php $tampung = (array_sum($total)) ?>
              <td><center><b><?php echo number_format($tampung,2,',','.') ?></b></center></td>
            </tr>
          </tbody>
        </table>

        </div>
        <div class="modal-footer">
        </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>

</section>