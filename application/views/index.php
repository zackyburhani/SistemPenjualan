  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Main content -->
    <section class="content">
      <!--START CONTENT LABEL-->
      <div class="bs-callout bs-callout-success">
        <style type="text/css">
          .bs-callout {
              padding: 20px;
              margin: 20px 0;
              border: 1px solid #d9d9d9;
              border-left-width: 5px;
              border-radius: 3px;
          }
          .bs-callout h4 {
              margin-top: 0;
              margin-bottom: 5px;
          }
          .bs-callout p:last-child {
              margin-bottom: 0;
          }
          .bs-callout code {
              border-radius: 3px;
          }
          .bs-callout+.bs-callout {
              margin-top: -5px;
          }
          .bs-callout-success {
              background-color:  #d9d9d9;
              /*border-left-color: #5cb85c;*/
          }
        </style>
        <div class="row">
          <div class="form-group">
            <img class="col-md-1" src="<?php echo site_url('assets/img/logo.png')?>" width="500px">
            <div class="col-md-11">
              <h4 style="margin-top: 20px;"><strong> SISTEM INFORMASI PENJUALAN TUNAI PT. TRIMITRA INTI GEMILANG </strong></h4>
            </div>
        </div>
      </div>
    </div>
    <!--EDN CONTENT LABEL-->

      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-4">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?php echo $totalPelanggan ?></h3>

              <p>Data Pelanggan</p>
            </div>
            <div class="icon">
              <i class="fa fa-users fa-fw"></i>
            </div>
            <a href="<?php echo site_url('Pelanggan') ?>" class="small-box-footer">Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-md-4">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $totalBarang ?></h3>

              <p>Data Barang</p>
            </div>
            <div class="icon">
              <i class="fa fa-cube"></i>
            </div>
            <a href="<?php echo site_url('Barang') ?>" class="small-box-footer">Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $totalPO ?></h3>

              <p>Data Purchase Order</p>
            </div>
            <div class="icon">
              <i class="fa fa-tags"></i>
            </div>
            <a href="<?php echo site_url('PurchaseOrder') ?>" class="small-box-footer">Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $totalFaktur ?></h3>

              <p>Data Pembayaran</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="<?php echo site_url('Pembayaran') ?>" class="small-box-footer">Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $totalRetur ?></h3>

              <p>Data Retur</p>
            </div>
            <div class="icon">
              <i class="fa fa-wrench"></i>
            </div>
            <a href="<?php echo site_url('Retur') ?>" class="small-box-footer">Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- right col -->
  </div>
  <!-- /.content-wrapper -->