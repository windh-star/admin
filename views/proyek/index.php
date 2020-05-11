<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
             <?php $this->load->view('layout/breadcrumb') ?>
                 <div class="row">
                <div class="col-md-12">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <h3 class="panel-title">FILTERING</h3>
                      </div>
                      <div class="panel-body">
                          <div class="row">
                              <div class="col-md-4">
                                  <label>Filtering Wilayah</label>
                                  <div class="form-group">
                                      <select class="select2-wilayah required" style="width: 100%;" id="proyek-wilayah">
                                        <option value=""></option>
                                      </select>
                                  </div>
                              </div>
                              
                               <div class="col-md-4">
                                  <label>Filtering Tahun</label>
                                   <div class="form-group">
                                        <input type="text" id="proyek-tahun" name="tahun" class="form-control" placeholder="Tulis Tahun">
                                    </div>
                                  </div>
                              
                             <div class="col-md-4">
                              <label>Filtering Pengguna</label>
                              <div class="form-group">
                                  <select class="select2-pengguna required" style="width: 100%;" id="proyek-pengguna">
                                    <option value=""></option>
                                  </select>
                              </div>
                            </div>
                            </div>
                          </div>
                      </div>
                  </div>
                </div>
                
                 <!-- Form Ubah Proyek -->  
                <div id="panel-ubah-proyek" class="panel panel-default" style="display: none">
                        <div class="panel-heading"> 
                            <h3 class="panel-title">UBAH <?php echo strtoupper($menu) ?></h3> 
                        </div> 
                        <div class="panel-body"> 
                          <form role="form" id="frm-ubah-proyek">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label>ID Proyek</label>
                                        <input type="text" id="ubah_id_proyek" name="id_proyek" class="form-control" readonly>
                                        <input type="hidden" id="proyek_ubah">
                                        <input type="hidden" id="ubah_tgl_dibuat" name="tgl_dibuat">
                                        <input type="hidden" id="ubah_jam_dibuat" name="jam_dibuat">
                                        <input type="hidden" id="ubah_foto_now" name="foto">
                                    </div>
                                    <div class="form-group">
                                        <label>ID Pengguna</label>
                                        <input type="text" id="ubah_id_pengguna" name="id_pengguna" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Proyek</label>
                                        <input type="text" id="ubah_nama_proyek" name="nama_proyek" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Jasa Kontraktor</label>
                                        <input type="text" id="ubah_jasa_kontraktor" name="jasa_kontraktor" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan lain</label>
                                        <input type="text" id="ubah_keterangan_lain" name="keterangan_lain" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label>Pemilik</label>
                                        <input type="text" id="ubah_pemilik" name="pemilik" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Wilayah</label>
                                         <select class="select2-wilayah" style="width: 100%;" id="ubah_nama_wilayah" name="ubah_nama_wilayah">
                                        <option value=""></option>
                                        </select>
                                        <input type="hidden" class="form-control" id="ubah-id_wilayah" name="id_wilayah">
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <input type="text" id="ubah_tahun" name="tahun" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Pajak</label>
                                        <input type="text" id="ubah_pajak" name="pajak" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>status</label>
                                        <input type="text" id="ubah_status" name="status" class="form-control">
                                    </div>
                                    <div class="card">
                                        <div class="imgWrap">
                                            <img src="<?php echo base_url() ?>assets/no_img.png" id="imgView" class="card-img-top img-fluid" style="width:80px">
                                        </div>
                                        <div class="card-body">
                                            <div class="custom-file"></div>
                                        </div>
                                        <label class="custom-file-label" for="ubah_foto" style="cursor:pointer">Pilih Gambar</label>
                                        <br>
                                        <input type="file" id="ubah_foto" class="imgFile custom-file-input" aria-describedby="inputGroupFileAddon01" name="foto" class="form-control">
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <center>
                              <button type="button" id="btn-ubah-proyek" class="btn btn-success waves-effect waves-light" onclick="ubahProyek($('#proyek_ubah').val())"><strong><i class="fa fa-check"></i> PERBAHARUI</strong></button>
                              <button type="button" id="btn-batal-ubah" class="btn btn-warning waves-effect waves-light" onclick="batalUbahProyek()"><strong><i class="fa fa-times"></i> BATAL</strong></button>
                            <center>
                          </form>
                        </div> 
                    </div>
                <!--End form ubah kategori-->
                
                  <div class="row">
                    <div class="col-md-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title">TABEL PROYEK</h3>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <br>
                                                <table id="tabel-proyek" height="400px" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center" width="3%">No.</th>
                                                            <th style="text-align: center" width="5%">ID Proyek</th>
                                                            <th style="text-align: center" width="30%">Nama Proyek</th>
                                                            <th style="text-align: center" width="25%">Wilayah</th>
                                                            <th style="text-align: center" width="30%">Pemilik</th>
                                                            <th style="text-align: center" width="5%">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                          </div>
                                          
                          <div class="panel-body">
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                </div>
</div>
</div>
</div>

<script type="text/javascript">
    ///reload data
    function reloadData(){
        tabel.ajax.reload();
    }
    
    ///batal ubah
    function batalUbahProyek(){
        $('#panel-ubah-proyek').hide();
    }
    ///end reload data
    function getURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            var filename = $('#ubah_foto').val();
            filename = filename.substring(filename.lastIndexOf('\\')+1);
            reader.onload = function(e){
                debugger;
                
                $('#imgView').attr('src', e.target.result);
                $('#imgView').hide();
                $('#imgView').fadeIn(500);
                $('custom-file-label').text(filename);
            }
            reader.readAsDataURL(input.files[0]);
        }
        $(".alert").removeClass("loadAnimate").hide();
    }
    function fadeInAdd(){
        fadeInAlert();
    }
    function fadeInAlert(text){
        $(".alert").text(text).addClass("loadAnimate");
    }
    
    ///ubah proyek
    var ubah_proyek = 0;
    function ubahProyek(proyek){
        ubah_proyek++;
        if(ubah_proyek == 1){
            if(proyek == 0){
                $.ajax({
                    url: "<?php echo base_url('api/ubahProyek') ?>",
                    type: "POST",
                    data: $('#frm-ubah-proyek').serialize(),
                    dataType: "JSON",
                    success: function(data){
                        tampilNotifikasi(data.Info, 'success');
                        $('#frm-ubah-proyek')[0].reset();
                        reloadData();
                        ubah_proyek = 0;
                    }
                });
            }else{
                $.ajax({
                    url: "<?php echo base_url('api/simpanProyek') ?>",
                    type: "POST",
                    data: $('#frm-ubah-proyek').serialize(),
                    dataType: "JSON",
                    success: function(data){
                        tampilNotifikasi(data.Info,'success');
                        $('#frm-ubah-proyek')[0].reset();
                        reloadData();
                        ubah_proyek = 0;
                    }
                });
            }
        }
    }
    ///end ubah proyek
    
    ///Tampil form ubah proyek
    function TampilUbahProyek(id_proyek){
        $.ajax({
            url: "<?php echo base_url() ?>api/getInfoProyek/"+id_proyek,
            type: "POST",
            dataType: "json",
            success: function(data){
                $('#ubah_id_proyek').val(data.id_proyek);
                $('#ubah_id_pengguna').val(data.id_pengguna);
                $('#ubah_nama_proyek').val(data.nama_proyek);
                $('#ubah_nama_wilayah').select2("trigger", "select", {data: {id: data.id_wilayah, text: data.wilayah} });
                $('#ubah-id_wilayah').val(data.id_wilayah);
                $('#ubah_pemilik').val(data.pemilik);
                $('#ubah_tahun').val(data.tahun);
                $('#ubah_jasa_kontraktor').val(data.jasa_kontraktor);
                $('#ubah_pajak').val(data.pajak);
                $('#ubah_keterangan_lain').val(data.ketegrangan_lain);
                $('#ubah_status').val(data.status);
                $('#ubah_foto_now').val(data.foto);
                $('#ubah_tgl_dibuat').val(data.tgl_dibuat);
                $('#ubah_jam_dibuat').val(data.jam_dibuat);
            }
        });
        
    $('#panel-ubah-proyek').show();
    $('html, body').animate({scrollTop: '0px'}, 0);
    }
    ///end tampil ubah proyek
   
    ///ready function 
    $(document).ready(function(){
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
        return {
              "iStart": oSettings._iDisplayStart,
              "iEnd": oSettings.fnDisplayEnd(),
              "iLength": oSettings._iDisplayLength,
              "iTotal": oSettings.fnRecordsTotal(),
              "iFilteredTotal": oSettings.fnRecordsDisplay(),
              "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
              "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
          };
        };
        ///select2 wilayah
        $(".select2-wilayah").select2({
            theme: "bootstrap",
            placeholder: "Pilih Wilayah",
            allowClear: true,
            tags: true,
            "language": {
                "noResults": function(){
                    return "<center><img src='<?php echo base_url() ?>assets/not-found.svg' width='30' /><br><strong>Tidak ada hasil ditemukan</strong></center>";
                },
                searching: function() {
                    return "<center><img src='<?php echo base_url() ?>assets/searching.gif' width='30' /><br>Mencari hasil...</center>";
                },
                loadingMore: function() {
                    return "<center><img src='<?php echo base_url() ?>assets/ajax-loader.svg' width='30'/></center>";
                }
            },
            escapeMarkup: function(markup) {
                return markup;
            },
            ajax: {
                url: "<?php echo base_url() ?>api/getListWilayah",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return{
                        q:params.term,
                        page_limit: 10,
                        page: params.page
                    };
                },
                processResults: function(data, params){
                    params.page = params.page || 1;
                    
                    return {
                        results: data.results,
                        pagination: {
                            more: (params.page * 10) < data.total_count
                        }
                    };
                },
                cache: true
            }
        });
        ///end filter wilayah
        
        ///filtering pengguna
        $(".select2-pengguna").select2({
            theme: "bootstrap",
            placeholder: "Pilih Pengguna",
            allowClear: true,
            tags: true,
            "language": {
                "noResults" : function() {
                    return "<center><img src='<?php echo base_url() ?>assets/not-found.svg' width='30' /><br><strong>Tidak ada hasil ditemukan</strong></center>";
                },
                searching: function() {
                    return "<center><img src='<?php echo base_url() ?>assets/searching.gif' width='30' /><br>Mencari hasil...</center>";
                },
                loadingMore: function() {
                    return "<center><img src='<?php echo base_url() ?>assets/ajax-loader.svg' width='30'/></center>";
                }
            },
            escapeMarkup: function (markup) {
                 return markup;
            },
            ajax: {
                url: "<?php echo base_url() ?>api/getListPengguna",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q:params.term,
                        page_limit: 10,
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    
                    return {
                        results: data.results,
                        pagination: {
                            more: (params.page * 10) < data.total_count
                        }
                    };
                },
                cache: true
            }
        });
        
          //datatables
            tabel = $('#tabel-proyek').DataTable({ 
             "language": {
              "info": "Menampilkan _START_ sampai _END_ dari jumlah data",
              "sInfoEmpty": "",
              "sInfoFiltered": "(terfilter dari _MAX_ data)",
              "emptyTable": "<center><img src='<?php echo base_url() ?>assets/not-found.svg' width='100' /><br><strong>Tidak ada hasil ditemukan</strong></center>",
              "sLengthMenu": "Data per Halaman: _MENU_",
                "sLoadingRecords": "<img src='<?php echo base_url() ?>assets/ajax-loader.svg' /><br>Silakan tunggu, data sedang di-load...",
                "sProcessing": "<img src='<?php echo base_url() ?>assets/ajax-loader.svg' />",
                "sSearch": "Cari Data:",
                "sSearchPlaceholder": "Masukkan kata kunci...",
                "sZeroRecords": "<center><img src='<?php echo base_url() ?>assets/not-found.svg' width='100' /><br><strong>Tidak ada hasil ditemukan</strong></center>",
              "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "previous": "Sebelumnya",
                "next": "Berikutnya"
            }
         },
        processing: true, 
        serverSide: true, 
        ajax: {
            "url": "<?php echo base_url('api/getTabelProyek')?>",
            "type": "POST",
            data: function(data){
                data.wilayah = $('#proyek-wilayah').val();
                data.pengguna = $('#proyek-pengguna').val();
                data.tahun = $('#proyek-tahun').val();
                console.log(data.wilayah);
            }
        },
         order: [1, 'asc'],
         "bInfo": false,
         rowCallback: function (row, data, iDisplayIndex) {
         var info = this.fnPagingInfo();
         var page = info.iPage;
         var length = info.iLength;
         var index = page * length + (iDisplayIndex + 1);
         $('td:eq(0)', row).html(index);
         $('td:eq(0),td:eq(3),td:eq(7),td:eq(8)', row).prop('align','center');
         $('td:eq(6)', row).prop('align','right');
    },
    scrollY: 300,
    scrollCollapse: true
    });
    ///end datatables
    
    ///reload data saat filter wilayah
    $('#proyek-wilayah').on('change', function(){
        reloadData();
    });
    
    $('#proyek-pengguna').on('change', function(){
        reloadData();
    });
    
    $('#proyek-tahun').on('change', function(){
        reloadData();
    });
    
    $('#ubah_foto').change(function(event){
        fadeInAdd();
        getURL(this);
    });
    $('#ubah_foto').on('click', function(event){
        fadeInAdd();
    });
    
});


</script>