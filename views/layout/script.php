<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/js/waves.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>
<!--<script src="<?php echo base_url('assets/vendor/chat/moment-2.2.1.js') ?>"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url('assets/vendor/jquery-detectmobile/detect.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>

<!-- sweet alerts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.24.1/sweetalert2.min.js"></script>
<!--<script src="<?php echo base_url('assets/vendor/sweet-alert/sweet-alert.init.js') ?>"></script>-->

<!-- flot Chart -->
<!-- <script src="<?php echo base_url('assets/vendor/flot-chart/jquery.flot.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/flot-chart/jquery.flot.time.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/flot-chart/jquery.flot.tooltip.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/flot-chart/jquery.flot.resize.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/flot-chart/jquery.flot.pie.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/flot-chart/jquery.flot.selection.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/flot-chart/jquery.flot.stack.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/flot-chart/jquery.flot.crosshair.js') ?>"></script> -->

<!-- Counter-up -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js" type="text/javascript"></script>

<!-- CUSTOM JS -->
<script src="<?php echo base_url('assets/js/jquery.app.js') ?>"></script>

<!-- Dashboard -->
<script src="<?php echo base_url('assets/js/jquery.dashboard.js') ?>"></script>

<!-- Chat -->
<!-- <script src="<?php echo base_url('assets/js/jquery.chat.js') ?>"></script> -->

<!-- Todo -->
<!-- <script src="<?php echo base_url('assets/js/jquery.todo.js') ?>"></script> -->

<!-- Datatable -->
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>
<!-- <script src="<?php echo base_url('assets/vendor/jquery-datatables-editable/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/jquery-datatables-editable/datatables.editable.init.js') ?>"></script>-->

<!-- Select2 -->
<script src="<?php echo base_url('assets/vendor/select2/js/select2.js') ?>"></script>

<!-- Notification -->
<script src="<?php echo base_url('assets/vendor/notifications/notify.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/notifications/notify-metro.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/notifications/notifications.js') ?>"></script>

<!-- Magnific popup -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/0.9.9/jquery.magnific-popup.min.js"></script>

<!-- Spinner -->
<script src="<?php echo base_url('assets/vendor/spinner/spinner.min.js') ?>"></script>

<!-- Input mask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.extensions.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.numeric.extensions.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/jquery.inputmask.min.js"></script>

<script type="text/javascript">
    /* ==============================================
    Counter Up
    =============================================== */
    jQuery(document).ready(function($) {
        $('.counter').counterUp({
            delay: 100,
            time: 1200
        });
    });
</script>

<script>
  $(document).ready(function() {
      $('.required').each(function(){
        $(this).on('keydown',function(){
            removeWarning($(this).prop('id'));
        }).on('change', function(){
            removeWarning($(this).prop('id'));
        })
      });
      
      $('.required-ubah').each(function(){
        $(this).on('keydown',function(){
            removeWarning($(this).prop('id'));
        }).on('change', function(){
            removeWarning($(this).prop('id'));
        })
      });
      
      $('[id^=btn-batal]').on('click',function(){
        $('.required').each(function(){
            removeWarning($(this).prop('id'))
        });
      });
  })
  
  var counter;
  function validasiInput(){
    col_required = document.getElementsByClassName('required');
    var elm = "";
    for (var i = 0; i < col_required.length; i++) {
        elm = col_required[i].id;
        $('#warning_'+elm).remove();
        if ($('#'+elm).val() == "") {
            $('#col_'+elm).prop("class","form-group has-error");
            $('#col_'+elm).append("<span class='label label-danger' id='warning_"+elm+"' style='font-size:9pt; display: inline-block; margin-top: 0px; text-transform: none;'>Kolom "+elm.replace("id_","").replace("_"," ")+" tidak boleh kosong</span>");
            counter++;
        }
    }
  }
  
  function validasiInputUbah(){
    col_required = document.getElementsByClassName('required-ubah');
    var elm = "";
    for (var i = 0; i < col_required.length; i++) {
        elm = col_required[i].id;
        $('#warning_'+elm).remove();
        if ($('#'+elm).val() == "") {
            $('#col_'+elm).prop("class","form-group has-error");
            $('#col_'+elm).append("<span class='label label-danger' id='warning_"+elm+"' style='font-size:9pt; display: inline-block; margin-top: 0px; text-transform: none;'>Kolom "+elm.replace("id_","").replace("ubah_","").replace("_"," ")+" tidak boleh kosong</span>");
            counter++;
        }
    }
  }

  function removeWarning(elm){
    $('#col_'+elm).prop("class","form-group");
    $('#warning_'+elm).remove();
  }
</script>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

<script>
   (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
   (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
   m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
   })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
   ga('create', 'UA-XXXXX-X');
   ga('send', 'pageview');
</script>