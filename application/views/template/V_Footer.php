<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/jquery-ui/jquery-ui.min.js') ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/raphael/raphael.min.js') ?>"></script>
<script src="<?php echo base_url('assets/AdminLTE/bower_components/morris.js/morris.min.js') ?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') ?>"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js') ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/moment/min/moment.min.js') ?>"></script>
<script src="<?php echo base_url('assets/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/fastclick/lib/fastclick.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/AdminLTE/dist/js/adminlte.min.js') ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/AdminLTE/dist/js/pages/dashboard.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/AdminLTE/dist/js/demo.js') ?>"></script>

<!-- DataTables -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')?>"></script>

<script type="text/javascript">
$(document).ready( function () {
    $('#barang').DataTable();
    $('#pelanggan').DataTable();
    $('#STT').DataTable();
} );
</script>

<script> 
  window.setTimeout(function() {
    $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); });
    $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); 
  }, 3000); 
</script>


<script type="text/javascript">
  $(document).ready(function(){
    $('.add_cart').click(function(){
      var produk_id     = $(this).data("kdbrg");
      var produk_nama   = $(this).data("nmbrg");
      var produk_harga  = $(this).data("harga");
      var produk_jenis  = $(this).data("jnsbrg");
      var produk_satuan = $(this).data("satuan");
      var produk_stok   = $(this).data("stok");
      var quantity      = $('#' + produk_id).val();
      console.log(produk_id);
      $.ajax({
        url : "<?php echo base_url();?>PurchaseOrder/add_to_cart",
        method : "POST",
        data : {produk_id: produk_id, produk_nama: produk_nama, produk_harga: produk_harga, produk_jenis: produk_jenis, produk_satuan: produk_satuan, produk_stok: produk_stok, quantity: quantity},
        success: function(data){
          $('#detail_cart').html(data);
        }
      });
    });

    // Load shopping cart
    $('#detail_cart').load("<?php echo base_url();?>index.php/PurchaseOrder/load_cart");

    //Hapus Item Cart
    $(document).on('click','.hapus_cart',function(){
      var row_id=$(this).attr("id"); //mengambil row_id dari artibut id
      $.ajax({
        url : "<?php echo base_url();?>index.php/PurchaseOrder/hapus_cart",
        method : "POST",
        data : {row_id : row_id},
        success :function(data){
          $('#detail_cart').html(data);
        }
      });
    });
  });
</script>

</body>
</html>