<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
             <?php $this->load->view('layout/breadcrumb') ?>
            <div class="row">
                <div class="col-md-12">
                  <div class="panel panel-default">
                  </div>
                </div>
            </div>
            
            <!-- Form Ubah Kategori -->  
            <div id="panel-ubah-kategori" class="panel panel-default" style="display: none">
                    <div class="panel-heading"> 
                        <h3 class="panel-title">UBAH <?php echo strtoupper($menu) ?></h3> 
                    </div> 
                    <div class="panel-body"> 
                      <form role="form" id="frm-ubah-kategori">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>ID Kategori</label>
                                    <input type="text" id="ubah_id_kategori" name="id_kategori" class="form-control" readonly>
                                    <input type="hidden" id="kategori_ubah">
                                    <input type="hidden" id="ubah_id_proyek" name="id_proyek">
                                    <input type="hidden" id="ubah_id_pelaksana" name="id_pelaksana">
                                   
                                </div>
                                <div class="form-group">
                                    <label>Nama Proyek</label>
                                    <input type="text" id="ubah_nama_proyek" name="nama_proyek" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Kategori Pekerjaan</label>
                                    <input type="text" id="ubah_kategori" name="kategori" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Level</label>
                                    <input type="text" id="ubah_level" name="level" class="form-control">
                                </div>
                            </div>
                        </div>
                        <center>
                          <button type="button" id="btn-ubah-bahan" class="btn btn-success waves-effect waves-light" onclick="ubahKategori($('#kategori_ubah').val())"><strong><i class="fa fa-check"></i> PERBAHARUI</strong></button>
                          <button type="button" id="btn-batal-ubah" class="btn btn-warning waves-effect waves-light" onclick="batalUbahKategori()"><strong><i class="fa fa-times"></i> BATAL</strong></button>
                        <center>
                      </form>
                    </div> 
                </div>
                <!--End form ubah kategori-->
                
                <!--Tabel kategori-->
                <div class="col-md-12">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <h3 class="panel-title">TABEL KATEGORI PEKERJAAN</h3>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <br><br>
                                            <table id="tabel-kategori" height="50px" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center" width="3%" height="10%">No.</th>
                                                        <th style="text-align: center" width="10%" height="10%">ID Kategori</th>
                                                        <th style="text-align: center" width="40%" height="10%">Nama Proyek</th>
                                                        <th style="text-align: center" width="25%" height="10%">Kategori Pekerjaan</th>
                                                        <th style="text-align: center" width="5%" height="10%">Level</th>
                                                        <th style="text-align: center" width="8%" height="10%">Aksi</th>
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
                <!--End tabel kategori-->
            </div>
        </div>
    </div>
    
<script type="text/javascript">
     //fungsi autoreload data
    function reloadData(){ 
        tabel.ajax.reload(); 
    }
     //end fungsi auto reload tata

    ///Tampil form ubah kategori
    function TampilubahKategori(id_kategori){
        $.ajax({
            url: "<?php echo base_url() ?>api/getInfoKategori/"+id_kategori,
            type: "POST",
            dataType: "json",
            success: function(data){
                $('#ubah_id_kategori').val(data.id_kategori);
                $('#ubah_nama_proyek').val(data.nama_proyek);
                $('#ubah_kategori').val(data.kategori);
                $('#ubah_id_proyek').val(data.id_proyek);
                $('#ubah_id_pelaksana').val(data.id_pelaksana);
                $('#ubah_level').val(data.level);
            }
        });
        
        $('#panel-ubah-kategori').show();
        $('html, body').animate({scrollTop: '0px'}, 0);
    }
    
    ///function batal ubah
    function batalUbahKategori(){
        $('#panel-ubah-kategori').hide();
    }
    ///end ubah batal
    
    ///aksi ubah kategori
    var ubah_kategori = 0;
    function ubahKategori(kategori) {
        ubah_kategori++;
        if(ubah_kategori == 1){
            if(kategori == 0){
                $.ajax({
                    url: "<?php echo base_url('api/ubahKategori') ?>",
                    type: "POST",
                    data: $('#frm-ubah-kategori').serialize(),
                    dataType: "JSON",
                    success: function(data){
                        tampilNotifikasi(data.Info, 'success');
                        $('#frm-ubah-kategori')[0].reset();
                        reloadData();
                        ubah_kategori = 0;
                    }
                });
            }else{
                $.ajax({
                    url: "<?php echo base_url('api/simpanKategori') ?>",
                    type: "POST",
                    data: $('#frm-ubah-kategori').serialize(),
                    dataType: "JSON",
                    success: function(data){
                        tampilNotifikasi(data.Info, 'success');
                        $('#frm-ubah-kategori')[0].reset();
                        reloadData();
                        ubah_kategori = 0;
                    }
                });
            }
        }
    }
    ///end tampil form ubah kategori       
    
    ///ready function
    $(document).ready(function(){
        $('#menu_master').click();
        $('#menu_kategori_pekerjaan').prop('class','active');

        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings){
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
        
        ///select-proyek
        $(".select2-proyek").select2({
            theme: "bootstrap",
            placeholder: "Pilih Proyek",
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
            }
        });
        //end select proyek
        
        ///Datatable kategori
        tabel = $("#tabel-kategori").DataTable({
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
              "url": "<?php echo base_url('api/getTabelKategoriPekerjaan') ?>",
              "type": "POST",
              data: function (data) {
                data.proyek = $('#kategori-proyek').val();
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
              $('td:eq(0),td:eq(4),td:eq(7),td:eq(8)', row).prop('align','center');
              $('td:eq(6)', row).prop('align','right');
            },
            scrollY: 300,
            scrollCollapse: true
        });
        //end datatable
        
        ///onclick view ubah kategori
        $('#tabel-kategori tbody').on('dblclick', 'tr', function () {
            var data = tabel.row(this).data();
            TampilubahKategori(data[1]);
        });
        //end onclick ubah kategori
        
        ///reload data 
        $('#kategori-proyek').on('change', function() {
          reloadData();
        });
        ///end reload
        
    }); ///end ready function

</script>