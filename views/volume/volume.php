<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <?php $this->load->view('layout/breadcrumb') ?>

            <div class="row">
                <!-- section untuk filtering -->
                <div class="col-md-12">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <h3 class="panel-title">PILIH KATEGORI</h3>
                      </div>
                      <div class="panel-body">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                        <select id="filter_kategori" name="kategori" class="form-control" onchange="">
                                          <option value="">- Pilih -</option>
                                          <option value="A">Bahan</option>
                                          <option value="B">Upah</option>
                                          <option value="C">Alat</option>
                                        </select>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>

                <!-- <div class="col-md-12"> -->
                    <!-- section tombol aksi -->
                    <!-- <button type="button" id="btn-tambah" class="btn btn-primary waves-effect waves-light" onclick="tampilTambahBahan()"><strong><i class="fa fa-plus-circle"></i> TAMBAH <?php echo strtoupper($menu) ?></strong></button>
                    <br><br> -->
                    <!-- section untuk form tambah -->
                    <!-- <div id="panel-tambah-bahan" class="panel panel-default" style="display: none">
                        <div class="panel-heading"> 
                            <h3 class="panel-title">TAMBAH <?php echo strtoupper($menu) ?></h3> 
                        </div> 
                        <div class="panel-body"> 
                          <form role="form" id="frm-tambah-bahan">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label>Nama Bahan</label>
                                        <select class="select2-bahan required" style="width: 100%;" id="nama_bahan" name="nama_bahan" onchange="getInfoBahan($(this).val())">
                                          <option value=""></option>
                                        </select>
                                        <input type="hidden" id="id_wilayah" name="id_wilayah">
                                        <input type="hidden" id="id_bahan" name="id_bahan">
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
                                        <select id="sumber" name="sumber" class="form-control required" onchange="getSuggestTahun(1);getSuggestKeterangan(1)">
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
                              <button type="button" id="btn-tambah-bahan" class="btn btn-success waves-effect waves-light" onclick="simpanBahan()"><strong><i class="fa fa-check"></i> SIMPAN</strong></button>
                              <button type="button" id="btn-batal-tambah" class="btn btn-warning waves-effect waves-light" onclick="batalTambahBahan()"><strong><i class="fa fa-times"></i> BATAL</strong></button>
                            <center>
                          </form>
                        </div> 
                    </div> -->

                    <!-- section untuk form ubah -->
                <!--     <div id="panel-ubah-bahan" class="panel panel-default" style="display: none">
                        <div class="panel-heading"> 
                            <h3 class="panel-title">UBAH <?php echo strtoupper($menu) ?></h3> 
                        </div> 
                        <div class="panel-body"> 
                          <form role="form" id="frm-ubah-bahan">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label>Nama Bahan</label>
                                        <input type="text" id="ubah_nama_bahan" name="nama_bahan" class="form-control" readonly>
                                        <input type="hidden" id="kategori_ubah">
                                        <input type="hidden" id="ubah_urut_bahan" name="urut_bahan">
                                        <input type="hidden" id="ubah_id_wilayah" name="id_wilayah">
                                        <input type="hidden" id="ubah_id_bahan" name="id_bahan">
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
                              <button type="button" id="btn-ubah-bahan" class="btn btn-success waves-effect waves-light" onclick="ubahBahan($('#kategori_ubah').val())"><strong><i class="fa fa-check"></i> PERBAHARUI</strong></button>
                              <button type="button" id="btn-batal-ubah" class="btn btn-warning waves-effect waves-light" onclick="batalUbahBahan()"><strong><i class="fa fa-times"></i> BATAL</strong></button>
                            <center>
                          </form>
                        </div> 
                    </div>
                </div> -->
                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo "DATA ".strtoupper($menu) ?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                              <div class="col-lg-6">
                                  <div class="panel panel-primary">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Ringkasan Kategori</h3>
                                      </div>
                                      <div class="panel-body">
                                          <ul class="list-group">
                                              <li class="list-group-item">
                                                  <span class="badge badge-warning" id="jum_bahan" style="font-size:10pt; font-weight: bold;">0</span>
                                                  Bahan
                                              </li>
                                              <li class="list-group-item">
                                                  <span class="badge badge-danger" id="jum_upah" style="font-size:10pt; font-weight: bold;">0</span>
                                                  Upah
                                              </li>
                                              <li class="list-group-item">
                                                  <span class="badge badge-success" id="jum_alat" style="font-size:10pt; font-weight: bold;">0</span>
                                                  Alat
                                              </li>
                                          </ul>
                                      </div>
                                      <div class="panel-footer">
                                        <strong><h4 class="panel-title" style="margin-left: 25px;">Jumlah <span class="badge badge-primary pull-right" id="jum_semua" style="font-size:11pt; font-weight: bold; margin-right: 21px;"></span></h4></strong>
                                      </div>
                                  </div>
                              </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table id="tabel-bua-bps" class="table table-striped table-bordered" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th width="2%">No</th>
                                                <th width="10%">ID Volume</th>
                                                <th width="10%">Nama Pekerjaan</th>
                                                <th width="20%">Proyek</th>
                                                <th width="5%">Pelaksanan</th>
                                                <th width="20%">Tot Volume</th>
                                                <th width="10%">Tgl Dibuat</th>
                                                <th width="20%">Jam Dibuat</th>
                                                <th width="20%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div> <!-- container -->
                   
    </div> <!-- content -->

    <?php $this->load->view('layout/footer') ?>

</div>

<script type="text/javascript">
  function reloadData(){ 
    tabel.ajax.reload();
  }

  // function tampilTambahBahan(){
  //   if ($('#wilayah_bahan').val() != '') {
  //     $('#panel-tambah-bahan').show();
  //     $('#btn-tambah').hide();
  //     $('#id_wilayah').val($('#wilayah_bahan').val());
  //     getSuggestTahun(1);
  //     getSuggestKeterangan(1);
  //     batalUbahBahan();
  //   } else {
  //     tampilNotifikasi('Silakan pilih wilayah dulu!', 'warning');
  //   }
  // }

  // function batalTambahBahan(){
  //   $('#panel-tambah-bahan').hide();
  //   $('#btn-tambah').show();
  // }

  // function tampilUbahBahan(){
  //   $('#panel-ubah-bahan').show();
  //   $('html, body').animate({scrollTop: '0px'}, 0);
  //   $('#ubah_sumber').val('1');
  //   batalTambahBahan();
  // }

  // function batalUbahBahan(){
  //   $('#panel-ubah-bahan').hide();
  // }

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

  var ubah_bahan = 0;
  function ubahBahan(kategori) {
    ubah_bahan++;
    if (ubah_bahan == 1) {
      if (kategori == 0) {
          $.ajax({
              url : "<?php echo base_url('api/ubahBahan') ?>",
              type: "POST",
              data: $('#frm-ubah-bahan').serialize(),
              dataType: "JSON",
              success: function(data){
                tampilNotifikasi(data.Info, 'success');
                $("#frm-ubah-bahan")[0].reset();
                reloadData();
                // reloadDataLengkapi();
                ubah_bahan = 0;
                batalUbahBahan();
              }
          });
      } else {
          $.ajax({
              url : "<?php echo base_url('api/simpanBahan') ?>",
              type: "POST",
              data: $('#frm-ubah-bahan').serialize(),
              dataType: "JSON",
              success: function(data){
                tampilNotifikasi(data.Info, 'success');
                $("#frm-ubah-bahan")[0].reset();
                reloadData();
                // reloadDataLengkapi();
                ubah_bahan = 0;
                batalUbahBahan();
              }
          });
      }
    }
  }

  function getRingkasanKategori(id_kategori){
    if (id_kategori == '') id_kategori = '0'; else id_kategori = id_kategori;
    $.ajax({
        url : "<?php echo base_url('api//getRingkasanKategoriBuaBps/') ?>"+id_kategori,
        type: "POST",
        dataType: "JSON",
        success: function(data){
          $('#jum_bahan').html(data.bahan);
          $('#jum_upah').html(data.upah);
          $('#jum_alat').html(data.alat);
          $('#jum_semua').html(parseInt(data.bahan) + parseInt(data.ubah) + parseInt(data.alat));
        }
    });
  }

  var tabel;
  $(document).ready(function() {
      $('#menu_master').click();
      $('#menu_volume').prop('class','active');
      getRingkasanKategori($('#filter_kategori').val());
      

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

      tabel = $("#tabel-volume").DataTable({
        "language": {
          "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
          "sInfoEmpty": "",
          "sInfoFiltered": "(terfilter dari _MAX_ data)",
          "emptyTable": "<img src='<?php echo base_url() ?>assets/not-found.png' width='110' style='padding: 10px 0px;' /><br><span>Tidak ada hasil ditemukan</span>",
          "sLengthMenu": "Data per Halaman: _MENU_",
            "sLoadingRecords": "<img src='<?php echo base_url() ?>assets/ajax-loader.gif' width='45' /><br>Silakan tunggu, data sedang di-load...",
            "sProcessing": "<img src='<?php echo base_url() ?>assets/ajax-loader.gif' width='45' />",
            "sSearch": "Cari Data:",
            "sSearchPlaceholder": "Masukkan kata kunci...",
            "sZeroRecords": "<img src='<?php echo base_url() ?>assets/not-found.png' width='110' style='padding: 10px 0px;' /><br><span>Tidak ada hasil ditemukan</span>",
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
          "url": "<?php echo base_url('api/getTabelBUABPS') ?>",
          "type": "POST",
          data: function (data) {
            data.kategori = $('#filter_kategori').val();
          }
        },
        // "columnDefs": [
        //   {
        //     "targets": [ 1 ],
        //     "visible": false,
        //     "searchable": false
        //   }
        // ],
        order: [3, 'asc'],
        rowCallback: function (row, data, iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          var index = page * length + (iDisplayIndex + 1);
          $('td:eq(0)', row).html(index);
          $('td:eq(0),td:eq(4)', row).prop('align','center');
          $('td:eq(7)', row).prop('align','right');
        },
        scrollY: 400,
        scrollCollapse: true
      });

      // $('#tabel-bua-bps tbody').on('dblclick', 'tr', function () {
      //     var data = tabel.row(this).data();
      //     konfirmasiUbah(data[1]);
      //     tampilUbahBahan();
      // });

      $('#filter_kategori').on('change', function() {
          reloadData();
      });
  });
</script>