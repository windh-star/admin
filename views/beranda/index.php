<style>
.overview-item--c1 {
    background-image: -moz-linear-gradient(90deg, #11998e 0%, #38ef7d 100%);
    background-image: -webkit-linear-gradient(90deg, #11998e 0%, #38ef7d 100%);
    background-image: -ms-linear-gradient(90deg, #11998e 0%, #38ef7d 100%);
}
@media (max-width: 1519px) and (min-width: 992px)
.overview-item {
    padding-left: 15px;
    padding-right: 15px;
}
.overview-item {
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    padding: 20px;
    padding-bottom: 0px;
    -webkit-box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.1);
    -moz-box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.1);
    box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.1);
    margin-bottom: 40px;
}
.overview-item--c2 {
    background-image: -moz-linear-gradient(90deg, #11998e 0%, #38ef7d 100%);
    background-image: -webkit-linear-gradient(90deg, #11998e 0%, #38ef7d 100%);
    background-image: -ms-linear-gradient(90deg, #11998e 0%, #38ef7d 100%);
}
@media (max-width: 1519px) and (min-width: 992px)
.overview-item {
    padding-left: 15px;
    padding-right: 15px;
}
.overview-item {
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    padding: 20px;
    padding-bottom: 0;
    -webkit-box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.1);
    -moz-box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.1);
    box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.1);
    margin-bottom: 40px;
}
.overview-item--c3 {
    background-image: -moz-linear-gradient(90deg, #11998e 0%, #38ef7d 100%);
    background-image: -webkit-linear-gradient(90deg, #11998e 0%, #38ef7d 100%);
    background-image: -ms-linear-gradient(90deg, #11998e 0%, #38ef7d 100%);
}
@media (max-width: 1519px) and (min-width: 992px)
.overview-item {
    padding-left: 15px;
    padding-right: 15px;
}
.overview-item {
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    padding: 3s
    0px;
    padding-bottom: 0;
    -webkit-box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.1);
    -moz-box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.1);
    box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.1);
    margin-bottom: 40px;
}
.chartjs-render-monitor {
    -webkit-animation: chartjs-render-animation 0.001s;
    animation: chartjs-render-animation 0.001s;
}
.overview-box .text h2 {
    font-weight: 300;
    color: #fff;
    font-size: 36px;
    line-height: 1;
    margin-bottom: 5px;
}
h2 {
    font-size: 30px;
}
h1, h2, h3, h4, h5, h6 {
    color: #333333;
    font-weight: 700;
    margin: 0;
    line-height: 1.2;
}
.h2, h2 {
    font-size: 2rem;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    margin-bottom: .5rem;
    font-family: inherit;
    font-weight: 500;
    line-height: 1.2;
    color: inherit;
}
h1, h2, h3, h4, h5, h6 {
    margin-top: 0;
    margin-bottom: .5rem;
}
.overview-box .icon i {
    font-size: 60px;
    color: #fff;
}
.zmdi {
    display: inline-block;
    font: normal normal normal 14px/1 'Material-Design-Iconic-Font';
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
</style>

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
                                <select class="select2-proyek required" style="width: 100%;" id="proyek-wilayah">
                                    <option value=""></option>
                                </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Wilayah</label>
                        <div class="form-group">
                                <select class="select2-wilayah required" style="width: 100%;" id="wilayah">
                                    <option value=""></option>
                                </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

					<div class="row" style="margin-top: -30px;">
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="text">
                                            <h3 id="estimator" class="mt-3">-</h3>
                                                <span>Estimator</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="text">
                                            <h3 id="proyek" class="mt-3">-</h3>
                                                <span>Proyek</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="text">
                                            <h3 id="suplier" class="mt-3">-</h3>
                                                <span>Suplier</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

    <div class="row">
    <div class="col-xl-6">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-4" id="statistik-produk-perbulan">Statistik Produk Per Bulan</h4>
                 <div id="tren-perbulan"></div>
                 <div id="gbr-bulan"><center>
                     <img src='<?php echo base_url() ?>assets/not-found.png' class="gbr-bulan" width='200' />
                 <br><strong id="detail-no-data-bulan">Belum Ada Produk</strong></center></div>
            </div>
        </div>
    </div>
    <!-- end col -->
    <div class="col-xl-6">
    <div class="card m-b-30">
        <div class="card-body">
            <h4 class="mt-0 header-title mb-4" id="statistik-produk-tahun">Statistik Produk Per Tahun</h4>
            <div id="tren-tahun"></div>
                /* <div id="gambar"><center>
                    <img src='<?php echo base_url() ?>assets/not-found.png' width='200' />
                <br><strong id="detail-no-data-tahun">Belum Ada Produk</strong></center>
                </div> */
        </div>
    </div>
    </div>
</div>

<html>
<head>
	<script type="text/javascript" src="assets/chartjs/chartjs/Chart.js"></script>
</head>
<body>
	<style type="text/css">
		body{
			font-family: roboto;
		}
	</style>
 
	<h4> Grafik Perkembangan Jumlah Proyek </h4>
	<div style="width: 500px;height: 500px">
		<canvas id="myChart"></canvas>
	</div>
 
 	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
				datasets: [{
					// label: '# of Votes',
					data: [12, 19, 3, 23, 2, 3],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)',
                    'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
					],
					borderWidth: 2
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>

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
    $.ajax({
        url: "<?php echo base_url() ?>api/totalEstimator",
        dataType: "JSON",
        success: function(data){
            $('#estimator').html(data.total);
        }
    });
}

//card proyek
function totalProyek(){
    $.ajax({
        url: "<?php echo base_url() ?>api/totalProyek",
        dataType: "JSON",
        success: function(data){
            console.log(data.total);
            $('#proyek').html(data.total);
        }
    });
}

//card suplier
function totalSuplier(){
    $.ajax({
        url: "<?php echo base_url() ?>api/totalSuplier",
        dataType: "JSON",
        success: function(data){
            $('#suplier').html(data.total);
        }
    });
}

function TrenProyekAllTahun(){
    var d = new Date();
    var y = d.getFullYear();
    if(proyek == null || proyek == ''){
      $('#statistik-proyek-tahun').html("Statistik Produk Tahun "+y+"");
    $.ajax({
        url: "<?php echo base_url('api/trenProyekAllTahun') ?>",
        type: "POST",
        dataType: "JSON",
        success: function(data){
        var proyek = [];
        var total = [];
        for (var i in data){
            tahun.push(data[i].tahun);
            proyek.push(data[i].proyek);
            total.push(data[i].total);
            }
        if(total == 0)
        {
          $('#tren-tahun').hide();
          // $('#gambar').show();
          
        }else{
            // $('#gambar').hide();
            $('#statistik-produk-tahun').html("Statistik Produk Tahun "+y+"");
            var options = {
            series: [{
                name: "Total Proyek",
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
                categories: proyek,
                type: 'category',
                tickPlacement: 'on',
                labels: {},
            }
        }
        var chart = new ApexCharts(document.querySelector('#tren-tahun'), options);
        chart.render();
                
        chart.updateSeries([{
        name: "Total Proyek",
        data: total,
        }])
            }
        }
    });
    
   }else{
      //  var pilih = produk.replace("%20", " ");
       $('#statistik-produk-tahun').html("Statistik Produk Tahunan");
       $.ajax({
           url: "<?php echo base_url('api/FilterTrenProyekPerTahun') ?>",
           type: "POST",
           dataType: "JSON",
           success: function(data){
               var tahun = [];
               var total = [];
               var proyek = [];
               for (var i in data){
                   tahun.push(data[i].tahun);
                   total.push(data[i].total);
                   proyek.push(data[i].proyek);
               }
               if(value == 0){
                   $('#statistik-produk-pertahun').html("Statistik Produk Tahunan");
                   $('#tren-tahun').hide();
                  //  $('#gambar').show();
               }else{
                // $('#gambar').hide();
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
                        name: "Total Proyek",
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
                        name: "Total Proyek ",
                        data: total
                    }])
               }
           }
       });
   }
}


$(document).ready(function(){
    totalEstimator();
    totalProyek();
    totalSuplier();

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

    function formatData (data) {
          if (!data.id) { return data.text; }
          if (data.kategori != "2") {
            return "<b>"+data.text+"</b>";
          } else {
            return "<span style='padding-left:20px'>"+data.text+"</span>";
          }
    }

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
            url: "<?php echo base_url('api/getListWilayah') ?>",
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

    //select proyek
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

      $('#wilayah-bahan,#namaproyek').on('change', function() {
        reloadData();
      });

    ///memanggil fungsi chart bulan
    // getGrafikTrenProdukBulan();
    ///memanggil fungsi chart tahun
    // getGrafikTrenProdukTahun();
    ///memanggil fungsi map
    // getMap();
    ///memanggil card
    // cardProduk();
    // cardProdukTerpakai();
    // cardPenggunaProyek();
    // TrenPaketProduk();
    // $('#map').hide();
    // $('.id').hide();
    var change = $('#select-produk').on('change', function(){
        // getGrafikTrenProdukBulan();
        // getGrafikTrenProdukTahun();
        // cardProduk();
        // cardProdukTerpakai();
        // cardPenggunaProyek();
        // updateMap($('#select2-select-produk-container').prop('title'));
    });
    
});
</script>