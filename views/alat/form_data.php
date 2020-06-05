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
              
                <div class="col-md-12">
                    <!-- <button type="button" id="btn-tambah" class="btn btn-primary waves-effect waves-light" onclick="tampilTambahAlat()"><strong><i class="fa fa-plus-circle"></i> TAMBAH <?php echo strtoupper($menu) ?></strong></button>
                    <br><br> -->
                    <div id="panel-tambah-alat" class="panel panel-default" style="display: none">
                        <div class="panel-heading"> 
                            <h3 class="panel-title">TAMBAH <?php echo strtoupper($menu) ?></h3> 
                        </div> 
                        <div class="panel-body"> 
                          <form role="form" id="frm-tambah-alat">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label>Nama Alat</label>
                                        <select class="select2-alat" style="width: 100%;" id="nama_alat" name="nama_alat" onchange="getInfoAlat($(this).val())" required>
                                          <option value=""></option>
                                        </select>
                                        <input type="hidden" id="id_wilayah" name="id_wilayah">
                                        <input type="hidden" id="id_alat" name="id_alat">
                                    </div>
                                    <div class="form-group">
                                        <label>Spesifikasi</label>
                                        <input type="text" id="spesifikasi" name="spesifikasi" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Merk</label>
                                        <input type="text" id="merk" name="merk" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Satuan</label>
                                        <select class="select2-satuan required" style="width: 100%" id="satuan" name="satuan">
                                          <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label>Harga Dasar</label>
                                        <input type="text" id="harga_dasar" name="harga_dasar" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <div id="spinner-tahun">
                                          <div class="input-group input-small">
                                              <input type="text" id="tahun" name="tahun" class="spinner-input form-control" maxlength="4" readonly="">
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
                                        <select id="tanbah_sumber" name="sumber" class="form-control" onchange="getSuggestTahun(1);getSuggestKeterangan(1)">
                                          <option value="">- Pilih -</option>
                                          <option value="1">SHBJ</option>
                                          <option value="2" selected>Estimator.id</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" id="keterangan" name="keterangan" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <center>
                              <button type="button" id="btn-tambah-alat" class="btn btn-success waves-effect waves-light" onclick="simpanAlat()"><strong><i class="fa fa-check"></i> SIMPAN</strong></button>
                              <button type="button" id="btn-batal-tambah" class="btn btn-warning waves-effect waves-light" onclick="batalTambahAlat()"><strong><i class="fa fa-times"></i> BATAL</strong></button>
                            <center>
                          </form>
                        </div> 
                    </div>

                    <div id="panel-ubah-alat" class="panel panel-default" style="display: none">
                        <div class="panel-heading"> 
                            <h3 class="panel-title">UBAH <?php echo strtoupper($menu) ?></h3> 
                        </div> 
                        <div class="panel-body"> 
                          <form role="form" id="frm-ubah-alat">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label>Nama Alat</label>
                                        <input type="text" id="ubah_nama_alat" name="nama_alat" class="form-control" readonly>
                                        <input type="hidden" id="kategori_ubah">
                                        <input type="hidden" id="ubah_urut_alat" name="urut_alat">
                                        <input type="hidden" id="ubah_id_wilayah" name="id_wilayah">
                                        <input type="hidden" id="ubah_id_alat" name="id_alat">
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
                              <button type="button" id="btn-ubah-alat" class="btn btn-success waves-effect waves-light" onclick="ubahAlat($('#kategori_ubah').val())"><strong><i class="fa fa-check"></i> PERBAHARUI</strong></button>
                              <button type="button" id="btn-batal-ubah" class="btn btn-warning waves-effect waves-light" onclick="batalUbahAlat()"><strong><i class="fa fa-times"></i> BATAL</strong></button>
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
                    <!--    <li class="tab" id="tab-data-alat"> -->
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
                    <!--                        <table id="tabel-lengkapi-alat" class="table table-striped table-bordered">-->
                    <!--                            <thead>-->
                    <!--                                <tr>-->
                    <!--                                    <th style="text-align: center" width="3%">No.</th>-->
                    <!--                                    <th>Urut</th>-->
                    <!--                                    <th style="text-align: center" width="84%">Nama Alat</th>-->
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
                                                            <select class="select2-wilayah required" style="width: 100%;" id="wilayah_alat">
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
                                            <table id="tabel-alat" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center" width="3%">No.</th>
                                                        <th>id_alat</th>
                                                        <th>id_proyek</th>                                                        
                                                        <th style="text-align: center" width="10%">Wilayah</th>
                                                        <th style="text-align: center" width="40%">Nama Alat</th>
                                                        <th style="text-align: center" width="8%">Satuan</th>
                                                        <th style="text-align: center" width="10%">Spesifikasi</th>
                                                        <th style="text-align: center" width="10%">Merk</th>
                                                        <th style="text-align: center" width="10%">Harga Dasar</th>
                                                        <th style="text-align: center" width="10%">Sumber</th>
                                                        <th>sumber</th>    
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
    getRingkasanStatus($('#wilayah_alat').val());
  }
  
  function getSuggestTahun(aksi) {
    var sumber;
    if (aksi == "1") sumber = $('#sumber').val(); else sumber = $('#ubah_sumber').val(); 
    $.ajax({
        url : "<?php echo base_url() ?>api/getSuggestTahunAlat/"+sumber+"/"+$('#wilayah_alat').val(),
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
        url : "<?php echo base_url() ?>api/getSuggestKeteranganAlat/"+sumber+"/"+$('#wilayah_alat').val(),
        type: "POST",
        dataType: "JSON",
        success: function(data){
          if (data != null) {
            if (aksi == "1") $('#keterangan').val(data.keterangan); else $('#ubah_keterangan').val(data.keterangan);
          }
        }
    });
  }

  function tampilTambahAlat(){
    if ($('#wilayah_alat').val() != '') {
      $('#panel-tambah-alat').show();
      $('#btn-tambah').hide();
      $('#id_wilayah').val($('#wilayah_alat').val());
      getSuggestTahun(1);
      getSuggestKeterangan(1);
      batalUbahAlat();
    } else {
      tampilNotifikasi('Silakan pilih wilayah dulu!', 'warning');
    }
  }

  function batalTambahAlat(){
    $('#panel-tambah-alat').hide();
    $('#btn-tambah').show();
  }

  function tampilUbahAlat(){
    $('#panel-ubah-alat').show();
    $('html, body').animate({scrollTop: '0px'}, 0);
    $('#ubah_sumber').val('1');
    batalTambahAlat();
  }

  function batalUbahAlat(){
    $('#panel-ubah-alat').hide();
  }

  function getInfoAlat(nama) {
    nama = nama.replace(/ /g,'_');
    $.ajax({
        url : "<?php echo base_url() ?>api/getAlatKriteria/nama_alat/"+nama,
        type: "POST",
        dataType: "JSON",
        success: function(data){
          if (data != null) {
            $('#id_alat').val(data.id_alat);
            $('#satuan').val(data.satuan);
          } else {
            $.ajax({
                url : "<?php echo base_url() ?>api/getMaxIDAlat",
                type: "POST",
                dataType: "JSON",
                success: function(data){
                  $('#id_alat').val(data.id);
                }
            });
            $('#satuan').val('');
          }
        }
    });
  }

//   function konfirmasiLengkapi(urut) {
//     $('#ubah_id_wilayah').val($('#wilayah_alat').val());
//     getSuggestTahun(2);
//     getSuggestKeterangan(2);
//     $.ajax({
//         url : "<?php echo base_url() ?>api/getLengkapiAlatKriteria/urut/"+urut,
//         type: "POST",
//         dataType: "JSON",
//         success: function(data){
//           $('#kategori_ubah').val(1);
//           $('#ubah_urut_alat').val(data.urut);
//           $('#ubah_id_alat').val(data.id_alat);
//           $('#ubah_nama_alat').val(data.nama_alat);
//           $('#ubah_spesifikasi').val(data.spesifikasi);
//           $('#ubah_merk').val(data.merk);
//           $('#ubah_satuan').val(data.satuan);
//         }
//     });
//   }

  function konfirmasiUbah(urut) {
    $.ajax({
        url : "<?php echo base_url() ?>api/getAlatKriteria/urut/"+urut,
        type: "POST",
        dataType: "JSON",
        success: function(data){
        //   $('#kategori_ubah').val(0);
          $('#ubah_urut_alat').val(data.urut);
          $('#ubah_id_wilayah').val(data.id_wilayah);
          $('#ubah_id_alat').val(data.id_alat);
          $('#ubah_nama_alat').val(data.nama_alat);
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

  var simpan_alat = 0;
  function simpanAlat() {
    simpan_alat++;
    if (simpan_alat == 1) {
      $.ajax({
          url : "<?php echo base_url('api/simpanAlat') ?>",
          type: "POST",
          data: $('#frm-tambah-alat').serialize(),
          dataType: "JSON",
          success: function(data){
            tampilNotifikasi(data.Info, 'success');
            $("#frm-tambah-alat")[0].reset();
            reloadData();
            // reloadDataLengkapi();
            simpan_alat = 0;
            batalTambahAlat();
          }
      });
    }
  }

  var ubah_alat = 0;
  function ubahAlat(kategori) {
    ubah_alat++;
    if (ubah_alat == 1) {
      if (kategori == 0) {
          $.ajax({
              url : "<?php echo base_url('api/ubahAlat') ?>",
              type: "POST",
              data: $('#frm-ubah-alat').serialize(),
              dataType: "JSON",
              success: function(data){
                tampilNotifikasi(data.Info, 'success');
                $("#frm-ubah-alat")[0].reset();
                reloadData();
                // reloadDataLengkapi();
                ubah_alat = 0;
                batalUbahAlat();
              }
          });
      } else {
          $.ajax({
              url : "<?php echo base_url('api/simpanAlat') ?>",
              type: "POST",
              data: $('#frm-ubah-alat').serialize(),
              dataType: "JSON",
              success: function(data){
                tampilNotifikasi(data.Info, 'success');
                $("#frm-ubah-alat")[0].reset();
                reloadData();
                // reloadDataLengkapi();
                ubah_alat = 0;
                batalUbahAlat();
              }
          });
      }
    }
  }

  var verifikasi_alat = 0;
  function verifikasiAlat(urut) {
    verifikasi_alat++;
    if (verifikasi_alat == 1) {
      $.ajax({
          url : "<?php echo base_url('api/verifikasiAlat/') ?>"+urut,
          type: "POST",
          dataType: "JSON",
          success: function(data){
            tampilNotifikasi(data.Info, 'success');
            reloadData();
            verifikasi_alat = 0;
          }
      });
    }
  }

  var verifikasi_alat = 0;
  function verifikasiSemuaAlat() {
    verifikasi_alat++;
    if (verifikasi_alat == 1) {
      $.ajax({
          url : "<?php echo base_url('api/verifikasiSemuaAlat') ?>",
          type: "POST",
          dataType: "JSON",
          success: function(data){
            tampilNotifikasi(data.Info, 'success');
            reloadData();
            verifikasi_alat = 0;
          }
      });
    }
  }

  function getRingkasanStatus(id_wilayah){
    if (id_wilayah == '') id_wilayah = '0'; else id_wilayah = id_wilayah;
    $.ajax({
        url : "<?php echo base_url('api/getRingkasanSumberAlat') ?>",
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
    //   $('#panel-tambah-alat').hide();
    //   $('#panel-ubah-alat').hide();
      var thn_sekarang = new Date().getFullYear();
      $('[id*=spinner-tahun]').spinner({value: thn_sekarang, min: thn_sekarang-3, max: thn_sekarang+1});
      $('#menu_master').click();
      $('#menu_alat').prop('class','active');
      getRingkasanStatus($('#wilayah_alat').val());

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
        
    //   tabel_lengkapi = $("#tabel-lengkapi-alat").DataTable({
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
    //       "url": "<?php echo base_url('api/getTabelLengkapiAlat') ?>",
    //       "type": "POST",
    //       data: function (data) {
    //         data.wilayah = $('#wilayah_alat').val();
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

      tabel = $("#tabel-alat").DataTable({
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
          "url": "<?php echo base_url('api/getTabelAlat') ?>",
          "type": "POST",
          data: function (data) {
            data.wilayah = $('#wilayah_alat').val();
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
        order: [4, 'asc'],
        "bInfo": false,
        rowCallback: function (row, data, iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          var index = page * length + (iDisplayIndex + 1);
          var verifikasi;
          if (data[8] == "<span class='label label-danger'>Belum Terverifikasi</span>") verifikasi = "<button class='btn btn-success btn-icon waves-effect waves-light' id='btn-verifikasi' onclick='verifikasiAlat("+data[1]+")'><i class='fa fa-check'></i></button>"; else verifikasi = "";
          $('td:eq(0)', row).html(index);
          $('td:eq(8)', row).html(verifikasi);
          $('td:eq(0),td:eq(3),td:eq(7),td:eq(8)', row).prop('align','center');
          $('td:eq(6)', row).prop('align','right');
        },
        scrollY: 400,
        scrollCollapse: true
      });

    //   $('#tabel-lengkapi-alat tbody').on('dblclick', 'tr', function () {
    //       if ($('#wilayah_alat').val() != '') {
    //         var data = tabel_lengkapi.row(this).data();
    //         konfirmasiLengkapi(data[1]);
    //         tampilUbahAlat();
    //       } else {
    //         $.Notification.autoHideNotify('warning', 'top right', 'Peringatan', 'Silakan pilih wilayah dulu!');
    //       }
    //   });

      $('#tabel-alat tbody').on('dblclick', 'tr', function () {
          var data = tabel.row(this).data();
          konfirmasiUbah(data[1]);
          tampilUbahAlat();
      });

      $('#wilayah_alat,#sumber,#namaproyek').on('change', function() {
          reloadData();
        //   reloadDataLengkapi();
          getRingkasanStatus($(this).val());
      });
      
    //   $('#tab-data-lengkapi').on('click', function() { reloadDataLengkapi(); });
    //   $('#tab-data-alat').on('click', function() { reloadData(); });
  });
</script>