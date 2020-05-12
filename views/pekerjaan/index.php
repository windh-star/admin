<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
             <?php $this->load->view('layout/breadcrumb') ?>
              <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                    <button type="button" id="btn-tambah" class="btn btn-primary waves-effect waves-light" onclick="tampilTambahPekerjaan()"><strong><i class="fa fa-plus-circle"></i> TAMBAH <?php echo strtoupper($menu) ?></strong></button>
                    <br><br>
                    <div id="panel-tambah-pekerjaan" class="panel panel-default" style="display: none">
                        <div class="panel-heading"> 
                            <h3 class="panel-title">TAMBAH <?php echo strtoupper($menu) ?></h3> 
                        </div> 
                        <div class="panel-body"> 
                          <form role="form" id="frm-tambah-alat">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                       <label>Nama Pekerjaan</label>
                                        <input type="text" id="pekerjaan" name="nama_pekerjaaan" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Proyek</label>
                                        <select class="select2-proyek required" style="width: 100%" id="proyek" name="id_proyek">
                                          <option value=""></option>
                                        </select>
                                    </div>
                                    </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label>Pelaksana</label>
                                        <select class="select2-pelaksana required" style="width: 100%" id="proyek" name="id_pelaksana">
                                          <option value=""></option>
                                        </select>
                                    </div>
                                     <div class="form-group">
                                        <label>Level</label>
                                        <select class="select2-level required" style="width: 100%" id="proyek" name="level">
                                          <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <center>
                              <button type="button" id="btn-tambah-kategori" class="btn btn-success waves-effect waves-light" onclick="simpanKategori()"><strong><i class="fa fa-check"></i> SIMPAN</strong></button>
                              <button type="button" id="btn-batal-tambah" class="btn btn-warning waves-effect waves-light" onclick="batalTambahAlat()"><strong><i class="fa fa-times"></i> BATAL</strong></button>
                            <center>
                          </form>
                        </div> 
                    </div>
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <h3 class="panel-title">TABEL PEKERJAAN</h3>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <br><br>
                                            <table id="tabel-pekerjaan" height="50px" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center" width="3%">No.</th>
                                                        <th style="text-align: center" width="40%">Nama Pekerjaan</th>
                                                        <th style="text-align: center" width="40%">Proyek</th>
                                                        <th style="text-align: center" width="8%">Satuan</th>
                                                        <th style="text-align: center" width="10%">Aksi</th>
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
<script type"text/javascript">
function tampilTambahPekerjaan(){
    $('#panel-tambah-pekerjaan').show();
    $('#btn-tambah-pekerjaan').hide();
}
      $(document).ready(function(){
        $('#menu_master').click();
        $('#menu_pekerjaan').prop('class','active');

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
              //datatables
        table = $('#tabel-pekerjaan').DataTable({ 
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
            "processing": true, 
            "serverSide": true, 
           /* "order": [],*/ 
             
            "ajax": {
                "url": "<?php echo base_url('api/getTabelPekerjaan')?>",
                "type": "POST"
            },
         /*   "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            ],*/
            order: [1, 'asc'],
                    rowCallback: function (row, data, iDisplayIndex) {
                    var info = this.fnPagingInfo();
                    var page = info.iPage;
                    var length = info.iLength;
                    var index = page * length + (iDisplayIndex + 1);
                    $('td:eq(0)', row).html(index);
                    $('td:eq(0)', row).prop("align","center");
            },
            scrollY: 300,
            scrollCollapse: true
        });
        
        $(".select2-proyek").select2({
            theme: "bootstrap",
            placeholder: "Pilih Proyek",
            allowClear: true,
            "language":{
                "noResults": function(){
                    return "<center><img src='<?php echo base_url() ?>assets/not-found.svg' width='30' /><br><strong>Tidak ada hasil ditemukan</strong></center>";
                },
                searching: function(){
                    return "<center><img src='<?php echo base_url() ?>assets/searching.gif' width='30px' /></br><strong>Mencari hasil ....</center>";
                },
                loadingMore: function(){
                    return "<center><img src='<?php echo base_url() ?>assets/ajax-loader.svg' width='30px' /></center>";
                }
            },
        escapeMarkup: function (markup){
            return markup;
        },
        ajax: {
            url: "<?php echo base_url() ?>api/getListProyek",
            dataType: 'json',
            delay: 250,
            data: function (params){
                return{
                    q: params.term,
                    page_limit: 10,
                    page: params.page
                };
            },
            processResults: function(data, params){
                params.page = params.page || 1;
                
                return {
                    results: data.results,
                    paginations: {
                        more: (params.page * 10) < data.total_count
                    }
                };
            },
            cache: true
        }
    });
 
    });

</script>