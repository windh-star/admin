<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <?php $this->load->view('layout/breadcrumb') ?>

            <div class="row">
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
                                  ESTIMATORID
                              </li>
                              <li class="list-group-item">
                                  <span class="badge badge-success" id="jum_survei" style="font-size:10pt; font-weight: bold;">0</span>
                                  SURVEI
                              </li>
                          </ul>
                      </div>
                      <div class="panel-footer">
                        <strong><h4 class="panel-title" style="margin-left: 25px;">Jumlah Bahan <span class="badge badge-primary pull-right" id="jum_sumber" style="font-size:11pt; font-weight: bold; margin-right: 21px;"></span></h4></strong>
                      </div>
                  </div>
              </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div id="panel-ubah-upah" class="panel panel-default" style="display: none">
                        <div class="panel-heading"> 
                            <h3 class="panel-title">UBAH <?php echo strtoupper($menu) ?></h3> 
                        </div> 
                        <div class="panel-body"> 
                          <form role="form" id="frm-ubah-upah">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label>Nama Upah</label>
                                        <input type="text" id="ubah_nama_upah" name="nama_upah" class="form-control" readonly>
                                        <input type="hidden" id="kategori_ubah">
                                        <input type="hidden" id="ubah_urut_upah" name="urut_upah">
                                        <input type="hidden" id="ubah_id_wilayah" name="id_wilayah">
                                        <input type="hidden" id="ubah_id_upah" name="id_upah">
                                    </div>
                                    <div class="form-group">
                                        <label>Spesifikasi</label>
                                        <input type="text" id="ubah_spesifikasi" name="spesifikasi" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Merk</label>
                                        <input type="text" id="ubah_merk" name="merk" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Satuan</label>
                                        <input type="text" id="ubah_satuan" name="satuan" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label>Harga Dasar</label>
                                        <input type="text" id="ubah_harga_dasar" name="harga_dasar" class="form-control">
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
                                        <select id="ubah_sumber" name="sumber" class="form-control" onchange="getSuggestTahun(2);getSuggestKeterangan(2)">
                                          <option value="">- Pilih -</option>
                                          <option value="1">SHBJ</option>
                                          <option value="2">Estimator.id</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" id="ubah_keterangan" name="keterangan" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <center>
                              <button type="button" id="btn-ubah-upah" class="btn btn-success waves-effect waves-light" onclick="ubahUpah($('#kategori_ubah').val())"><strong><i class="fa fa-check"></i> PERBAHARUI</strong></button>
                              <button type="button" id="btn-batal-ubah" class="btn btn-warning waves-effect waves-light" onclick="batalUbahUpah()"><strong><i class="fa fa-times"></i> BATAL</strong></button>
                            <center>
                          </form>
                        </div> 
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-12"> 
                    <!--<ul class="nav nav-tabs tabs">-->
                    <!--    <li class="active tab" id="tab-data-lengkapi">-->
                    <!--        <a href="#tab-lengkapi" data-toggle="tab" aria-expanded="false"> -->
                    <!--            <span class="visible-xs"><i class="fa fa-home"></i></span> -->
                    <!--            <span class="hidden-xs"><strong>LENGKAPI</strong></span> -->
                    <!--        </a> -->
                    <!--    </li> -->
                    <!--    <li class="tab" id="tab-data-upah"> -->
                    <!--        <a href="#tab-data" data-toggle="tab" aria-expanded="false"> -->
                    <!--            <span class="visible-xs"><i class="fa fa-user"></i></span> -->
                    <!--            <span class="hidden-xs"><strong>DATA</strong></span> -->
                    <!--        </a> -->
                    <!--    </li> -->
                    <!--</ul> -->
                    <!--<div class="tab-content"> -->
                    <!--    <div class="tab-pane active" id="tab-lengkapi"> -->
                    <!--        <div class="panel panel-default">-->
                    <!--            <div class="panel-heading">-->
                    <!--                <h3 class="panel-title"><?php echo "LENGKAPI DATA ".strtoupper($menu) ?></h3>-->
                    <!--            </div>-->
                    <!--            <div class="panel-body">-->
                    <!--                <div class="row">-->
                    <!--                    <div class="col-md-12 col-sm-12 col-xs-12">-->
                    <!--                        <table id="tabel-lengkapi-upah" class="table table-striped table-bordered">-->
                    <!--                            <thead>-->
                    <!--                                <tr>-->
                    <!--                                    <th style="text-align: center" width="3%">No.</th>-->
                    <!--                                    <th>Urut</th>-->
                    <!--                                    <th style="text-align: center" width="84%">Nama Upah</th>-->
                    <!--                                    <th style="text-align: center" width="13%">Satuan</th>-->
                    <!--                                </tr>-->
                    <!--                            </thead>-->
                    <!--                            <tbody></tbody>-->
                    <!--                        </table>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div> -->
                    <!--    <div class="tab-pane" id="tab-data">-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo "DATA ".strtoupper($menu) ?></h3>
                                </div>
                                <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">FILTER</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select class="select2-wilayah required" style="width: 100%;" id="wilayah_upah">
                                                              <option value=""></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select class="select2-proyek required" style="width: 100%;" id="namaproyek">
                                                              <option value=""></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
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
                                            </div>
                              
                                        </div>
                                      </div>
                                      </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <table id="tabel-upah" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center" width="3%">No.</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th style="text-align: center" width="10%">Wilayah</th>
                                                        <th style="text-align: center" width="40%">Nama Upah</th>
                                                        <th style="text-align: center" width="8%">Satuan</th>
                                                        <th style="text-align: center" width="10%">Spesifikasi</th>
                                                        <th style="text-align: center" width="10%">Merk</th>
                                                        <th style="text-align: center" width="10%">Harga Dasar</th>
                                                        <th style="text-align: center" width="10%">Status</th>
                                                        <th style="text-align: center" width="7%">Verifikasi</th>
                                                        <th style="text-align: center" width="7%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <!--    </div>-->
                    <!--</div> -->
                </div>
            </div>


        </div> <!-- container -->
                   
    </div> <!-- content -->

    <?php $this->load->view('layout/footer') ?>

</div>

<script type="text/javascript">
//   function reloadDataLengkapi(){ tabel_lengkapi.ajax.reload(); }
  function reloadData(){ 
    tabel.ajax.reload(); 
    getRingkasanStatus($('#wilayah_upah').val());
  }
  
  function getSuggestTahun(aksi) {
    var sumber;
    if (aksi == "1") sumber = $('#sumber').val(); else sumber = $('#ubah_sumber').val(); 
    $.ajax({
        url : "<?php echo base_url() ?>api/getSuggestTahunUpah/"+sumber+"/"+$('#wilayah_upah').val(),
        type: "POST",
        dataType: "JSON",
        success: function(data){
          if (data != null) {
            if (aksi == "1") $('#tahun').val(data.tahun); else $('#ubah_tahun').val(data.tahun);
          } else {
            if (aksi == "1") $('#tahun').val(new Date().getFullYear()); else $('#ubah_tahun').val(new Date().getFullYear());
          }
        }
    });
  }
  
  function getSuggestKeterangan(aksi) {
    var sumber;
    if (aksi == "1") sumber = $('#sumber').val(); else sumber = $('#ubah_sumber').val(); 
    $.ajax({
        url : "<?php echo base_url() ?>api/getSuggestKeteranganUpah/"+sumber+"/"+$('#wilayah_upah').val(),
        type: "POST",
        dataType: "JSON",
        success: function(data){
          if (data != null) {
            if (aksi == "1") $('#keterangan').val(data.keterangan); else $('#ubah_keterangan').val(data.keterangan);
          }
        }
    });
  }

  function tampilTambahUpah(){
    if ($('#wilayah_upah').val() != '') {
      $('#panel-tambah-upah').show();
      $('#btn-tambah').hide();
      $('#id_wilayah').val($('#wilayah_upah').val());
      getSuggestTahun(1);
      getSuggestKeterangan(1);
      batalUbahUpah();
    } else {
      tampilNotifikasi('Silakan pilih wilayah dulu!', 'warning');
    }
  }

  function batalTambahUpah(){
    $('#panel-tambah-upah').hide();
    $('#btn-tambah').show();
  }

  function tampilUbahUpah(){
    $('#panel-ubah-upah').show();
    $('html, body').animate({scrollTop: '0px'}, 0);
    $('#ubah_sumber').val('1');
    batalTambahUpah();
  }

  function batalUbahUpah(){
    $('#panel-ubah-upah').hide();
  }

  function getInfoUpah(nama) {
    nama = nama.replace(/ /g,'_');
    $.ajax({
        url : "<?php echo base_url() ?>api/getUpahKriteria/nama_upah/"+nama,
        type: "POST",
        dataType: "JSON",
        success: function(data){
          if (data != null) {
            $('#id_upah').val(data.id_upah);
            $('#satuan').val(data.satuan);
          } else {
            $.ajax({
                url : "<?php echo base_url() ?>api/getMaxIDUpah",
                type: "POST",
                dataType: "JSON",
                success: function(data){
                  $('#id_upah').val(data.id);
                }
            });
            $('#satuan').val('');
          }
        }
    });
  }

//   function konfirmasiLengkapi(urut) {
//     $('#ubah_id_wilayah').val($('#wilayah_upah').val());
//     getSuggestTahun(2);
//     getSuggestKeterangan(2);
//     $.ajax({
//         url : "<?php echo base_url() ?>api/getLengkapiUpahKriteria/urut/"+urut,
//         type: "POST",
//         dataType: "JSON",
//         success: function(data){
//           $('#kategori_ubah').val(1);
//           $('#ubah_urut_upah').val(data.urut);
//           $('#ubah_id_upah').val(data.id_upah);
//           $('#ubah_nama_upah').val(data.nama_upah);
//           $('#ubah_spesifikasi').val(data.spesifikasi);
//           $('#ubah_merk').val(data.merk);
//           $('#ubah_satuan').val(data.satuan);
//         }
//     });
//   }

  function konfirmasiUbah(urut) {
    $.ajax({
        url : "<?php echo base_url() ?>api/getUpahKriteria/urut/"+urut,
        type: "POST",
        dataType: "JSON",
        success: function(data){
        //   $('#kategori_ubah').val(0);
          $('#ubah_urut_upah').val(data.urut);
          $('#ubah_id_wilayah').val(data.id_wilayah);
          $('#ubah_id_upah').val(data.id_upah);
          $('#ubah_nama_upah').val(data.nama_upah);
          $('#ubah_spesifikasi').val(data.spesifikasi);
          $('#ubah_merk').val(data.merk);
          $('#ubah_satuan').val(data.satuan);
          $('#ubah_harga_dasar').val(data.harga_dasar);
          if (data.status == "1" || data.harga_dasar != "") $('#kategori_ubah').val(0); else $('#kategori_ubah').val(1);
          (data.tahun == '' ? $('#ubah_tahun').val(new Date().getFullYear()) : $('#ubah_tahun').val(data.tahun));
          $('#ubah_sumber').val(data.sumber);
          $('#ubah_keterangan').val(data.keterangan);
        }
    });
  }

  var simpan_upah = 0;
  function simpanUpah() {
    simpan_upah++;
    if (simpan_upah == 1) {
      $.ajax({
          url : "<?php echo base_url('api/simpanUpah') ?>",
          type: "POST",
          data: $('#frm-tambah-upah').serialize(),
          dataType: "JSON",
          success: function(data){
            tampilNotifikasi(data.Info, 'success');
            $("#frm-tambah-upah")[0].reset();
            reloadData();
            // reloadDataLengkapi();
            simpan_upah = 0;
            batalTambahUpah();
          }
      });
    }
  }

  var ubah_upah = 0;
  function ubahUpah(kategori) {
    ubah_upah++;
    if (ubah_upah == 1) {
      if (kategori == 0) {
          $.ajax({
              url : "<?php echo base_url('api/ubahUpah') ?>",
              type: "POST",
              data: $('#frm-ubah-upah').serialize(),
              dataType: "JSON",
              success: function(data){
                tampilNotifikasi(data.Info, 'success');
                $("#frm-ubah-upah")[0].reset();
                reloadData();
                // reloadDataLengkapi();
                ubah_upah = 0;
                batalUbahUpah();
              }
          });
      } else {
          $.ajax({
              url : "<?php echo base_url('api/simpanUpah') ?>",
              type: "POST",
              data: $('#frm-ubah-upah').serialize(),
              dataType: "JSON",
              success: function(data){
                tampilNotifikasi(data.Info, 'success');
                $("#frm-ubah-upah")[0].reset();
                reloadData();
                // reloadDataLengkapi();
                ubah_upah = 0;
                batalUbahUpah();
              }
          });
      }
    }
  }

  var verifikasi_upah = 0;
  function verifikasiUpah(urut) {
    verifikasi_upah++;
    if (verifikasi_upah == 1) {
      $.ajax({
          url : "<?php echo base_url('api/verifikasiUpah/') ?>"+urut,
          type: "POST",
          dataType: "JSON",
          success: function(data){
            tampilNotifikasi(data.Info, 'success');
            reloadData();
            verifikasi_upah = 0;
          }
      });
    }
  }

  var verifikasi_upah = 0;
  function verifikasiSemuaUpah() {
    verifikasi_upah++;
    if (verifikasi_upah == 1) {
      $.ajax({
          url : "<?php echo base_url('api/verifikasiSemuaUpah') ?>",
          type: "POST",
          dataType: "JSON",
          success: function(data){
            tampilNotifikasi(data.Info, 'success');
            reloadData();
            verifikasi_upah = 0;
          }
      });
    }
  }

  function getRingkasanStatus(id_wilayah){
    if (id_wilayah == '') id_wilayah = '0'; else id_wilayah = id_wilayah;
    $.ajax({
        url : "<?php echo base_url('api/getRingkasanSumberUpah') ?>",
        type: "POST",
        dataType: "JSON",
        success: function(data){
          $('#jum_shbj').html(data.shbj);
          $('#jum_estimatorid').html(data.estimatorid);
          $('#jum_survei').html(data.survey);
          $('#jum_sumber').html(parseInt(data.shbj) + parseInt(data.estimatorid) + parseInt(data.survey));
        }
    });
  }

  var tabel_lengkapi,tabel;
  $(document).ready(function() {
    //   $('#panel-tambah-upah').hide();
    //   $('#panel-ubah-upah').hide();
      var thn_sekarang = new Date().getFullYear();
      $('[id*=spinner-tahun]').spinner({value: thn_sekarang, min: thn_sekarang-3, max: thn_sekarang+1});
      $('#menu_master').click();
      $('#menu_upah').prop('class','active');
      getRingkasanStatus($('#wilayah_upah').val());

      $(".select2-satuan").select2({
          theme: "bootstrap",
          placeholder: "Pilih Satuan",
          allowClear: true,
          tags: true,
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
            url: "<?php echo $this->config->item('url_server') ?>api/getListSatuan/",
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
      
      $('#harga_dasar, #ubah_harga_dasar').inputmask('decimal',
        { 'alias': 'numeric',
          'groupSeparator': '.',
          'autoGroup': true,
          'digits': 2,
          'radixPoint': ",",
          'digitsOptional': false,
          'allowMinus': false,
          'prefix': 'Rp ',
          'placeholder': '0',
          'rightAlign': true,
          'autoUnmask': true,
          onUnMask: function (maskedValue, unmaskedValue, opts) {
            if (unmaskedValue === "" && opts.nullable === true) {
              return unmaskedValue;
            }
            var processValue = maskedValue.replace(opts.prefix, "");
            processValue = processValue.replace(opts.suffix, "");
            processValue = processValue.replace(new RegExp(Inputmask.escapeRegex(opts.groupSeparator), "g"), "");
            if (opts.radixPoint !== "" && processValue.indexOf(opts.radixPoint) !== -1) 
                 processValue = processValue.replace(Inputmask.escapeRegex.call(this, opts.radixPoint), ".");
            
            return processValue;
          }
        }
      );
      
      function formatData (data) {
          if (!data.id) { return data.text; }
          if (data.kategori != "2") {
            return "<b>"+data.text+"</b>";
          } else {
            return "<span style='padding-left:20px'>"+data.text+"</span>";
          }
      }
    
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
        
    //   tabel_lengkapi = $("#tabel-lengkapi-upah").DataTable({
    //     "language": {
    //       "info": "Menampilkan _START_ sampai _END_ dari jumlah data",
    //       "sInfoEmpty": "",
    //       "sInfoFiltered": "(terfilter dari _MAX_ data)",
    //       "emptyTable": "<center><img src='<?php echo base_url() ?>assets/not-found.svg' width='100' /><br><strong>Tidak ada hasil ditemukan</strong></center>",
    //       "sLengthMenu": "Data per Halaman: _MENU_",
    //         "sLoadingRecords": "<img src='<?php echo base_url() ?>assets/ajax-loader.svg' /><br>Silakan tunggu, data sedang di-load...",
    //         "sProcessing": "<img src='<?php echo base_url() ?>assets/ajax-loader.svg' />",
    //         "sSearch": "Cari Data:",
    //         "sSearchPlaceholder": "Masukkan kata kunci...",
    //         "sZeroRecords": "<center><img src='<?php echo base_url() ?>assets/not-found.svg' width='100' /><br><strong>Tidak ada hasil ditemukan</strong></center>",
    //       "paginate": {
    //         "first": "Pertama",
    //         "last": "Terakhir",
    //         "previous": "Sebelumnya",
    //         "next": "Berikutnya"
    //       }
    //     },
    //     processing: true,
    //     serverSide: true,
    //     ajax: {
    //       "url": "<?php echo base_url('api/getTabelLengkapiUpah') ?>",
    //       "type": "POST",
    //       data: function (data) {
    //         data.wilayah = $('#wilayah_upah').val();
    //       }
    //     },
    //     "columnDefs": [
    //       {
    //         "targets": [ 1 ],
    //         "visible": false,
    //         "searchable": false
    //       }
    //     ],
    //     // order: [2, 'asc'],
    //     "bInfo": false,
    //     "bSort": false,
    //     rowCallback: function (row, data, iDisplayIndex) {
    //       var info = this.fnPagingInfo();
    //       var page = info.iPage;
    //       var length = info.iLength;
    //       var index = page * length + (iDisplayIndex + 1);
    //       $('td:eq(0)', row).html(index);
    //       $('td:eq(0),td:eq(2)', row).prop('align','center');
    //     },
    //     scrollY: 400,
    //     scrollCollapse: true
    //   });

      tabel = $("#tabel-upah").DataTable({
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
          "url": "<?php echo base_url('api/getTabelUpah') ?>",
          "type": "POST",
          data: function (data) {
            data.wilayah = $('#wilayah_upah').val();
            data.namaproyek = $('#namaproyek').val();
            data.sumber = $('#sumber').val();
          }
        },
        "columnDefs": [
          {
            "targets": [ 1,2 ],
            "visible": false,
            "searchable": false
          }
        ],
        order: [3, 'asc'],
        "bInfo": false,
        rowCallback: function (row, data, iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          var index = page * length + (iDisplayIndex + 1);
          var verifikasi;
          if (data[8] == "<span class='label label-danger'>Belum Terverifikasi</span>") verifikasi = "<button class='btn btn-success btn-icon waves-effect waves-light' id='btn-verifikasi' onclick='verifikasiUpah("+data[1]+")'><i class='fa fa-check'></i></button>"; else verifikasi = "";
          $('td:eq(0)', row).html(index);
          $('td:eq(8)', row).html(verifikasi);
          $('td:eq(0),td:eq(3),td:eq(7),td:eq(8)', row).prop('align','center');
          $('td:eq(6)', row).prop('align','right');
        },
        scrollY: 400,
        scrollCollapse: true
      });

    //   $('#tabel-lengkapi-upah tbody').on('dblclick', 'tr', function () {
    //       if ($('#wilayah_upah').val() != '') {
    //         var data = tabel_lengkapi.row(this).data();
    //         konfirmasiLengkapi(data[1]);
    //         tampilUbahUpah();
    //       } else {
    //         $.Notification.autoHideNotify('warning', 'top right', 'Peringatan', 'Silakan pilih wilayah dulu!');
    //       }
    //   });

      $('#tabel-upah tbody').on('dblclick', 'tr', function () {
          var data = tabel.row(this).data();
          konfirmasiUbah(data[1]);
          tampilUbahUpah();
      });

      $('#wilayah_upah,#sumber,#namaproyek').on('change', function() {
          reloadData();
        //   reloadDataLengkapi();
          getRingkasanStatus($(this).val());
      });
      
    //   $('#tab-data-lengkapi').on('click', function() { reloadDataLengkapi(); });
    //   $('#tab-data-upah').on('click', function() { reloadData(); });
  });
</script>