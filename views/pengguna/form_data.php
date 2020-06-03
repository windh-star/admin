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
                                  <label>Wilayah</label>
                                  <div class="form-group">
                                      <select class="select2-wilayah required" style="width: 100%;" id="proyek-wilayah">
                                        <option value=""></option>
                                      </select>
                                  </div>
                              </div>
                              
                               <div class="col-md-4">
                                  <label>Status Verifikasi</label>
                                   <div class="form-group">
                                        <select id="filter-status-verifikasi" name="status" class="form-control" onchange="">
                                          <option value="">- Pilih -</option>
                                          <option value="1">Sudah Terverifikasi</option>
                                          <option value="0">Belum Terverifikasi</option>
                                        </select>
                                    </div>
                                  </div>
                          </div>
                      </div>
                    </div>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Ringkasan Status Verifikasi</h3>
                            </div>
                        <div class="panel-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <span class="badge badge-success" id="jum_sudah_verifikasi" style="font-size:10pt; font-weight: bold;">0</span>
                                    Sudah Terverifikasi
                                </li>
                                <li class="list-group-item">
                                    <span class="badge badge-danger" id="jum_belum_verifikasi" style="font-size:10pt; font-weight: bold;">0</span>
                                    Belum Terverifikasi
                                </li>
                            </ul>
                            </div>
                            <div class="panel-footer">
                                <strong><h4 class="panel-title" style="margin-left: 25px;">Jumlah Status <span class="badge badge-primary pull-right" id="jum_ahs" style="font-size:11pt; font-weight: bold; margin-right: 21px;"></span></h4></strong>
                            </div>
                        </div>
                    </div>
                 </div>
                 
                <!-- Form Ubah Proyek -->  
                <div id="panel-ubah-pengguna" class="panel panel-default" style="display: none">
                        <div class="panel-heading"> 
                            <h3 class="panel-title">UBAH <?php echo strtoupper($menu) ?></h3> 
                        </div> 
                        <div class="panel-body"> 
                          <form role="form" id="frm-ubah-pengguna">
                              <div class="panel-body">
                                  <div class="clear">
                                      <div class="col-sm-4 col-sm-offset-1">
                                          <br>
                                          <center>
                                              <span class="btn btn-primary fileinput-button">
                                                  <i class="fa fa-user"></i><span> FOTO PROFIL</span>
                                              </span>
                                              <br><br>
                                              <img id="default-foto" src="<?php echo ($data['ubah_foto'] != '' || $data['ubah_foto'] != 'null' ? base_url('assets/pengguna/no_foto.jpg') : base_url('assets/pengguna/no_foto.jpg')) ?>" class="img-thumbnail" style="backgroud-color: transparent;border: 0px;"/>
                                              <input type="hidden" id="ubah_foto" name="foto">
                                          </center>
                                      </div>
                                         <div class="col-sm-6 padding-top-25">
                                          <div class="form-group" id="col_nama_pengguna">
                                              <input type="hidden" id="id_pengguna" name="id_pengguna">
                                              <label>Nama Pengguna <small>(Wajib diisi)</small></label>
                                              <input type="text" class="form-control required" id="ubah_nama_pengguna" name="nama_pengguna" autofocus>
                                              <input type="hidden" id="pengguna-ubah">
                                              <input type="hidden" id="ubah_id_pengguna" name="id_pengguna">
                                          </div>
                                          <div class="form-group">
                                              <label>Ringkasan Profil</label>
                                              <textarea class="form-control" id="ubah_profil" name="profil" rows="4"></textarea>
                                          </div>
                                          <div class="form-group" id="col_alamat">
                                              <label>Alamat <small>(Wajib diisi)</small></label>
                                              <textarea class="form-control required" id="ubah_alamat" name="alamat"></textarea>
                                          </div>
                                          <div class="form-group" id="col_wilayah">
                                              <label>Wilayah <small>(Wajib diisi)</small></label>
                                              <input type="hidden" id="ubah_id_wilayah" name="id_wilayah">
                                              <select class="select2-wilayah required pilihan" style="width: 100%;" id="ubah_nama_wilayah" name="ubah_nama_wilayah">
                                                  <option value=""></option>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="clear" style="margin-top: 15px;">
                                      <div class="col-sm-5 col-sm-offset-1">
                                          <div class="form-group">
                                              <label>Perusahaan</label>
                                              <input type="text" class="form-control" id="ubah_perusahaan" name="perusahaan">
                                          </div>
                                          <div class="form-group" id="col_email">
                                              <label>Email <small>(Wajib diisi)</small></label>
                                              <input type="email" class="form-control required" id="ubah_email" name="email">
                                          </div>
                                          <div class="form-group" id="col_no_telp">
                                              <label>No Telepon<small>(Wajib diisi)</small></label>
                                              <input type="text" class="form-control required" id="ubah_no_telp" name="no_telp">
                                              <input type="hidden" class="form-control" id="ubah_kategori_akun" name="kategori_akun">
                                              <input type="hidden" class="form-control" id="ubah_jenis_akun" name="jenis_akun">
                                              <input type="hidden" class="form-control" id="ubah_status" name="status">
                                              <input type="hidden" class="form-control" id="ubah_aksi_profil" value="ubah">
                                              <input type="hidden" class="form-control" name="ubah_ego" value="1">
                                              <input type="hidden" id="ubah_harga_max" name="harga_max">
                                              <input type="hidden" id="ubah_harga_min" name="harga_min">
                                              <input type="hidden" id="ubah_nego" name="nego">
                                              <input type="hidden" id="ubah_kode_verifikasi" name="kode_verifikasi">
                                              <input type="hidden" id="ubah_status_verifikasi" name="status_verifikasi">
                                              <input type="hidden" id="ubah_tgl_daftar" name="tgl_daftar">
                                              <input type="hidden" id="ubah_jam_daftar" name="jam_daftar">
                                          </div>
                                          <div class="form-group">
                                              <label>No. Whatsapp</label>
                                              <input type="text" class="form-control" id="ubah_no_wa" name="no_wa">
                                          </div>
                                      </div>
                                      <div class="col-sm-5">
                                          <div class="form-group">
                                              <label>Website</label>
                                              <input type="text" class="form-control" id="ubah_website" name="website">
                                          </div>
                                          <div class="form-group" id="col_username">
                                              <label>Username <small>(Wajib diisi)</small></label>
                                              <input type="text" class="form-control required" id="ubah_username" name="username">
                                          </div>
                                          <div class="form-group" id="col_password">
                                              <label>Password <small>(Wajib diisi)</small></label>
                                              <input type="password" class="form-control required" id="ubah_password" name="password" ]>
                                          </div>
                                          <div class="form-group" id="col_password">
                                              <label>Ulangi Password <small>(Wajib diisi)</small></label>
                                              <input type="password" class="form-control required" id="ulangi_password" name="ulangi_password">
                                          </div>
                                        </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                        <center>
                          <button type="button" id="btn-ubah-proyek" class="btn btn-success waves-effect waves-light" onclick="ubahPengguna($('#pengguna-ubah').val())"><strong><i class="fa fa-check"></i> PERBAHARUI</strong></button>
                          <button type="button" id="btn-batal-ubah" class="btn btn-warning waves-effect waves-light" onclick="batalUbahPengguna()"><strong><i class="fa fa-times"></i> BATAL</strong></button>
                        <center>
                            <br>
                      </form>
                    </div> 
                    <!--End form ubah pengguna-->
                    
                    <!--Form detail pengalaman-->
                <div id="panel-pengalaman" class="panel panel-default" style="display: none">
                    <div class="panel-heading"> 
                        <h3 class="panel-title">UBAH <?php echo strtoupper($menu) ?></h3> 
                    </div>
                    <div class="tab-pane" id="tab-pengalaman"
                        <div class="row">
                        <div class="list-group col-sm-11" style="margin-left: 5%; margin-top: 1%;">
                            <table class="table" width="100%">
                                <thead>
                                    <tr>
                                        <th width="3%">No.</th>
                                        <th width="56%">Nama Proyek</th>
                                        <th width="9%">Tahun</th>
                                        <th width="18%">Posisi</th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="list-pengalaman"></div>
                        </div>
                    </div>
                </div>

            </div>
                             
                <div class="row" id="pengguna-tabel">
                    <div class="col-md-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title">TABEL PENGGUNA</h3>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <br>
                                    <table id="tabel-pengguna" height="50px" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center" width="2%" height="10%">No.</th>
                                                <th style="text-align: center" width="3%" height="10%">ID Pengguna.</th>
                                                <th style="text-align: center" width="10%" height="10%">Nama Pengguna</th>
                                                <th style="text-align: center" width="40%" height="10%">Alamat Pengguna</th>
                                                <th style="text-align: center" width="20%" height="10%">Wilayah</th>
                                                <th style="text-align: center" width="10%" height="10%">Email</th>
                                                <th style="text-align: center" width="10%" height="10%">No Telepon</th>
                                                <th style="text-align: center" width="20%" height="10%">Status</th>
                                                <th style="text-align: center" width="20%" height="10%">Aksi</th>
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
<script>
    
    function reloadData(){
        tabel.ajax.reload();
    }
    
    function TampilUbahPengguna(id_pengguna){
        $.ajax({
            url: "<?php echo base_url() ?>api/getInfoPengguna/"+id_pengguna,
            type: "POST",
            dataType: "json",
            success: function(data){
                ///yang hidden
                $('#ubah_id_pengguna').val(data.id_pengguna);
                $('#ubah_profil').val(data.profil);
                $('#ubah_harga_min').val(data.harga_min);
                $('#ubah_harga_max').val(data.harga_max);
                $('#ubah_nego').val(data.ubah_nego);
                $('#ubah_username').val(data.username);
                $('#ubah_password').val(data.password);
                $('#ubah_kategori_akun').val(data.kategori_akun);
                $('#ubah_jenis_akun').val(data.jenis_akun);
                $('#ubah_status').val(data.status);
                $('#ubah_kode_verifikasi').val(data.kode_verifikas);
                $('#ubah_status_verifikasi').val(data.status_verifikasi);
                $('#ubah_tgl_daftar').val(data.tgl_daftar);
                $('#ubah_jam_daftar').val(data.jam_daftar);
                $('#ubah_no_wa').val(data.no_wa);
                ///yang display
                $('#ubah_nama_pengguna').val(data.nama_pengguna);
                $('#ubah_alamat').val(data.alamat);
                $('#ubah_perusahaan').val(data.perusahaan);
                $('#ubah_email').val(data.email);
                $('#ubah_nama_wilayah').select2("trigger", "select", {data:{id: data.id_wilayah, text: data.wilayah}});
                $('#ubah_id_wilayah').val(data.id_wilayah);
                $('#ubah_website').val(data.website);
                $('#ubah_foto').val(data.foto);
                $('#ubah_no_telp').val(data.no_telp);
                
            }
        });
        $('#panel-ubah-pengguna').show();
        $('#pengguna-tabel').hide();
        $('html, body').animate({scrollTop: '0px'}, 0);
    }
    var urut = 0;
    function TampilDetailPengguna(id_pengguna){
        $.ajax({
            url: "<?php echo base_url() ?>api/getPengalamanPengguna/"+id_pengguna,
            type: "POST",
            dataType: "json",
            success: function(data){
            
            }
        });
    }
    
    function batalUbahPengguna(){
        $('#panel-ubah-pengguna').hide();
        $('#pengguna-tabel').show();
    }
    
    var ubah_pengguna = 0;
    function ubahPengguna(pengguna){
        ubah_pengguna++;
        if(ubah_pengguna == 1){
            if(pengguna == 0){
                $.ajax({
                    url: "<?php echo base_url('api/ubahPengguna') ?>",
                    type: "POST",
                    data: $('#frm-ubah-pengguna').serialize(),
                    dataType: "JSON",
                    success: function(data){
                        tampilNotifikasi(data.Info, 'success');
                        $('#frm-ubah-pengguna')[0].reset();
                        reloadData();
                        ubah_pengguna = 0;
                    }
                });
            }else{
                $.ajax({
                    url: "<?php echo base_url('api/simpanPengguna') ?>",
                    type: "POST",
                    data: $('#frm-ubah-pengguna').serialize(),
                    dataType: "JSON",
                    success: function(data){
                        tampilNotifikasi(data.Info, 'success');
                        $('#frm-ubah-pengguna');
                        reloadData();
                        ubah_pengguna = 0;
                    }
                });
            }
        }
        $('#panel-ubah-pengguna').hide();
        $('#pengguna-tabel').show();
        
    }

  $(document).ready(function(){
   // $('#panel-ubah-pengguna').hide();
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
        tabel = $('#tabel-pengguna').DataTable({ 
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
        "columnDefs": [
          {
            "targets": [ 7 ],
            "visible": false,
            "searchable": false
          }
        ],
            "processing": true, 
            "serverSide": true, 
             
            "ajax": {
                "url": "<?php echo base_url('api/getTabelPengguna')?>",
                "type": "POST"
            },
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
        
    function formatData (data) {
          if (!data.id) { return data.text; }
          if (data.kategori != "2") {
            return "<b>"+data.text+"</b>";
          } else {
            return "<span style='padding-left:20px'>"+data.text+"</span>";
          }
      }

    ///select wilayah
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
        escapeMarkup: function(markup){
            return markup;
        },
        ajax: {
            url: "<?php echo base_url() ?>api/getListWilayah",
            dataType: 'json',
            delay: 250,
            data: function (params){
                return {
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
        },
        templateResult: formatData
    });
    //end select wilayah
 
    });

</script>