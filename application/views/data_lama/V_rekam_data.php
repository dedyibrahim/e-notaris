<body onload="persyaratan_telah_dilampirkan();">
<?php  $this->load->view('umum/V_sidebar_data_lama'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_data_lama'); ?>
<div class="container-fluid ">
<ul class="nav nav-tabs">
<li class="nav-item">
<a class="nav-link active" data-toggle="tab" href="#utama">Rekam Dokumen Utama <i class="fas fa-file-word"></i></a>
</li>
<li class="nav-item ml-1">
<a class="nav-link " data-toggle="tab" href="#perizinan">Rekam Dokumen Penunjang <i class="fas fa-file"></i></a>
</li>

</ul>    

<div class="tab-content">
<div class="tab-pane card container-fluid active" id="utama">
<?php $this->load->view('data_lama/V_rekam_utama'); ?>
</div>

<div class="tab-pane card container-fluid " id="perizinan">
<?php $this->load->view('data_lama/V_rekam_penunjang'); ?>
</div>
    
</div>    
</div>
</body>