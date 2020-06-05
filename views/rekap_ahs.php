<style>
  td.details-control {
      background: url('http://www.datatables.net/examples/resources/details_open.png') no-repeat center center;
      cursor: pointer;
  }
  tr.shown td.details-control {
      background: url('http://www.datatables.net/examples/resources/details_close.png') no-repeat center center;
  }

  .table-rincian-ahs {
      border-collapse: separate;
      padding-left: 67px;
      padding-right: 67px;
  }
</style>

<div class="panel panel-default">
    <div class="panel-heading">
      <span style="font-size:40pt">&nbsp</span>
      <div class="btn-group pull-right">
        <div class="btn-group btn-group-info">
          <!--<a href="<?php echo $this->config->item('url_server') ?>api/eksporRAB/<?php echo $id_proyek ?>"><button type="button" class="btn btn-default btn-md"><strong><i class="fa fa-upload"></i> EKSPOR DATA</strong></button></a>-->
        </div>
        <button type="button" class="btn btn-default" id="reload-pekerjaan-ahs"><strong><i class="fa fa-refresh"></i> RELOAD</strong></button>
      </div>
    </div>
    <div class="panel-body">
      <table id="tabel-pekerjaan-ahs" class="table table-striped table-advance">
          <thead>
              <tr>
                  <th width="2%">No.</th>
                  <th>ID Kategori</th>
                  <th width="68%">Uraian Pekerjaan</th>
                  <th width="2%">Satuan</th>
                  <th width="15%">Harga Satuan</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody></tbody>
      </table>
    </div>
</div>

<script>
    function number_format(number, decimals, dec_point, thousands_point) {
        if (number == null || !isFinite(number)) {
            throw new TypeError("number is not valid");
        }
    
        if (!decimals) {
            var len = number.toString().split('.').length;
            decimals = len > 1 ? len : 0;
        }
    
        if (!dec_point) {
            dec_point = '.';
        }
    
        if (!thousands_point) {
            thousands_point = ',';
        }
    
        number = parseFloat(number).toFixed(decimals);
    
        number = number.replace(".", dec_point);
    
        var splitNum = number.split(dec_point);
        splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
        number = splitNum.join(dec_point);
    
        return number;
    }

    function formatAHS(data) {
      var urut,nama_kategori,koefisien,harga_dasar,harga_satuan,urut_rincian_kategori,align;
      var rincian_ahs = '';
          rincian_ahs =
            $.each(data, function (i, val) {
              if (val.id_kategori == "H") {
                urut_rincian_kategori = 0;
                urut = "<strong>"+val.LEVEL+"</strong>";
                nama_kategori = "<strong>"+val.nama_kategori+"</strong>";
                koefisien = "";
                harga_dasar = "";
                harga_satuan = "";
                align = 'left';
              } else if (val.id_kategori == "F") {
                urut = "";
                nama_kategori = "<strong>"+val.nama_kategori+"</strong>";
                koefisien = "";
                harga_dasar = "";
                harga_satuan = "<strong>Rp "+number_format(val.harga_satuan, 2, ',', '.')+"</strong>";
                align = 'right';
              } else {
                urut_rincian_kategori++;
                urut = urut_rincian_kategori;
                nama_kategori = val.nama_kategori;
                koefisien = number_format(val.koefisien, 4, ',', '.');
                harga_dasar = "Rp "+number_format(val.harga_dasar, 2, ',', '.');
                harga_satuan = "Rp "+number_format(val.harga_satuan, 2, ',', '.');
                align = 'left';
              }
              
              rincian_ahs +=
                  '<tr>'+
                    '<td align="center">'+urut+'</td>'+
                    '<td align="'+align+'">'+nama_kategori+'</td>'+
                    '<td align="right">'+koefisien+'</td>'+
                    '<td align="center">'+val.satuan_kategori+'</td>'+
                    '<td align="right">'+harga_dasar+'</td>'+
                    '<td align="right">'+harga_satuan+'</td>'+
                  '</tr>';
            });
            rincian_ahs += '</tbody></table>';

      return rincian_ahs;
    }
    
    function reloadPekerjaanAHS(){ tabel_pekerjaan_ahs.ajax.reload(); urut_pekerjaan_ahs = 0; }

    var tabel_pekerjaan_ahs, tabel_ahs, urut_rincian_ahs, urut_pekerjaan_ahs = 0;
    $(document).ready(function() {  
        var id_proyek = <?php echo $id_proyek ?>;  
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
        
        tabel_pekerjaan_ahs = $("#tabel-pekerjaan-ahs").DataTable({
          "language": {
            "info": "Menampilkan _START_ sampai _END_ dari jumlah data",
            "sInfoEmpty": "",
            "sInfoFiltered": "(terfilter dari _MAX_ data)",
            "emptyTable": "<img src='<?php echo base_url() ?>assets/not-found.svg' width='85' style='padding: 10px 0px;' /><br><span>Tidak ada hasil ditemukan</span>",
            "sLengthMenu": "Data per Halaman: _MENU_",
              "sLoadingRecords": "<img src='<?php echo base_url() ?>assets/ajax-loader.svg' /><br>Silakan tunggu, data sedang di-load...",
              "sProcessing": "<img src='<?php echo base_url() ?>assets/ajax-loader.svg' />",
              "sSearch": "Cari Data:",
              "sSearchPlaceholder": "Masukkan kata kunci...",
              "sZeroRecords": "<img src='<?php echo base_url() ?>assets/not-found.svg' width='85' style='padding: 10px 0px;' /><br><span>Tidak ada hasil ditemukan</span>",
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
            "url": "<?php echo base_url('dev/api/getTabelLapRAB') ?>",
            "type": "POST",
            data: function (data) {
              data.proyek = id_proyek;
            }
          },
          "columnDefs": [
            {
              "targets": [ 1 ],
              "visible": false,
              "searchable": false
            }
          ],
          "bDeferRender": true,
          "bInfo" : false,
          "bSort" : false,
          rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var arr_urut = data[0].split('.');
            var urut, nama_pekerjaan;
            if (arr_urut.length == 1) {
              urut_pekerjaan_ahs++; urut_rincian_ahs = 0;
              urut = "<strong>&#"+(64+urut_pekerjaan_ahs)+"</strong>";
              nama_pekerjaan = "<strong>"+data[12]+"</strong>";
            } else if (arr_urut.length == 2) {
              urut_rincian_ahs++;
              urut = urut_rincian_ahs;
              nama_pekerjaan = data[12];
            } else {
              urut = "-";
              nama_pekerjaan = data[12];
            }
            
            $('td:eq(0)', row).html(urut);
            $('td:eq(1)', row).html(nama_pekerjaan);
            $('td:eq(2)', row).html(data[4]);
            $('td:eq(3)', row).html(data[5]);
            $('td:eq(4)', row).html("");
            $('td:eq(0),td:eq(2)', row).prop("align","center");
            $('td:eq(3)', row).prop("align","right");
            $('td:eq(4)', row).prop("class","details-control");
            $('td:eq(4)', row).prop("id",data[1]);
            
            if (data[4] == "") {
              $('td:eq(3)', row).html("");
              $('td:eq(4)', row).prop("class","");
              $('td:eq(4)', row).prop("id","");
            }
          },
          scrollY: 700,
          scrollCollapse: true
        });
        
        $('#tabel-pekerjaan-ahs tbody').on('click', 'td.details-control', function () {
          var id_pekerjaan = $(this).attr('id');
          var tr = $(this).closest('tr');
          var row = tabel_pekerjaan_ahs.row(tr);
          
          if (row.child.isShown()) { 
            row.child.hide();
            tr.removeClass('shown');
          } else {
            $.ajax({
                type : 'get',
                url : "<?php echo base_url() ?>dev/api/getRincianAHS/"+id_proyek+"/"+id_pekerjaan,
                dataType: "JSON",
                success : function(data){
                  if (data != '') {
                    row.child(formatAHS(data)).show();
                  } else {
                    row.child("<center><img src='<?php echo base_url() ?>assets/img/not-found.png' width='110' style='padding: 10px 0px;' /><br><span>Tidak ada hasil ditemukan</span></center>").show();
                  }
                }
            });
            
            tr.addClass('shown');
          }
        });
        
        $('#reload-pekerjaan-ahs').on('click', function() {
            reloadPekerjaanAHS();
        });
    })
</script>