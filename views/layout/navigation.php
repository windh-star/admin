<script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/js.cookie.js') ?>"></script>

<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
            <div class="pull-left">
                <img src="<?php echo base_url('assets/img/admin.jpg') ?>" alt="" class="thumb-md img-circle">
            </div>
            <div class="user-info">
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span id="pengguna" style="text-transform:capitalize;"></span></a>
                    <a href="javascript:void(0)" onclick="konfirmasiLogout()" style="color: #ef5350;"><i class="fa fa-sign-out"></i> Keluar</a>
                </div>
            </div>
        </div>
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="<?php echo base_url('beranda') ?>" id="menu_beranda" class="waves-effect"><i class="md md-home"></i><span> Beranda </span></a>
                </li>

                <li class="has_sub">
                    <a href="#" id="menu_master" class="waves-effect"><i class="md md-now-widgets"></i><span> Master Data </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li id="menu_bahan"><a href="<?php echo base_url('bahan') ?>">Bahan</a></li>
                        <li id="menu_upah"><a href="<?php echo base_url('upah') ?>">Upah</a></li>
                        <li id="menu_alat"><a href="<?php echo base_url('alat') ?>">Alat</a></li>
                        <li id="menu_bua_bps"><a href="<?php echo base_url('bua_bps') ?>">BUA BPS</a></li>
                        <li id="menu_kategori_pekerjaan"><a href="<?php echo base_url('kategori_pekerjaan') ?>">Kategori Pekerjaan</a></li>
                        <li id="menu_pekerjaan"><a href="<?php echo base_url('pekerjaan') ?>">Pekerjaan</a></li>
                        <li class="has_sub" id="menu_pengguna"><a href="<?php echo base_url('pengguna') ?>">Pengguna</a>
                            <ul>
                              <li id="menu_sesi_pengguna">
                                <a href="<?php echo base_url('pengguna')?>">Pengguna</a></li>
                                <a href="<?php echo base_url('sesi_pengguna')?>">Sesi Pengguna</a></li>
                            </ul>
                        </li>
                        <li id="menu_wilayah"><a href="<?php echo base_url('wilayah') ?>">Wilayah</a></li>
                        <li id="menu_ikk_bps"><a href="<?php echo base_url('ikk_bps') ?>">IKK BPS</a></li>
                        <li id="menu_artikel"><a href="<?php echo base_url('artikel') ?>">Artikel</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="#" id="menu_estimasi" class="waves-effect"><i class="md md-now-widgets"></i><span> Estimasi </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li id="menu_proyek"><a href="<?php echo base_url('proyek') ?>">Proyek</a></li>
                        <li id="menu_ahs"><a href="<?php echo base_url('ahs') ?>">AHS</a></li>
                        <li id="menu_harga_satuan"><a href="<?php echo base_url('harga_satuan') ?>">Harga Satuan</a></li>
                        <li id="menu_volume"><a href="<?php echo base_url('volume') ?>">Volume</a></li>
                    </ul>
                  </li>

                <li class="has_sub">
                    <a href="#" id="menu_suplier" class="waves-effect"><i class="md md-now-widgets"></i><span> Suplier </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li id="menu_suplier"><a href="<?php echo base_url('suplier') ?>">Suplier</a></li>
                        <li id="menu_produk"><a href="<?php echo base_url('produk') ?>">Produk</a></li>
                        <li id="menu_wilayah"><a href="<?php echo base_url('wilayah') ?>">Wilayah Produk</a></li>
                        <li id="menu_kategori_produk"><a href="<?php echo base_url('kategori_produk') ?>">Kategori Produk</a></li>
                        <li id="menu_merk"><a href="<?php echo base_url('merk') ?>">Merk</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="#" id="menu_template" class="waves-effect"><i class="md md-now-widgets"></i><span> Template </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li id="menu_template_proyek"><a href="<?php echo base_url('template_proyek') ?>">Template Proyek</a></li>
                        <li id="menu_template_kategori_pekerjaan"><a href="<?php echo base_url('template_kategori_pekerjaan') ?>">Template Kategori Pekerjaan</a></li>
                        <li id="menu_template_pekerjaan"><a href="<?php echo base_url('template_pekerjaan') ?>">Template Pekerjaan</a></li>
                        <li id="menu_template_ahs"><a href="<?php echo base_url('template_ahs') ?>">Template AHS</a></li>
                        <li id="menu_template_harga"><a href="<?php echo base_url('template_harga') ?>">Template Harga</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="#" id="menu_ekstra" class="waves-effect"><i class="md md-now-widgets"></i><span> Ekstra </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li id="menu_bugs"><a href="<?php echo base_url('bugs') ?>">Bugs</a></li>
                        <li id="menu_rating_penggunaan"><a href="<?php echo base_url('rating_pengguna') ?>">Rating Penggunaan</a></li>
                        <li id="menu_rating_proyek"><a href="<?php echo base_url('rating_proyek') ?>">Rating Proyek</a></li>
                        <li id="menu_rating_produk"><a href="<?php echo base_url('rating_produk') ?>">Rating Produk</a></li>
                        <li id="menu_rating_suplier"><a href="<?php echo base_url('rating_supplier') ?>">Rating Supplier</a></li>
                    </ul>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<script>
  function tampilNotifikasi(msg,tipe){
    swal({
      position: 'top-end',
      type: tipe,
      html: "<p style='font-size:12pt'>"+msg+"</p>",
      showConfirmButton: false,
      timer: 1500
    });
  }
  
  function konfirmasiLogout() {
    swal({
      title: '<h4>Yakin Anda akan keluar?</h4>',
      html: "<p style='font-size:13pt'><small>Sesi Anda akan berakhir setelah Anda keluar.</small></p>",
      type: 'question',
      width: 450,
      showCancelButton: true,
      allowOutsideClick: false,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: '<strong><i class="fa fa-sign-out"></i> KELUAR</strong>',
      cancelButtonText: '<strong><i class="fa fa-times"></i> BATAL</strong>',
      confirmButtonClass: 'btn btn-danger waves-effect waves-light',
      cancelButtonClass: 'btn btn-warning waves-effect waves-light',
      buttonsStyling: false
    }).then((result) => {
      if (result.value) {
        tampilNotifikasi('Sesi Anda telah diakhiri.','success');
        window.location.href = "<?php echo base_url('login') ?>";
      }
    });
  }
    
  $(document).ready(function() {
    if(Cookies.get('nama_admin') != null) {
      var pengguna = Cookies.get('nama_admin');
      $('#pengguna').html(pengguna);
    } else {
      $('#pengguna').html('N/A');
      var url = window.location.pathname.split( '/' );
      if (url[1] != "")
        window.location.href = "<?php echo base_url('login') ?>";
        tampilNotifikasi('Anda tidak dapat membuka halaman ini. Silakan login dulu!', 'warning');
    }
  });
</script>