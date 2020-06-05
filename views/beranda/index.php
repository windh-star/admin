<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <?php $this->load->view('layout/breadcrumb') ?>

            <div class="row">
    <div class="col-md-12"> 
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>Tahun</label>
                        <div class="form-group">
                            <select id="filter-status-verifikasi" name="status" class="form-control" onchange="">
                                <option value="">- Pilih Tahun -</option>
                                <option value="1">2018</option>
                                <option value="2">2019</option>
                                <option value="3">2020</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Proyek</label>
                        <div class="form-group">
                            <select id="filter-status-verifikasi" name="status" class="form-control" onchange="">
                                <option value="">- Pilih Proyek -</option>
                                <option value="1">2018</option>
                                <option value="2">2019</option>
                                <option value="3">2020</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Wilayah</label>
                        <div class="form-group">
                            <select id="filter-status-verifikasi" name="status" class="form-control" onchange="">
                                <option value="">- Pilih Wilayah -</option>
                                    <select class="select2-wilayah required" style="width: 100%;" id="proyek-wilayah">
                                      <option value=""></option>
                                    </select>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" align="center">
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->            
            <div class="small-box bg-light">
              <div class="inner">
                <h3>Estimator</h3>
                <h3 id="estimator" class="mt-3">-</h3>
              </div>
              <div class="icon">
                <i class="fa fa-sitemap"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-light">
              <div class="inner">
                <h3>Proyek</h3>
                <h3 id="proyek" class="mt-3">-</h3>
              </div>
              <div class="icon">
                <i class="fa fa-sitemap"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-light">
              <div class="inner">
                <h3>Suplier</h3>
                <h3 id="suplier" class="mt-3">-</h3>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
     </div>
</div>
</div>
</div>

<script type="text/javascript">
var id_pengguna = Cookies.get('id_pengguna');

///reload tabel 
function reloadData(){
    table.ajax.reload();
}
///card estimator
function totalEstimator(){
    if(estimator != ''){
    }else{
        $.ajax({
           url: "<?php echo base_url() ?>api/totalEstimator/,
           dataType: "JSON",
           success: function(data){
               $('#estimator').html(data[0].total);
           }
        });
    }
}

///card jml produk terpakai
function cardProdukTerpakai(){
    var produk = $('#select2-select-produk-container').prop('title');
    if(produk != ''){
        $.ajax({
            url: "<?php echo base_url() ?>api/TotalProdukTerpakai/"+id_pengguna+"/"+produk,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                var str = data[0].koefisien;
                var koefisien = Math.round(str);
                if(koefisien == 'null'){
                    $('#jml_koefisien').html("0");
                }else{
                    if(koefisien == 0){
                       $('#koefisien').html("Volume Terpakai");
                       $('#jml_koefisien').html("0");  
                    }else{
                       $('#koefisien').html("Volume Terpakai");
                       $('#jml_koefisien').html(koefisien+" "+data[0].satuan);
                    }
                }
            }
        });
    }else{
        $.ajax({
            url: "<?php echo base_url() ?>api/ProdukTerpakai/"+id_pengguna,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#jml_koefisien').html(data[0].total +" Kali");
            }
        });
    }
}

///card proyek
function cardPenggunaProyek(){
    var produk = $('#select2-select-produk-container').prop('title');
    if(produk != ''){
        $.ajax({
            url: "<?php echo base_url() ?>api/JmlProdukTerpakai/"+id_pengguna+"/"+produk,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                if(data == ''){
                   $('#proyek_pengguna').html("0");  
                }else{
                   $('#proyek_pengguna').html(data[0].jumlah +" Proyek");
                }
            }
        });
    }else{
       $.ajax({
           url: "<?php echo base_url() ?>api/ProyekPenggunaProduk/"+id_pengguna,
           type: "GET",
           dataType: "JSON",
           success: function(data){
               $('#proyek_pengguna').html(data[0].jumlah +" Proyek");
           }
       });
    }
}

///fungsi tren produk per bulan
function getGrafikTrenProdukBulan(){
    var d = new Date();
    var month = new Array();
    month[0] = "January";
    month[1] = "February";
    month[2] = "March";
    month[3] = "April";
    month[4] = "May";
    month[5] = "June";
    month[6] = "July";
    month[7] = "August";
    month[8] = "September";
    month[9] = "October";
    month[10] = "November";
    month[11] = "December";
    var n = month[d.getMonth()];
    var produk = $('#select2-select-produk-container').prop('title');
    var pilih = produk.replace("%20", " ");
    if(produk == ''){
        $('#statistik-produk-perbulan').html("Statistik Produk Bulan "+n+"");
        $.ajax({
            url: "<?php echo base_url() ?>api/TrenProdukPerBulan/"+id_pengguna,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                var label = [];
                var value = [];
                for (var i in data){
                    label.push(data[i].produk);
                    value.push(data[i].total);
                }
                if(value != 0){
                    $('#gbr-bulan').hide();
                    var options = {
                        series: [{
                            name: "Total Produk",
                            data: value,
                        }],
                        chart: {
                            height: 350,
                            type: 'area',
                        },
                        dataLabels:{
                            enabled: false
                        },
                        fill:{
                            type: "gradient",
                            gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.7,
                            opacityTo: 0.9,
                            stops: [0, 90, 100]
                            }
                        },
                        xaxis:{
                            categories: label,
                            type: 'category',
                            tickPlacement: 'on',
                        }
                    };
                    var chart = new ApexCharts(document.querySelector("#tren-perbulan"), options);
                    chart.render();
                    
                }else{
                   $('#statistik-produk-per-bulan').html("Statistik Produk Bulan "+n+"");
                   $('#tren-bulan').hide();
                   $('#gambar').show();
                }
            }
            
        });
        
    }else{
        $('#statistik-produk-perbulan').html("Statistik Produk Bulanan");
        $.ajax({
            url: "<?php echo base_url() ?>api/FilterTrenProdukPerBulan/"+id_pengguna+"/"+produk,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                if(data == 'null'){
                       var options = {
                        series: [{
                            name: "Total Produk",
                            data: value,
                        }],
                        chart: {
                            height: 350,
                            type: 'area',
                        },
                        dataLabels:{
                            enabled: false
                        },
                        fill:{
                            type: "gradient",
                            gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.7,
                            opacityTo: 0.9,
                            stops: [0, 90, 100]
                            }
                        },
                        xaxis:{
                            categories: label,
                            type: 'category',
                            tickPlacement: 'on',
                            labels: {
                                rotate: -45,
                                rotateAlways: true
                            },
                        }
                    };
                    var chart = new ApexCharts(document.querySelector("#tren-perbulan"), options);
                    chart.render();
                    
                }else{
                    $('#statistik-produk-perbulan').html("Statistik Produk Bulanan");
                    var total = 0;
                    console.log(data);
                    for(var i=0; i<data.length; i++){
                        total = total + parseInt(data[i]);
                    }
                    console.log(total);
                    if(total == 0){
                        $('#tren-bulan').hide();
                        $('#gbr-bulan').show();
                    }else{
                     $('.gbr-bulan').style.display = "none";
                     var options = {
                        series: [{
                            name: "Total Produk",
                            data: data,
                        }],
                        chart: {
                            height: 350,
                            type: 'area',
                        },
                        dataLabels:{
                            enabled: false
                        },
                        fill:{
                            type: "gradient",
                            gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.7,
                            opacityTo: 0.9,
                            stops: [0, 90, 100]
                            }
                        },
                        xaxis:{
                            categories: ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agus","Sep","Okt","Nov","Des"],
                            type: 'category',
                            tickPlacement: 'on',
                        },
                    };
                    var chart = new ApexCharts(document.querySelector("#tren-perbulan"), options);
                    chart.render();
                    
                    chart.updateSeries([{
                    name: "Total Produk",
                    data: data,
                   }])
                }
                }
            }
        });
    }
}

function getGrafikTrenProdukTahun(){
    var produk =  $('#select2-select-produk-container').prop('title');
    var d = new Date();
    var y = d.getFullYear();
    if(produk == null || produk == ''){
    $('#statistik-produk-tahun').html("Statistik Produk Tahun "+y+"");
    $.ajax({
        url: "<?php echo base_url() ?>api/TrenProdukAllTahun/"+id_pengguna,
        type: "POST",
        dataType: "JSON",
        success: function(data){
        var produk = [];
        var total = [];
        for (var i in data){
            produk.push(data[i].produk);
            total.push(data[i].total);
            }
        if(total == 0)
        {
          $('#tren-tahun').hide();
          $('#gambar').show();
          
        }else{
            $('#gambar').hide();
            $('#statistik-produk-tahun').html("Statistik Produk Tahun "+y+"");
            var options = {
            series: [{
                name: "Total Produk",
                data: total,
            }],
            chart: {
                height: 350,
                type: 'area',
            },
            dataLabels: {
                enabled: false
            },
            fill:{
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                }
            },
            xaxis:{
                categories: produk,
                type: 'category',
                tickPlacement: 'on',
                labels: {},
            }
        }
        var chart = new ApexCharts(document.querySelector('#tren-tahun'), options);
        chart.render();
                
        chart.updateSeries([{
        name: "Total Produk",
        data: total,
        }])
            }
        }
    });
    
   }else{
       var pilih = produk.replace("%20", " ");
       $('#statistik-produk-tahun').html("Statistik Produk Tahunan");
       $.ajax({
           url: "<?php echo base_url() ?>api/FilterTrenProdukTahun/"+id_pengguna+"/"+produk,
           type: "POST",
           dataType: "JSON",
           success: function(data){
               var tahun = [];
               var value = [];
               var produk = [];
               for (var i in data){
                   tahun.push(data[i].tahun);
                   value.push(data[i].total);
                   produk.push(data[i].produk);
               }
               if(value == 0){
                   $('#statistik-produk-pertahun').html("Statistik Produk Tahunan");
                   $('#tren-tahun').hide();
                   $('#gambar').show();
               }else{
                $('#gambar').hide();
                var options = {
                    chart: {
                    height: 350,
                    type: "area"
                    },
                        dataLabels: {
                        enabled: false
                    },
                    series: [
                    {
                        name: "Total Produk",
                        data: [0, value],
                    }
                    ],
                    fill: {
                        type: "gradient",
                        gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.9,
                        stops: [0, 90, 100]
                    }
                    },
                        xaxis: {
                        categories: tahun
                    },
                    };
                    var chart = new ApexCharts(document.querySelector("#tren-tahun"), options);
                    chart.render();
                    
                    chart.updateSeries([{
                        name: "Total Produk ",
                        data: value
                    }])
               }
           }
       });
   }
}

function getMap(){
    var mymap;
    var produk =  $('#select2-select-produk-container').prop('title');
    // if(mymap != undefined) mymap.remove();
    mymap = new L.map('mapid', {
        center: [-1.889306,117.917266],
        zoom : 5,
    });
	L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
	}).addTo(mymap);
	
// 	var circleCenter = [-7.7161650, 110.3354030];
// 	var circleOptions = {
//       color: '#3CB371',
//       fillColor: '#32CD32',
//       fillOpacity: 0.3
//     }
// 	var circle = L.circle(circleCenter, 10000, circleOptions);
	L.marker([-7.7161650, 110.3354030],[-7.797068, 110.370529]).addTo(mymap)
	.bindPopup("<b>Wilayah: Kab Sleman </b><br>"+
	            "<b>Produk Terpakai: 10 </b><br>"+
	            "<b>Proyek Teralokasi: 20 </b>");
	            
	L.marker([-7.797068, 110.370529]).addTo(mymap)
	.bindPopup("<b>Wilayah: DI Yogyakarta </b><br>"+
	            "<b>Produk Terpakai: 5 </b><br>"+
	            "<b>Proyek Teralokasi: 10 </b>");
	
	L.marker([-6.966667, 110.416664]).addTo(mymap)
	.bindPopup("<b>Wilayah: Semarang </b><br>"+
	            "<b>Produk Terpakai: 20 </b><br>"+
	            "<b>Proyek Teralokasi: 20 </b>");
	  
    L.marker([-7.55611, 110.83167]).addTo(mymap)
	.bindPopup("<b>Wilayah: Surakarta </b><br>"+
	            "<b>Produk Terpakai: 10 </b><br>"+
	            "<b>Proyek Teralokasi: 20 </b>");          
	
	L.marker([-6.138414, 106.863956]).addTo(mymap)
	.bindPopup("<b>Wilayah: Jakarta Utara </b><br>"+
	            "<b>Produk Terpakai: 10 </b><br>"+
	            "<b>Proyek Teralokasi: 20 </b>");  
	            
	L.marker([-6.300641, 106.814095]).addTo(mymap)
	.bindPopup("<b>Wilayah: Jakarta </b><br>"+
	            "<b>Produk Terpakai: 10 </b><br>"+
	            "<b>Proyek Teralokasi: 20 </b>"); 
	            
	L.marker([-6.320138, 106.665596]).addTo(mymap)
	.bindPopup("<b>Wilayah: Tangerang </b><br>"+
	            "<b>Produk Terpakai: 10 </b><br>"+
	            "<b>Proyek Teralokasi: 20 </b>"); 
	            
	L.marker([-7.9797, 112.6304]).addTo(mymap)
	.bindPopup("<b>Wilayah: Malang </b><br>"+
	            "<b>Produk Terpakai: 7 </b><br>"+
	            "<b>Proyek Teralokasi: 17 </b>"); 
	            
	L.marker([-7.250445, 112.768845]).addTo(mymap)
	.bindPopup("<b>Wilayah: Surabaya </b><br>"+
	            "<b>Produk Terpakai: 17 </b><br>"+
	            "<b>Proyek Teralokasi: 20 </b>"); 
	            
// 	var group = new L.featureGroup([-7.250445, 112.768845]);
//     map.fitBounds(group.getBounds());

// 	circle.addTo(mymap);
    // $.ajax({
    //     url: "<?php echo base_url() ?>api/PetaPesebaranWilayah/"+id_pengguna,
    //     type: "POST",
    //     dataType: "JSON",
    //     success: function(data){
    //         $.each(data, function(key, value){
    //          var circleCenter = [value.lat, value.long];
    //          var circleOptions = {
    //              color: '#3CB371',
    //              fillColor: '#32CD32',
    //              fillOpacity: 0.3
    //          }
    //          var circle = L.circle(circleCenter, 10000, circleOptions);
    //          L.marker([value.lat, value.long]).addTo(mymap)
    //             .bindPopup("<b>Wilayah: "+[value.wilayah]+"</b><br>"+
    //                       "<b>Total Terpakai: "+[value.kategori]+"</b><br>"+
    //                       "<b>Teralokasi: "+[value.proyek]+"</br>"+
    //                       "<b>Nama Produk: "+[value.produk]+"<b></br>");
    //          circle.addTo(mymap);
    //         });
    //     }
    //     ///kasih kondisi jika produk nya tidak ada element mapnya di remove terus inisialisasi ulang element nnya dengan 
    //     // $('#mapid').html(' <div id="mapid" style="width: auto; height: 450px;"></div>');
    // });
}

function updateMap(produk){
    var mymap;
    $('#mapid').remove();
    $('#map').show();
    $('<div id=\'mapid\' style=\'width: auto; height: 450px;\'></div>').appendTo("#map");
    var produk =  $('#select2-select-produk-container').prop('title');
    mymap = new L.map('mapid', {
        center: [-1.889306,117.917266],
        zoom : 5,
    });
    if(mymap != undefined)mymap.remove();
    mymap = new L.map('mapid', {
        center: [-1.889306,117.917266],
        zoom : 5,
    });
	L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
	}).addTo(mymap);
	
	var circleCenter = [-7.7956, 110.3695];
	var circleOptions = {
      color: '#3CB371',
      fillColor: '#32CD32',
      fillOpacity: 0.3
    }
	var circle = L.circle(circleCenter, 10000, circleOptions);
    $.ajax({
        url: "<?php echo base_url() ?>api/PetaPesebaranProdukSuplier/"+id_pengguna+"/"+produk,
        type: "POST",
        dataType: "JSON",
        success: function(data){
            $('#peta-pesebaran').html("Peta Pesebaran Produk "+produk+"");
            $.each(data, function(key, value){
            ///circle
             var circleCenter = [value.lat, value.long];
             var circleOptions = {
                 color: '#3CB371',
                 fillColor: '#32CD32',
                 fillOpacity: 0.3
             }
             var circle = L.circle(circleCenter, 10000, circleOptions);
             ///memanggil fungsi marker
             L.marker([value.lat, value.long]).addTo(mymap)
                .bindPopup("<b>Wilayah: "+[value.wilayah]+"</b><br>"+
                          "<b>Total Produk: "+[value.total]+"</b><br>");
             circle.addTo(mymap);
            });
        }
    });
}

///fungsi paket produk
function TrenPaketProduk(){
    $.ajax({
        url: "<?php echo base_url() ?>api/StatistikPaketProduk/"+id_pengguna,
        type: "GET",
        dataType: "JSON",
        success: function(data){
        var value = [];
          for(var i in data){
             value.push(data[i].total);
          }
          var ctxP = document.getElementById("tren-paket").getContext('2d');
          var myPieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
              labels: ["Paket 1", "Paket 2", "Paket 3"],
              datasets: [{
                label: ['Total Paket'],
                data: value,
                backgroundColor: ["#FF6384", "#63FF84", "#87CEFA"],
                hoverBackgroundColor: ["#FF6384", "#63FF84", "#87CEFA"]
              }]
            },
            options: {
              responsive: true,
              tooltips: {
                  callbacks: {
                      label: function(tooltipItem){
                          return "Total Produk : " +value+"";
                      }
                  }
              },
            }
          });
        }  
    });
}

$(document).ready(function(){
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
    var table = $('#masa-aktif-produk').DataTable({
        "language": {
            "info": "Menampilkan _START_ sampai _END_ dari jumlah data",
            "sInfoEmpty": "",
            "sInfoFiltered": "(terfilter dari _MAX_ data)",
            "emptyTable": "<center><img src='<?php echo base_url () ?>assets/not-found.png' width='100'/><br><strong>Belum ada produk</strong></center>",
            "sLengthMenu": "Data per Halaman: _MENU_",
            "sLoadingRecords": "<img src='<?php echo base_url ?>assets/ajax-loader.svg' /><br>Silahkan tunggu...",
            "sProcessing": "<img src='<?php echo base_url() ?>assets/ajax-loader.svg' />",
            "sSearch": "Cari Data:",
            "sSearchPlaceholder": "Masukkan kata kunci...",
            "sZeroRecords": "<center><img src='<?php echo base_url() ?>assets/not-found.png' width='100' /><br><strong>Tidak ada hasil ditemukan</strong></center>",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "previous": "Sebelumnya",
                "next": "Berikutnya"
            }
        },
        processing: true,
        serverSide: true,
        searching: false,
        paging: false,
        ordering: false,
        fixedHeader: {
            headerOffset: 10
        },
        ajax: {
            url: "<?php echo base_url() ?>api/getMasaAktif/"+id_pengguna,
            type: "POST",
        },
        order: [1,'asc'],
        "bInfo": false,
        rowCallback: function(row, data, iDisplayIndex){
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
            $('td:eq(0),td:eq(3),td:eq(7),td:eq(8)', row).prop('align','center');
            $('td:eq(6)', row).prop('align','right');
        },
        scrollY: 500,
        scrollCollapse: true,
        pageLength: 5,
        recordsTotal: 10,
    });

    
    ///produk terbaru
    var table = $('#produk-terbaru').DataTable({
        "language" : {
            "info": "Menampilkan _START_ sampai _END_ data",
            "sInfoEmpty": "",
            "sInfoFiltered": "(terfilter dari _MAX_ data)",
            "emptyTable": "<center><img src='<?php echo base_url () ?>assets/not-found.png' width='100'/><br><strong>Belum ada produk</strong></center>",
            "sLengthMenu": "Data per Halaman: _MENU_",
            "sLoadingRecords": "<img src='<?php echo base_url ?>assets/ajax-loader.svg' /><br>Silahkan tunggu...",
            "sProcessing": "<img src='<?php echo base_url() ?>assets/ajax-loader.svg' />",
            "sSearch": "Cari Data:",
            "sSearchPlaceholder": "Masukkan kata kunci...",
            "sZeroRecords": "<center><img src='<?php echo base_url() ?>assets/not-found.png' width='100' /><br><strong>Tidak ada hasil ditemukan</strong></center>",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "previous": "Sebelumnya",
                "next": "Berikutnya"
            }
        },
        processing: true,
        serverSide: true,
        searching: false,
        paging: false,
        ordering: false,
        ajax: {
            url: "<?php echo base_url() ?>api/ProdukTerbaru/"+id_pengguna,
            type: "POST",
        },
        order: [1, 'desc'],
        "bInfo": false,
        rowCallback: function(row, data, iDisplayIndex){
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
            $('td:eq(0),td:eq(3),td:eq(7),td:eq(8)', row).prop('align','center');
            $('td:eq(6)', row).prop('align','right');
        },
        scrollY: 400,
        scrollCollapse: true,
        pageLength: 5,
        recordsTotal: 10,
    });

    table = $('#produk-update').DataTable({
      "language": {
        "info": "Menampilkan _START_ sampai _END_ dari jumlah data",
        "sInfoEmpty": "",
        "sInfoFiltered": "(terfilter dari _MAX_ data)",
        "emptyTable": "<center><img src='<?php echo base_url () ?>assets/not-found.png' width='100'/><br><strong>Belum ada produk</strong></center>",
        "sLengthMenu": "Data per Halaman: _MENU_",
        "sLoadingRecords": "<img src='<?php echo base_url ?>assets/ajax-loader.svg' /><br>Silahkan tunggu...",
        "sProcessing": "<img src='<?php echo base_url() ?>assets/ajax-loader.svg' />",
        "sSearch": "Cari Data:",
        "sSearchPlaceholder": "Masukkan kata kunci...",
        "sZeroRecords": "<center><img src='<?php echo base_url() ?>assets/not-found.png' width='100' /><br><strong>Tidak ada hasil ditemukan</strong></center>",
        "paginate": {
            "first": "Pertama",
            "last": "Terakhir",
            "previous": "Sebelumnya",
            "next": "Berikutnya"
        }
    },
    processing: true,
    serverSide: true,
    searching: false,
    paging: false,
    ordering: false,
    ajax: {
        url: "<?php echo base_url() ?>api/ProdukPerluUpdate/"+id_pengguna,
        type: "POST",
    },
    order: [1, 'asc'],
    "bInfo": false,
    rowCallback: function(row, data, iDisplayIndex){
        var info = this.fnPagingInfo();
        var page = info.iPage;
        var length = info.iLength;
        var index = page * length + (iDisplayIndex + 1);
        $('td:eq(0)', row).html(index);
        $('td:eq(0),td:eq(3),td:eq(7),td:eq(8)', row).prop('align','center');
        $('td:eq(6)', row).prop('align','right');
    },
    scrollY: 400,
    scrollCollapse: true,
    pageLength: 5,
    recordsTotal: 10,
    fixedColumns: {
        heigthMatch: 'none'
    }
    });

    //select wilayah
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


    ///memanggil fungsi chart bulan
    getGrafikTrenProdukBulan();
    ///memanggil fungsi chart tahun
    getGrafikTrenProdukTahun();
    ///memanggil fungsi map
    getMap();
    ///memanggil card
    cardProduk();
    cardProdukTerpakai();
    cardPenggunaProyek();
    TrenPaketProduk();
    $('#map').hide();
    $('.id').hide();
    var change = $('#select-produk').on('change', function(){
        getGrafikTrenProdukBulan();
        getGrafikTrenProdukTahun();
        cardProduk();
        cardProdukTerpakai();
        cardPenggunaProyek();
        updateMap($('#select2-select-produk-container').prop('title'));
    });
    
});
</script>

