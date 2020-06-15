<style>
td.details-control {
    background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
}
</style>

<div class="content-page">
    <div class="content">
        <div class="container">
        <?php $this->load->view('layout/breadcrumb') ?>
           
            <div class="row"> <!-- row1 -->
                <div class="col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Ringkasan Bahan Berdasarkan Sumber</h3>
                        </div>
                        <div class="panel-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <span class="badge badge-warning" id="jum_shbj" style="font-size:10pt; font-weight: bold;">0</span>
                                    SHBJ
                                </li>
                                <li class="list-group-item">
                                    <span class="badge badge-danger" id="jum_estimatorid" style="font-size:10pt; font-weight: bold;">0</span>
                                    Estimator.id
                                </li>
                                <li class="list-group-item">
                                    <span class="badge badge-success" id="jum_survei" style="font-size:10pt; font-weight: bold;">0</span>
                                    Survey
                                </li>
                            </ul>
                        </div>
                        <div class="panel-footer">
                            <strong><h4 class="panel-title" style="margin-left: 25px;">Jumlah Bahan <span class="badge badge-primary pull-right" id="jum_sumber" style="font-size:11pt; font-weight: bold; margin-right: 21px;"></span></h4></strong>
                        </div>
                    </div>
                </div>
            </div> <!-- end row1 -->

 <!-- Form Ubah Proyek -->  
                    <div id="panel-ubah-bahan" class="panel panel-default" style="display: none">
                        <div class="panel-heading"> 
                            <h3 class="panel-title">UBAH <?php echo strtoupper($menu) ?></h3> 
                        </div> 
                        <div class="panel-body"> 
                        <form role="form" id="frm-ubah-bahan">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label>Nama Bahan</label>
                                        <input type="text" id="ubah-nama-bahan" name="nama_bahan" class="form-control" readonly>
                                        <input type="hidden" id="bahan_ubah">
                                        <input type="hidden" id="ubah_urut_bahan" name="urut_bahan">
                                        <input type="hidden" id="ubah_id_wilayah" name="id_wilayah">
                                        <input type="hidden" id="ubah-id-bahan" name="id_bahan">
                                    </div>
                                    <div class="form-group">
                                        <label>Spesifikasi</label>
                                        <input type="text" id="ubah-spesifikasi" name="spesifikasi" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Merk</label>
                                        <input type="text" id="ubah-merk" name="merk" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Satuan</label>
                                        <input type="text" id="ubah-satuan" name="satuan" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label>Harga Dasar</label>
                                        <input type="text" id="ubah-harga-dasar" name="harga_dasar" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <div id="ubah-spinner-tahun">
                                          <div class="input-group input-small">
                                              <input type="text" id="ubah_tahun" name="tahun" class="spinner-input form-control" maxlength="4" readonly="">
                                              <div class="spinner-buttons input-group-btn btn-group-vertical">
                                                  <button type="button" class="btn spinner-up btn-xs btn-default waves-effect">
                                                      <i class="fa fa-angle-up"></i>
                                                  </button>
                                                  <button type="button" class="btn spinner-down btn-xs btn-default waves-effect">
                                                      <i class="fa fa-angle-down"></i>
                                                  </button>
                                              </div>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Sumber</label>
                                        <select id="ubah-sumber" name="sumber" class="form-control" onchange="getSuggestTahun(2);getSuggestKeterangan(2)">
                                          <option value="">- Pilih -</option>
                                          <option value="1">SHBJ</option>
                                          <option value="2">Estimator.id</option>
                                          <option value="0">Survei</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" id="ubah-keterangan" name="keterangan" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <center>
                              <button type="button" id="btn-ubah-bahan" class="btn btn-success waves-effect waves-light" onclick="ubahBahan($('#bahan_ubah').val())"><strong><i class="fa fa-check"></i> PERBAHARUI</strong></button>
                              <button type="button" id="btn-batal-ubah" class="btn btn-warning waves-effect waves-light" onclick="batalUbahBahan()"><strong><i class="fa fa-times"></i> BATAL</strong></button>
                            <center>
                          </form>
                        </div> 
                    </div>
                <!--End form ubah kategori-->

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <h3 class="panel-title"><?php echo "DATA ".strtoupper($menu) ?></h3>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <br><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Wilayah</label>
                                        <div class="form-group">
                                            <select class="select2-wilayah required" style="width: 100%;" id="wilayah_bahan">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label>Proyek</label>
                                        <div class="form-group">
                                            <select class="select2-proyek required" style="width: 100%;" id="namaproyek">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label>Sumber</label>
                                        <div class="form-group">
                                            <select id="sumber" name="sumber" class="form-control" onchange="">
                                            <option value="">- Pilih -</option>
                                            <option value="1">SHBJ</option>
                                            <option value="2">ESTIMATOR ID</option>
                                            <option value="0">SURVEY</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table id="tabel-bahan" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th style="text-align: center" width="3%">No.</th>
                                            <th style="text-align: center" width="3%">ID Bahan</th>
                                            <th style="text-align: center" width="15%">ID Proyek Bahan</th>
                                            <th style="text-align: center" width="15%">ID Proyek Bahan</th>
                                            <th style="text-align: center" width="15%">Wilayah</th>
                                            <th style="text-align: center" width="20%">Nama Bahan</th>
                                            <th style="text-align: center" width="15%">Satuan</th>
                                            <th style="text-align: center" width="13%">Spesifikasi</th>
                                            <th style="text-align: center" width="13%">Merk</th>
                                            <th style="text-align: center" width="13%">Harga Dasar</th>
                                            <th style="text-align: center" width="13%">Sumber</th>
                                            <th style="text-align: center" width="5%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>

        </div> <!-- end container -->
    </div> <!-- end content -->
</div> <!--end content-page -->


<script type="text/javascript">
    ///reload data
    function reloadData(){
        tabel.ajax.reload();
    }
    
    ///batal ubah
    function batalUbahBahan(){
        $('#panel-ubah-bahan').hide();
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
    var ubah_bahan = 0;
    function ubahBahan(bahan){
        ubah_bahan++;
        if(ubah_bahan == 1){
            if(bahan == 0){
                $.ajax({
                    url: "<?php echo base_url('api/ubahBahan') ?>",
                    type: "POST",
                    data: $('#frm-ubah-bahan').serialize(),
                    dataType: "JSON",
                    success: function(data){
                        tampilNotifikasi(data.Info, 'success');
                        $('#frm-ubah-bahan')[0].reset();
                        reloadData();
                        ubah_bahan = 0;
                    }
                });
            }else{
                $.ajax({
                    url: "<?php echo base_url('api/simpanBahan') ?>",
                    type: "POST",
                    data: $('#frm-ubah-bahan').serialize(),
                    dataType: "JSON",
                    success: function(data){
                        tampilNotifikasi(data.Info,'success');
                        $('#frm-ubah-bahan')[0].reset();
                        reloadData();
                        ubah_bahan = 0;
                    }
                });
            }
        }
    }
    ///end ubah bahan
    
    ///Tampil form ubah bahan
    function TampilUbahBahan(urut){
        $.ajax({
            url: "<?php echo base_url() ?>api/getInfoBahan/"+id_bahan,
            type: "POST",
            dataType: "json",
            success: function(data){
                $('#ubah-id-bahan').val(data.id_bahan);
                $('#ubah-nama-bahan').val(data.nama_bahan);
                $('#ubah-spesifikasi').val(data.spesifikasi);
                $('#ubah-merk').val(data.merk);
                $('#ubah-satuan').val(data.satuan);
                $('#ubah-harga-dasar').val(data.harga_dasar);
                $('#ubah-sumber').val(data.sumber);
                $('#ubah-keterangan').val(data.keterangan);
            }
        });

    $('#panel-ubah-bahan').show();
   $('html, body').animate({scrollTop: '0px'}, 0);
  }
    ///end tampil ubah bahan
   
    function format () {
    var rincian_ahs = '';
    rincian_ahs = 
    ` <div id="total">Total Terpakai : <span class="badge badge-warning" id="total" style="font-size:10pt; font-weight: bold;">0</span></div>
                                
    <table id="tabel-bahan-terpakai" width="70%" class="table table-striped table-bordered">
            <thead>
                <tr>
                    
                    <th style="text-align: center" width="3%">No.</th>
                    <th style="text-align: center" width="10%">ID AHS</th>
                    <th style="text-align: center" width="15%">Nama Pekerjaan</th>
                    <th style="text-align: center" width="15%">Nama Proyek</th>

                </tr>
            </thead>
            <tbody></tbody>
        </table>`

    return rincian_ahs;
  }

    ///ready function 
    $(document).ready(function(){
        $('#menu_estimasi').click();
        $('#menu_bahan').prop('class','active');

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
        $(".select2-proyek").select2({
        theme: "bootstrap",
          placeholder: "Pilih Proyek",
          allowClear: true,
          "language": {
            "noResults": function() {
               return "<center><img src='<?php echo base_url() ?>assets/not-found.svg' width='30' /><br><strong>Tidak ada hasil ditemukan</strong></center>";
            },
            searching: function () {
               return "<center><img src='<?php echo base_url() ?>assets/searching.gif' width='30' /><br>Mencari hasil...</center>";
            },
            loadingMore: function () {
               return "<center><img src='<?php echo base_url() ?>assets/ajax-loader.svg' width='30'/></center>";
            }
          },
          escapeMarkup: function (markup) {
               return markup;
          },
          ajax: {
            url: "<?php echo base_url('api/getListProyek') ?>",
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term,
                page_limit: 10,
                page: params.page
              };
            },
            processResults: function (data, params) {
              params.page = params.page || 1;
    
              return {
                results: data.results,
                pagination: {
                  more: (params.page * 10) < data.total_count
                }
              };
            },
            cache: true
          },
          templateResult: formatData
      });
      $(".select2-wilayah").select2({
          theme: "bootstrap",
          placeholder: "Pilih Wilayah",
          allowClear: true,
          "language": {
            "noResults": function() {
               return "<center><img src='<?php echo base_url() ?>assets/not-found.svg' width='30' /><br><strong>Tidak ada hasil ditemukan</strong></center>";
            },
            searching: function () {
               return "<center><img src='<?php echo base_url() ?>assets/searching.gif' width='30' /><br>Mencari hasil...</center>";
            },
            loadingMore: function () {
               return "<center><img src='<?php echo base_url() ?>assets/ajax-loader.svg' width='30'/></center>";
            }
          },
          escapeMarkup: function (markup) {
               return markup;
          },
          ajax: {
            url: "<?php echo base_url('api/getListWilayah') ?>",
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term,
                page_limit: 10,
                page: params.page
              };
            },
            processResults: function (data, params) {
              params.page = params.page || 1;
    
              return {
                results: data.results,
                pagination: {
                  more: (params.page * 10) < data.total_count
                }
              };
            },
            cache: true
          },
          templateResult: formatData
      });

      $(".select2-proyek").select2({
          theme: "bootstrap",
          placeholder: "Pilih Proyek",
          allowClear: true,
          "language": {
            "noResults": function() {
               return "<center><img src='<?php echo base_url() ?>assets/not-found.svg' width='30' /><br><strong>Tidak ada hasil ditemukan</strong></center>";
            },
            searching: function () {
               return "<center><img src='<?php echo base_url() ?>assets/searching.gif' width='30' /><br>Mencari hasil...</center>";
            },
            loadingMore: function () {
               return "<center><img src='<?php echo base_url() ?>assets/ajax-loader.svg' width='30'/></center>";
            }
          },
          escapeMarkup: function (markup) {
               return markup;
          },
          ajax: {
            url: "<?php echo base_url() ?>api/getListProyek",
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term,
                page_limit: 10,
                page: params.page
              };
            },
            processResults: function (data, params) {
              params.page = params.page || 1;
    
              return {
                results: data.results,
                pagination: {
                  more: (params.page * 10) < data.total_count
                }
              };
            },
            cache: true
          },
          templateResult: formatData
      });
        
          //datatables
            tabel = $('#tabel-bahan').DataTable({ 
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
            "url": "<?php echo base_url('api/getTabelBahan')?>",
            "type": "POST",
            data: function(data){
            data.wilayah = $('#wilayah_bahan').val();
            data.namaproyek = $('#namaproyek').val();
            data.sumber = $('#sumber').val();
                console.log(data.wilayah);
            }
        },
        "columnDefs": [
          {
            "targets": [2,4,5],
            "visible": false,
           // "searchable": false
          }
        ],
         order: [5, 'asc'],
         "bInfo": false,
         rowCallback: function (row, data, iDisplayIndex) {
         var info = this.fnPagingInfo();
         var page = info.iPage;
         var length = info.iLength;
         var index = page * length + (iDisplayIndex + 1);
         $('td:eq(0)', row).addClass("details-control");
         $('td:eq(1)', row).html(index);
         $('td:eq(1),td:eq(3),td:eq(7),td:eq(8)', row).prop('align','center');
         $('td:eq(6)', row).prop('align','right');
    },
    scrollY: 300,
    scrollCollapse: true
    });
    ///end datatables
    
    $('#tabel-bahan tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = tabel.row(tr);
        var data = row.data();
     //   var id_proyekbahan = data[3];
        var id_proyekproyek = data[4];
        var id_bahan = data[2];
 
        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {

            // $.ajax({
            //     url : "<?php echo base_url('api/getRincianBahanTerpakai/') ?>"+id_proyekbahan+"/"+id_proyekproyek+"/"+bahan,
            //     type: "POST",
            //     dataType: "JSON",
            //     success: function(data){
                 
            //     }
            // });
            row.child(format()).show();
            tr.addClass('shown');
        }
          tabel_bahan_terpakai = $("#tabel-bahan-terpakai").DataTable({
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
              "url": "<?php echo base_url('api/getTabelBahanTerpakai') ?>",
              "type": "POST",
              data: function (data) {
                data.id_bahan = id_bahan;
               // data.id_proyekbahan = id_proyekbahan;
                data.id_proyekproyek = id_proyekproyek;
              }
            },
            // "columnDefs": [
            //   {
            //     "targets": [ 13, 14 ],
            //     "visible": false,
            //     "searchable": false
            //   }
            // ],
            order: [2, 'asc'],
            "bInfo": false,
            rowCallback: function (row, data, iDisplayIndex) {
              var info = this.fnPagingInfo();
              var page = info.iPage;
              var length = info.iLength;
              var index = page * length + (iDisplayIndex + 1);
           
              $('td:eq(0)', row).html(index);
              $('td:eq(1),td:eq(4),td:eq(5),td:eq(6)', row).prop('align','center');
            },
            scrollY: 700,
            scrollCollapse: true
          });
      });

      $('#wilayah_bahan,#sumber,#namaproyek').on('change', function() {
          reloadData();
        //   reloadDataLengkapi();
          getRingkasanStatus($(this).val());
      });

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