<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'BerandaController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['beranda'] = 'BerandaController/index';
$route['login'] = 'LoginController/index';
$route['api/loginPengguna'] = 'LoginController/loginPengguna';

$route['bahan'] = 'BahanController/index';
$route['api/getRingkasanStatusBahan/(:any)'] = 'BahanController/getRingkasanStatus/$1';
$route['api/getTabelBahan'] = 'BahanController/getTabelBahan';
$route['api/getTabelLengkapiBahan'] = 'BahanController/getTabelLengkapiBahan';
$route['api/simpanBahan'] = 'BahanController/simpanBahan';
$route['api/ubahBahan'] = 'BahanController/ubahBahan';
$route['api/verifikasiBahan/(:any)'] = 'BahanController/verifikasiBahan/$1';
$route['api/verifikasiSemuaBahan'] = 'BahanController/verifikasiSemuaBahan';
$route['api/getMaxIDBahan'] = 'BahanController/getMaxIDBahan';
$route['api/getSuggestTahunBahan/(:any)/(:any)'] = 'BahanController/getSuggestTahun/$1/$2';
$route['api/getSuggestKeteranganBahan/(:any)/(:any)'] = 'BahanController/getSuggestKeterangan/$1/$2';
$route['api/getBahanKriteria/(:any)/(:any)'] = 'BahanController/getBahanKriteria/$1/$2';
$route['api/getRincianBahan/(:any)'] = 'BahanController/getRincianBahan/$1';
$route['api/getLengkapiBahanKriteria/(:any)/(:any)'] = 'BahanController/getLengkapiBahanKriteria/$1/$2';
$route['api/getListBahan'] = 'BahanController/getListBahan';
$route['api/getRingkasanSumberBahan'] = 'BahanController/getRingkasanSumberBahan';

$route['alat'] = 'AlatController/index';
$route['api/getRingkasanStatusAlat/(:any)'] = 'AlatController/getRingkasanStatus/$1';
$route['api/getTabelAlat'] = 'AlatController/getTabelAlat';
$route['api/getTabelLengkapiAlat'] = 'AlatController/getTabelLengkapiAlat';
$route['api/simpanAlat'] = 'AlatController/simpanAlat';
$route['api/ubahAlat'] = 'AlatController/ubahAlat';
$route['api/verifikasiAlat/(:any)'] = 'AlatController/verifikasiAlat/$1';
$route['api/verifikasiSemuaAlat'] = 'AlatController/verifikasiSemuaAlat';
$route['api/getMaxIDAlat'] = 'AlatController/getMaxIDAlat';
$route['api/getSuggestTahunAlat/(:any)/(:any)'] = 'AlatController/getSuggestTahun/$1/$2';
$route['api/getSuggestKeteranganAlat/(:any)/(:any)'] = 'AlatController/getSuggestKeterangan/$1/$2';
$route['api/getAlatKriteria/(:any)/(:any)'] = 'AlatController/getAlatKriteria/$1/$2';
$route['api/getRincianAlat/(:any)'] = 'AlatController/getRincianAlat/$1';
$route['api/getLengkapiAlatKriteria/(:any)/(:any)'] = 'AlatController/getLengkapiAlatKriteria/$1/$2';
$route['api/getListAlat'] = 'AlatController/getListAlat';

$route['upah'] = 'UpahController/index';
$route['api/getRingkasanStatusUpah/(:any)'] = 'UpahController/getRingkasanStatus/$1';
$route['api/getTabelUpah'] = 'UpahController/getTabelUpah';
$route['api/getTabelLengkapiUpah'] = 'UpahController/getTabelLengkapiUpah';
$route['api/simpanUpah'] = 'UpahController/simpanUpah';
$route['api/ubahUpah'] = 'UpahController/ubahUpah';
$route['api/verifikasiUpah/(:any)'] = 'UpahController/verifikasiUpah/$1';
$route['api/verifikasiSemuaUpah'] = 'UpahController/verifikasiSemuaUpah';
$route['api/getMaxIDUpah'] = 'UpahController/getMaxIDUpah';
$route['api/getSuggestTahunUpah/(:any)/(:any)'] = 'UpahController/getSuggestTahun/$1/$2';
$route['api/getSuggestKeteranganUpah/(:any)/(:any)'] = 'UpahController/getSuggestKeterangan/$1/$2';
$route['api/getUpahKriteria/(:any)/(:any)'] = 'UpahController/getUpahKriteria/$1/$2';
$route['api/getRincianUpah/(:any)'] = 'UpahController/getRincianUpah/$1';
$route['api/getLengkapiUpahKriteria/(:any)/(:any)'] = 'UpahController/getLengkapiUpahKriteria/$1/$2';
$route['api/getListUpah'] = 'UpahController/getListUpah';

$route['ahs'] = 'AHSController/index';
$route['api/getRingkasanStatusAHS/(:any)'] = 'AHSController/getRingkasanStatus/$1';
$route['api/simpanAHS'] = 'AHSController/simpanAHS';
$route['api/getTabelAHS'] = 'AHSController/getTabelAHS';
$route['api/getRincianAHS'] = 'AHSController/getRincianAHS/$1/$2';
$route['api/getRingkasanSumberAHS'] = 'AHSController/getRingkasanSumberAHS';

$route['impor'] = 'ImporEksporController/impor';
$route['imporBUA'] = 'ImporEksporController/imporBUA';

$route['api/getListWilayah'] = 'WilayahController/getListWilayah';
$route['api/getWilayahKriteria/(:any)/(:any)'] = 'WilayahController/getWilayahKriteria/$1/$2';

///Pengguna
$route['pengguna'] = 'PenggunaController/index';
$route['api/getTabelPengguna'] = 'PenggunaController/getTabelPengguna';
$route['api/getListPengguna'] = 'PenggunaController/getListPengguna';

///Proyek
$route['proyek'] = 'ProyekController/index';
$route['api/getTabelProyek'] = 'ProyekController/getTabelProyek';

///Pekerjaan
$route['pekerjaan'] = 'PekerjaanController/index';
$route['api/getTabelPekerjaan'] = 'PekerjaanController/getTabelPekerjaan';

//Kategori Pekerjaan
$route['kategori_pekerjaan'] = 'KategoriPekerjaanController/index';
$route['api/getTabelKategoriPekerjaan'] = 'KategoriPekerjaanController/getTabelKategoriPekerjaan';
$route['api/getListKategori'] = 'KategoriPekerjaanController/getListKategori';
$route['api/simpanKategori'] = 'KategoriPekerjaanController/simpanKategori';
//$route['api/getRingkasanProyek/(:any)']  = 'KategoriPekerjaanController/getRingkasanProyek/$1';
$route['api/getInfoKategori/(:any)'] = 'KategoriPekerjaanController/getInfoKategori/$1';
$route['api/ubahKategori'] = 'KategoriPekerjaanController/ubahKategori';
///proyek
$route['api/getListProyek'] = 'ProyekController/getListProyek';
$route['api/getInfoProyek/(:any)'] = 'ProyekController/getInfoProyek/$1';
$route['api/ubahProyek'] = 'ProyekController/ubahProyek';
///Penngguna
$route['api/getInfoPengguna/(:any)'] = 'PenggunaController/getInfoPengguna/$1';
$route['api/ubahPengguna'] = 'PenggunaController/ubahPengguna';
$route['api/simpanPengguna'] = 'PenggunaController/simpanPengguna';
$route['api/getPengalamanPengguna/(:any)'] = 'PenggunaController/getPengalaman/$1';

//wilayah
$route['wilayah'] = 'WilayahController/index';
$route['api/getTabelWilayah'] = 'WilayahController/getTabelWilayah';
//$route['api/getListWilayah'] = 'WilayahController/getListWilayah';

//bua bps
$route['bua_bps'] = 'BuaBpsController/index';
$route['api/getTabelBUABPS'] = 'BuaBpsController/getTabelBUABPS';

//bugs
$route['bugs'] = 'BugsController/index';
$route['api/getTabelBugs'] = 'BugsController/getTabelBugs';
$route['api/getListBugs'] = 'BugsController/getListBugs';

//artikel
$route['artikel'] = 'ArtikelController/index';
$route['api/getTabelArtikel'] = 'ArtikelController/getTabelArtikel';
$route['api/simpanArtikel'] = 'ArtikelController/simpanArtikel';
$route['api/ubahArtikel'] = 'ArtikelController/ubahArtikel';
$route['api/hapusArtikel'] = 'ArtikelController/hapusArtikel';


//ikk bps
$route['ikk_bps'] = 'IkkBpsController/index';
$route['api/getTabelIkkBps'] = 'IkkBpsController/getTabelIkkBps';

//sesi pengguna
$route['sesi_pengguna'] = 'SesiPenggunaController/index';
$route['api/getTabelSesiPengguna'] = 'SesiPenggunaController/getTabelSesiPengguna';

//harga satuan
$route['harga_satuan'] = 'HargaSatuanController/index';
$route['api/getTabelHargaSatuan'] = 'HargaSatuanController/getTabelHargaSatuan';

//volume
$route['volume'] = 'VolumeController/index';
$route['api/getTabelVolume'] = 'VolumeController/getTabelVolume';

//rating pengguna
$route['rating_pengguna'] = 'RatingPenggunasController/index';
$route['api/getTabelRatingPengguna'] = 'RatingPenggunaController/getTabelRatingPengguna';

//rating proyek
$route['rating_proyek'] = 'RatingProyekController/index';
$route['api/getTabelRatingProyek'] = 'RatingProyekController/getTabelRatingProyek';

//rating Produk
$route['rating_produk'] = 'RatingProdukController/index';
$route['api/getTabelRatingProduk'] = 'RatingProdukController/getTabelRatingProduk';

//rating suplier
$route['rating_suplier'] = 'RatingSuplierController/index';
$route['api/getTabelRatingSuplier'] = 'RatingSuplierController/getTabelRatingSuplier';

//suplier
$route['suplier'] = 'SuplierController/index';
$route['api/getTabelSuplier'] = 'SuplierController/getTabelSuplier';

//produk
$route['produk'] = 'ProdukController/index';
$route['api/getTabelProduk'] = 'ProdukController/getTabelProduk';

//featured produk
$route['featured_produk'] = 'FeaturedProdukController/index';
$route['api/getTabelFeaturedProduk'] = 'FeaturedProdukController/getTabelFeaturedProduk';

//foto produk
$route['foto_produk'] = 'FotoProdukController/index';
$route['api/getTabelFotoProduk'] = 'FotoProdukController/getTabelFotoProduk';

//wilayah produk
$route['wilayah_produk'] = 'WilayahProdukController/index';
$route['api/getTabelWilayahProduk'] = 'WilayahProdukController/getTabelWilayahProduk';

//kategori produk
$route['kategori_produk'] = 'KategoriProdukController/index';
$route['api/getTabelKategoriProduk'] = 'KategoriProdukController/getTabelKategoriProduk';

//sub kategori produk
$route['sub_kategori_produk'] = 'SubKategoriProdukController/index';
$route['api/getTabelSubKategoriProduk'] = 'SubKategoriProdukController/getTabelSubKategoriProduk';

//merk
$route['merk'] = 'MerkController/index';
$route['api/getTabelMerk'] = 'MerkController/getTabelMerk';

//voucher
$route['voucher'] = 'VoucherProdukController/index';
$route['api/getTabelVoucherProduk'] = 'VoucherProdukController/getTabelVoucherProduk';

//template proyek
$route['template_proyek'] = 'TemplateProyekController/index';
$route['api/getTabelTemplateProyek'] = 'TemplateProyekController/getTabelTemplateProyek';

//template kategori pekerjaan
$route['template_kategori_pekerjaan'] = 'TemplateKategoriPekerjaanController/index';
$route['api/getTabelTemplateKategoriPekerjaan'] = 'TemplateKategoriPekerjaanController/getTabelTemplateKategoriPekerjaan';

//template pekerjaan
$route['template_pekerjaan'] = 'TemplatePekerjaanController/index';
$route['api/getTabelTemplatePekerjaan'] = 'TemplatePekerjaanController/getTabelTemplatePekerjaan';

//template ahs
$route['template_ahs'] = 'TemplateAhsController/index';
$route['api/getTabelTemplateAhs'] = 'TemplateAhsController/getTabelTemplateAhs';

//template harga satuan
$route['template_harga_satuan'] = 'TemplateHargaSatuanController/index';
$route['api/getTabelTemplateHargaSatuan'] = 'TemplateHargaSatuanController/getTabelTemplateHargaSatuan';


//Tambahan 
$route['api/getListKategoriWilayah'] = 'WilayahController/getListKategoriWilayah';
$route['api/getListProvinsi'] = 'WilayahController/getListProvinsi';
$route['api/getListKategoriBuaBps'] = 'WilayahController/getListKategoriBuaBps';
$route['api/getRingkasanKategoriBuaBps'] = 'WilayahController/getRingkasanKategoriBuaBps';
$route['api/rangeBugs'] = 'WilayahController/rangeBugs';
$route['api/getListKategoriArtikel'] = 'WilayahController/getListKategoriArtikel';
$route['api/getListStatusArtikel'] = 'WilayahController/getListStatusArtikel';
$route['api/getRingkasanKategoriArtikel'] = 'WilayahController/getRingkasanKategoriArtikel';
$route['imporIkkBps'] = 'ImporEksporController/imporIkkBps';