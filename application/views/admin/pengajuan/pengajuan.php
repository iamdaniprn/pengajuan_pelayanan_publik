<!DOCTYPE html>
<html>
  <head>
    <?php $this->load->view('admin/templates/head'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/dataTables.bootstrap4.min.css">

  </head>
  <body>
    <!-- Side Navbar -->
    <?php 
        $data['hal'] = "pengajuan";
        $this->load->view('admin/templates/menu', $data); 
    ?>

    <div class="page">
      <!-- navbar-->
      <?php $this->load->view('admin/templates/header'); ?>
      
      <!-- Counts Section -->
      <section>
        <div class="container-fluid">
          <div style="height: 10px"></div>

          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Pengajuan
                  <button style="float: right;" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-primary"><a href="<?php echo base_url()?>admin/pengajuan/semua"><i class="fa fa-eye" style="color: white"> Lihat Semua Lokasi di Map</i></a></button>
                  </h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example" class="table table-sm">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama Pengaju</th>
                          <th>Kecamatan</th>
                          <th>Jenis Pengajuan</th>
                          <th>Lokasi</th>
                          <th>Keterangan</th>
                          <th>Foto</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no=1; foreach ($data_pengajuan as $row) { ?>
                        <tr>
                          <th scope="row"><?php echo $no ?></th>
                          <td><?php echo $row->nama_lengkap ?></td>
                          <td><?php echo $row->kecamatan ?></td>
                          <td><?php echo $row->kriteria ?></td>
                          <td><?php echo $row->lokasi ?></td>
                          <td><?php echo $row->keterangan ?></td>
                          <td>
                              <img src="<?php echo base_url()?><?php echo $row->foto ?>" style="height: 100px; width: 180px">
                          </td>
                          <td>
                              <a href="<?php echo base_url()?>admin/pengajuan/unduh/<?php echo $row->id ?>" class="btn btn-xs btn-info"><i class="fa fa-download"> </i></a>
                              <a href="<?php echo base_url()?>admin/pengajuan/lihat/<?php echo $row->id ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"> </i></a>
                              <a href="<?php echo base_url()?>admin/pengajuan/hapus/<?php echo $row->id ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"> </i></a>
                          </td>
                        </tr>
                        <?php $no++;  } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="pesan" data-flashdata="<?php echo $this->session->flashdata('pesan'); ?>"></div>

      <!-- Header Section-->
     

      <!-- footer -->
      <?php $this->load->view('admin/templates/footer'); ?>
      <!-- footer -->
      
    </div>
    <!-- JavaScript files-->
      <?php $this->load->view('admin/templates/javascript'); ?>

      <script src="<?php echo base_url()?>assets/js/switch/sweetalert.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url()?>assets/js/dataTables.bootstrap4.min.js"></script>

      <script type="text/javascript">
          const flashData = $('.pesan').data('flashdata');

          if(flashData == 'tambah'){
            Swal.fire({
                type: 'success',
                title: 'Pengajuan Berhasil Dikirim',
                text: 'Silahkan gunakan email yang lain',
              })
          }else if(flashData == 'daftar_suskes'){
            Swal.fire({
                type: 'success',
                title: 'Pendaftaran Berhasil',
                text: 'Silahkan Login',
              })
          }else if(flashData == 'gagal'){
            Swal.fire({
                type: 'warning',
                title: 'Login Gagal',
                text: 'Silahkan Ulangi Lagi',
              })
          }
      </script>

      <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        } );
      </script>

      <script type="text/javascript">
          document.getElementById('reset').onclick= function() {
              var field1= document.getElementById('lng');
              var field2= document.getElementById('lat');
              field1.value= field1.defaultValue;
              field2.value= field2.defaultValue;
          };
      </script>    

      <script type="text/javascript">
          function updateMarkerPosition(latLng) {
              document.getElementById('lat').value = [latLng.lat()];
              document.getElementById('lng').value = [latLng.lng()];
          }

          var myOptions = {
              zoom: 7,
              scaleControl: true,
              center:  new google.maps.LatLng(-6.923700,106.928726),
              mapTypeId: google.maps.MapTypeId.ROADMAP
          };

       
          var map = new google.maps.Map(document.getElementById("map"),
              myOptions);

          var marker1 = new google.maps.Marker({
              position : new google.maps.LatLng(-6.923700,106.928726),
              title : 'lokasi',
              map : map,
              draggable : true
          });
       
       //updateMarkerPosition(latLng);

          google.maps.event.addListener(marker1, 'drag', function() {
          updateMarkerPosition(marker1.getPosition());
       });
      </script>

  </body>
</html>