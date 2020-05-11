<?php $this->load->view('layout/header') ?>

<div class="wrapper-page">
    <div class="panel panel-color panel-primary panel-pages">
        <div class="panel-heading bg-img"> 
            <div class="bg-overlay"></div>
            <h3 class="text-center m-t-10 text-white">
                MASUK SEBAGAI ADMIN
            </h3>
        </div> 

        <div class="panel-body">
            <form class="form-horizontal m-t-20" id="frm-login">
                <div class="form-group" id="col_username">
                    <div class="col-xs-12">
                        <input class="form-control input-lg required" type="text" id="username" name="username" onkeydown="removeWarningLogin($(this).prop('id'))" placeholder="Username" autofocus>
                    </div>
                </div>
                <div class="form-group" id="col_password">
                    <div class="col-xs-12">
                        <input class="form-control input-lg required" type="password" id="password" name="password" onkeydown="removeWarningLogin($(this).prop('id'))" placeholder="Password">
                    </div>
                </div>
                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button type="button" id="btn-login" class="btn btn-primary btn-lg w-lg waves-effect waves-light" onclick="loginPengguna()"><strong><i class="fa fa-sign-in"></i> MASUK</strong></button>
                    </div>
                </div>
            </form> 
        </div>                                 
    </div>
</div>

<?php $this->load->view('layout/script') ?>

<script>
    $(document).ready(function(){
        $('#password').keypress(function(e){
            if(e.which == 13) $('#btn-login').click();
        });
    });
    
    var counter;
    function validasiInputLogin(){
        col_required = document.getElementsByClassName('required');
        var elm = "";
        for (var i = 0; i < col_required.length; i++) {
            elm = col_required[i].id;
            $('#warning_'+elm).remove();
            if ($('#'+elm).val() == "") {
                $('#col_'+elm).prop("class","form-group has-error");
                $('#col_'+elm).append("<span class='label label-danger' id='warning_"+elm+"' style='font-size:9pt; margin-left: 10px; display: inline-block; margin-top: 1px; text-transform: none;'>Kolom "+elm+" tidak boleh kosong</span>");
                counter++;
            }
        }
    }
    
    function removeWarningLogin(elm){
        $('#col_'+elm).prop("class","form-group");
        $('#warning_'+elm).remove();
    }
    
    function tampilNotifikasi(msg,tipe){
        swal({
          position: 'top-end',
          type: tipe,
          html: "<p style='font-size:12pt'>"+msg+"</p>",
          showConfirmButton: false,
          timer: 1500
        });
    }

    var login = 0;
    function loginPengguna() {
        counter = 0;
        validasiInputLogin();
        if (counter == 0) {
            login++;
            if (login == 1) {
                $.ajax({
                    url : "<?php echo base_url('api/loginPengguna') ?>",
                    type: "POST",
                    data: $('#frm-login').serialize(),
                    dataType: "JSON",
                    success: function(data){
                      if(data.Success == true) {
                        tampilNotifikasi(data.Info,'success');
                        window.location.href = "<?php echo base_url('beranda') ?>";
                      } else {
                        tampilNotifikasi(data.Info,'error');
                        $('#frm-login')[0].reset();
                      }
                    }
                });
                login = 0;
            }
        }
    }
</script>

<?php $this->load->view('layout/script') ?>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.backstretch.min.js') ?>"></script>
<script>
    $.backstretch("<?php echo base_url('assets/img/big/bg-img.jpg') ?>");
</script>