<!DOCTYPE html>

<html>
    <?php $this->load->view('layout/header') ?>

    <body class="fixed-left">
        <div id="wrapper">
        
            <?php $this->load->view('layout/topbar') ?>
            <?php $this->load->view('layout/navigation') ?>
            <?php $this->load->view('layout/script') ?>

            <?php $this->load->view($halaman) ?>

            <?php $this->load->view('layout/rightbar') ?>
        </div>
    </body>
</html>