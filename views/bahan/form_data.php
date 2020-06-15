<style>
td.details-control {
    background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
}
</style>

<div class="content-page"> <!-- content page -->
 
    <div class="content"> <!-- content -->
        <div class="container"> <!-- container -->

            <?php $this->load->view('layout/breadcrumb') ?>

            <!-- row1 -->
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
            </div>
            <!-- close row1 -->
              

                    <div id="panel-ubah-bahan" class="panel panel-default" style="display: none"> <!-- panel1 -->
                        <div class="panel-heading"> 
                            <h3 class="panel-title">UBAH <?php echo strtoupper($menu) ?></h3> 
                        </div> 
                        <div class="panel-body"> 
                          <form role="form" id="frm-ubah-bahan">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                        <label>ID Bahan</label>
                                        <input type="text" id="ubah_id_bahan" name="id_bahan" class="form-control" readonly>
                                        <input type="hidden" id="bahan_ubah">
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Bahan</label>
                                        <input type="text" id="ubah_nama_bahan" name="nama_bahan" class="form-control" >
                                      
                                        <input type="hidden" id="ubah_urut_bahan" name="urut_bahan">
                                                                          
                                    </div>
                                    <div class="form-group">
                                        <label>Wilayah</label>
                                         <select class="select2-wilayah" style="width: 100%;" id="ubah_nama_wilayah" name="id_wilayah">
                                        <option value=""></option>
                                        </select>
                                        <input type="hidden" class="form-control" id="ubah-id_wilayah" name="ubah_nama_wilayah">
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
                                        <input type="text" id="ubah_satuan" name="satuan" class="form-control">
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
                                          <option value="0">Survei</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" id="ubah_keterangan" name="keterangan" class="form-control">
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
               

            <div class="row">
                <div class="col-md-12">                  
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo "DATA ".strtoupper($menu) ?></h3>
                                </div>
                                 
                                <div class="panel-body">
                                  <div class="row">
                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <select class="select2-wilayah required" style="width: 100%;" id="wilayah_bahan">
                                                <option value=""></option>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <select class="select2-proyek required" style="width: 100%;" id="namaproyek">
                                                <option value=""></option>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group">
                                                <select id="sumber" name="sumber" class="form-control" onchange="">
                                                  <option value="">Semua</option>
                                                  <option value="1">SHBJ</option>
                                                  <option value="2">EstimatorID</option>
                                                  <option value="0">Survey</option>
                                                </select>
                                          </div>
                                      </div>
                                  </div>
                      

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <!-- <button type="button" id="btn-verifikasi-semua" class="btn btn-success waves-effect waves-light" onclick="verifikasiSemuaBahan()"><strong><i class="fa fa-check-square-o"></i> VERIFIKASI SEMUA</strong></button> -->
                                            <br><br>
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
                                                  <th style="text-align: center" width="13%">urut</th>
                                                  <th style="text-align: center" width="5%">Aksi</th>
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
</div> <!-- content page -->


<script type="text/javascript">

function TampilUbahBahan(urut){
        $.ajax({
            url: "<?php echo base_url() ?>api/getInfoBahan/"+urut,
            type: "POST",
            dataType: "json",
            success: function(data){
                $('#ubah_id_bahan').val(data.id_bahan);
                $('#ubah_nama_bahan').val(data.nama_bahan);
                $('#ubah_nama_wilayah').select2("trigger", "select", {data: {id: data.id_wilayah, text: data.wilayah} });
                $('#ubah-id_wilayah').val(data.id_wilayah);
                $('#ubah_spesifikasi').val(data.spesifikasi);
                $('#ubah_merk').val(data.merk);
                $('#ubah_satuan').val(data.satuan);
                $('#ubah_harga_dasar').val(data.harga_dasar);
                $('#ubah_sumber').val(data.sumber);
                $('#ubah_keterangan').val(data.keterangan);
            }
        });

    $('#panel-ubah-bahan').show();
   $('html, body').animate({scrollTop: '0px'}, 0);
  }


  function reloadData(){ 
    tabel.ajax.reload(); 
  //  getRingkasanStatus($('#wilayah_bahan').val());
  }
  
  function tampilTambahBahan(){
    if ($('#wilayah_bahan').val() != '') {
      $('#panel-tambah-bahan').show();
      $('#btn-tambah').hide();
      $('#id_wilayah').val($('#wilayah_bahan').val());
      getSuggestTahun(1);
      getSuggestKeterangan(1);
      batalUbahBahan();
    } else {
      tampilNotifikasi('Silakan pilih wilayah dulu!', 'warning');
    }
  }

  function batalTambahBahan(){
    $('#panel-tambah-bahan').hide();
    $('#btn-tambah').show();
  }

   ///ubah bahan
  //  var ubah_bahan = 0;
  //   function ubahBahan(proyek){
  //       ubah_bahan++;
  //       if(ubah_bahan == 1){
  //           if(bahan == 0){
  //               $.ajax({
  //                   url: "<?php echo base_url('api/ubahBahan') ?>",
  //                   type: "POST",
  //                   data: $('#frm-ubah-bahan').serialize(),
  //                   dataType: "JSON",
  //                   success: function(data){
  //                       tampilNotifikasi(data.Info, 'success');
  //                       $('#frm-ubah-bahan')[0].reset();
  //                       reloadData();
  //                       ubah_bahan = 0;
  //                   }
  //               });
  //           }else{
  //               $.ajax({
  //                   url: "<?php echo base_url('api/simpanBahan') ?>",
  //                   type: "POST",
  //                   data: $('#frm-ubah-bahan').serialize(),
  //                   dataType: "JSON",
  //                   success: function(data){
  //                       tampilNotifikasi(data.Info,'success');
  //                       $('#frm-ubah-bahan')[0].reset();
  //                       reloadData();
  //                       ubah_bahan = 0;
  //                   }
  //               });
  //           }
  //       }
  //   }
    ///end ubah bahan
  
    ///end tampil ubah proyek
     //Tampil form ubah bahan
    

  function batalUbahBahan(){
    $('#panel-ubah-bahan').hide();
  }

//   function konfirmasiLengkapi(urut) {
//     $('#ubah_id_wilayah').val($('#wilayah_bahan').val());
//     getSuggestTahun(2);
//     getSuggestKeterangan(2);
//     $.ajax({
//         url : "<?php echo base_url() ?>api/getLengkapiBahanKriteria/urut/"+urut,
//         type: "POST",
//         dataType: "JSON",
//         success: function(data){
//           $('#kategori_ubah').val(1);
//           $('#ubah_urut_bahan').val(data.urut);
//           $('#ubah_id_bahan').val(data.id_bahan);
//           $('#ubah_nama_bahan').val(data.nama_bahan);
//           $('#ubah_spesifikasi').val(data.spesifikasi);
//           $('#ubah_merk').val(data.merk);
//           $('#ubah_satuan').val(data.satuan);
//         }
//     });
//   }

  function konfirmasiUbah(urut) {
    $.ajax({
        url : "<?php echo base_url() ?>api/getBahanKriteria/urut/"+urut,
        type: "POST",
        dataType: "JSON",
        success: function(data){
        //   $('#kategori_ubah').val(0);
          $('#ubah_urut_bahan').val(data.urut);
          $('#ubah_id_wilayah').val(data.id_wilayah);
          $('#ubah_id_bahan').val(data.id_bahan);
          $('#ubah_nama_bahan').val(data.nama_bahan);
          $('#ubah_spesifikasi').val(data.spesifikasi);
          $('#ubah_merk').val(data.merk);
          $('#ubah_satuan').val(data.satuan);
          $('#ubah_harga_dasar').val(data.harga_dasar);
          if (data.status == "1") $('#kategori_ubah').val(0); else $('#kategori_ubah').val(1);
          (data.tahun == '' ? $('#ubah_tahun').val(new Date().getFullYear()) : $('#ubah_tahun').val(data.tahun));
          $('#ubah_sumber').val(data.sumber);
          $('#ubah_keterangan').val(data.keterangan);
        }
    });
  }

  var simpan_bahan = 0;
  function simpanBahan() {
    simpan_bahan++;
    if (simpan_bahan == 1) {
      $.ajax({
          url : "<?php echo base_url('api/simpanBahan') ?>",
          type: "POST",
          data: $('#frm-tambah-bahan').serialize(),
          dataType: "JSON",
          success: function(data){
            tampilNotifikasi(data.Info, 'success');
            $("#frm-tambah-bahan")[0].reset();
            reloadData();
            // reloadDataLengkapi();
            simpan_bahan = 0;
            batalTambahBahan();
          }
      });
    }
  }

  ///ubah proyek
  var ubah_proyek = 0;
    function ubahBahan(proyek){
        ubah_proyek++;
        if(ubah_proyek == 1){
            if(proyek == 0){
                $.ajax({
                    url: "<?php echo base_url('api/ubahBahan') ?>",
                    type: "POST",
                    data: $('#frm-ubah-bahan').serialize(),
                    dataType: "JSON",
                    success: function(data){
                        tampilNotifikasi(data.Info, 'success');
                        $('#frm-ubah-bahan')[0].reset();
                        reloadData();
                        ubah_proyek = 0;
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
                        ubah_proyek = 0;
                    }
                });
            }
        }
    }
    ///end ubah proyek
    

  // var ubah_bahan = 0;
  // function ubahBahan(bahan) {
  //   ubah_bahan++;
  //   if (ubah_bahan == 1) {
  //     if (bahan == 0) {
  //         $.ajax({
  //             url : "<?php echo base_url('api/ubahBahan') ?>",
  //             type: "POST",
  //             data: $('#frm-ubah-bahan').serialize(),
  //             dataType: "JSON",
  //             success: function(data){
  //               tampilNotifikasi(data.Info, 'success');
  //               $("#frm-ubah-bahan")[0].reset();
  //               reloadData();
  //               // reloadDataLengkapi();
  //               ubah_bahan = 0;
  //               // batalUbahBahan();
  //             }
  //         });
  //     } else {
  //         $.ajax({
  //             url : "<?php echo base_url('api/simpanBahan') ?>",
  //             type: "POST",
  //             data: $('#frm-ubah-bahan').serialize(),
  //             dataType: "JSON",
  //             success: function(data){
  //               tampilNotifikasi(data.Info, 'success');
  //               $("#frm-ubah-bahan")[0].reset();
  //               reloadData();
  //               // reloadDataLengkapi();
  //               ubah_bahan = 0;
  //               // batalUbahBahan();
  //             }
  //         });
  //     }
  //   }
  // }

  // var verifikasi_bahan = 0;
  // function verifikasiBahan(urut) {
  //   verifikasi_bahan++;
  //   if (verifikasi_bahan == 1) {
  //     $.ajax({
  //         url : "<?php echo base_url('api/verifikasiBahan/') ?>"+urut,
  //         type: "POST",
  //         dataType: "JSON",
  //         success: function(data){
  //           tampilNotifikasi(data.Info, 'success');
  //           reloadData();
  //           verifikasi_bahan = 0;
  //         }
  //     });
  //   }
  // }

  // var verifikasi_bahan = 0;
  // function verifikasiSemuaBahan() {
  //   verifikasi_bahan++;
  //   if (verifikasi_bahan == 1) {
  //     $.ajax({
  //         url : "<?php echo base_url('api/verifikasiSemuaBahan') ?>",
  //         type: "POST",
  //         dataType: "JSON",
  //         success: function(data){
  //           tampilNotifikasi(data.Info, 'success');
  //           reloadData();
  //           verifikasi_bahan = 0;
  //         }
  //     });
  //   }
  // }

  function getRingkasanStatus(id_wilayah){
    if (id_wilayah == '') id_wilayah = '0'; else id_wilayah = id_wilayah;
    $.ajax({
        url : "<?php echo base_url('api/getRingkasanSumberBahan') ?>",
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
  // function getTotal(id_wilayah){
  //   if (id_wilayah == '') id_wilayah = '0'; else id_wilayah = id_wilayah;
  //   $.ajax({
  //       url : "<?php echo base_url('api/getRincianJumlahBahanTerpakai/') ?>"+id_proyekbahan+"/"+id_proyekproyek+"/"+bahan,
  //       type: "POST",
  //       dataType: "JSON",
  //       success: function(data){
  //         $('#total').html(data.jumlah);
  //       }
  //   });
  // }

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

  var tabel_lengkapi,tabel,tabel_bahan_terpakai;
  $(document).ready(function() {
    //   $('#panel-tambah-bahan').hide();
    //   $('#panel-ubah-bahan').hide();
      var thn_sekarang = new Date().getFullYear();
      $('[id*=spinner-tahun]').spinner({value: thn_sekarang, min: thn_sekarang-3, max: thn_sekarang+1});
      $('#menu_master').click();
      $('#menu_bahan').prop('class','active');
      getRingkasanStatus($('#wilayah_bahan').val());
    //  getTotal($('#total').val());
   
      
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
        
    //   tabel_lengkapi = $("#tabel-lengkapi-bahan").DataTable({
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
    //       "url": "<?php echo base_url('api/getTabelLengkapiBahan') ?>",
    //       "type": "POST",
    //       data: function (data) {
    //         data.wilayah = $('#wilayah_bahan').val();
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

      tabel = $("#tabel-bahan").DataTable({
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
          "url": "<?php echo base_url('api/getTabelBahan') ?>",
          "type": "POST",
          data: function (data) {
            data.wilayah = $('#wilayah_bahan').val();
            data.namaproyek = $('#namaproyek').val();
            data.sumber = $('#sumber').val();
          }
        },
      
        "columnDefs": [
          {
            "targets": [3,4,12],
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
          var verifikasi;
       //   if (data[8] == "<span class='label label-danger'>Belum Terverifikasi</span>") verifikasi = "<button class='btn btn-success btn-icon waves-effect waves-light' id='btn-verifikasi' onclick='verifikasiBahan("+data[1]+")'><i class='fa fa-check'></i></button>"; else verifikasi = "";
          $('td:eq(0)', row).addClass("details-control");
          $('td:eq(1)', row).html(index);
        //  $('td:eq(8)', row).html(verifikasi);
          $('td:eq(0),td:eq(3),td:eq(7),td:eq(8)', row).prop('align','center');
          $('td:eq(6)', row).prop('align','right');
        },
        scrollY: 400,
        scrollCollapse: true
      });

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


      // $('#tabel-lengkapi-bahan tbody').on('dblclick', 'tr', function () {
      //     if ($('#bahan-wilayah').val() != '') {
      //       var data = tabel.row(this).data();
      //       konfirmasiLengkapi(data[1]);
      //       tampilUbahBahan();
      //     } else {
      //       $.Notification.autoHideNotify('warning', 'top right', 'Peringatan', 'Silakan pilih wilayah dulu!');
      //     }
      // });

      // $('#tabel-bahan tbody').on('dblclick', 'tr', function () {
      //     var data = tabel.row(this).data();
      //  konfirmasiUbah(data[2]);
      //     tampilUbahBahan();
      // });

     
      $('#wilayah_bahan,#sumber,#namaproyek').on('change', function() {
          reloadData();
        //   reloadDataLengkapi();
          getRingkasanStatus($(this).val());
      });
      
      // $('#wilayah_bahan').on('change', function() {
      //     reloadData();
      //   //   reloadDataLengkapi();
      //     getRingkasanStatus($(this).val());
      // });
      
    //   $('#tab-data-lengkapi').on('click', function() { reloadDataLengkapi(); });
    //   $('#tab-data-bahan').on('click', function() { reloadData(); });
  });
</script>