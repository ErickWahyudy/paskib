<?php $this->load->view('landingpage/header') ?>

    <?= $this->session->flashdata('pesan'); ?>
    <!-- Register Start -->
    <div class="container-xxl">
        <div class="container"><br><br><br>
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="section-title bg-white text-center text-danger px-3"><?= $meta_keywords ?></h6>
                <p> *Silahkan login dengan akun yang telah terdaftar</p>
            </div>
            <div class="row g-0 justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.5s">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="email" placeholder="Email / Nama" required="">
                                    <label for="email">Email / Nama</label>
                                </div>
                            </div>
 
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" required>
                                    <label for="password">Password</label>
                                    <input type="checkbox" onclick="viewPassword()"> Lihat Password
                                </div>
                            </div>
                            
                            <div class="col-12 text-center">
                                <input type="submit" name="login" value="Login aplikasi" class="btn btn-danger rounded-pill py-3 px-5">
                            </div>
                            <div class="">
                                <a href="<?= base_url('peserta/cari') ?>">Lihat Hasil Nilai Peserta ? (klik disini)</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Register End -->
    <script>

        //lihat password
        function viewPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
         
    </script>
<?php $this->load->view('landingpage/footer') ?>