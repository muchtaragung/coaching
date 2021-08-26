<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('layouts/head') ?>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-6 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="p-5">

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                                    </div>
                                    <?php if ($this->session->flashdata('error') != null) { ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php echo $this->session->flashdata('error'); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($this->session->flashdata('msg') != null) { ?>
                                        <div class="alert alert-success" role="alert">
                                            <?php echo $this->session->flashdata('msg'); ?>
                                        </div>
                                    <?php } ?>
                                    <h5>Hello,</span> Silakan isi password baru anda.</h5>
                                    <form action="<?php echo base_url() ?>auth/reset_password" method="post">
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                        <div class="form-group">
                                            <input type="hidden" name="token" value=" <?php echo $this->uri->segment('3'); ?>">
                                            <label for="">Password Baru</label>
                                            <input type="password" required name="password" class="form-control" id="" placeholder="Masukan Password Baru">
                                            <?php
                                            echo form_error('password');
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Konfirmasi Password</label>
                                            <input type="password" required name="repassword" class="form-control" id="" placeholder="Ulangi Password">
                                            <?php
                                            echo form_error('repassword');
                                            ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>

                                    </form>
                                    <hr>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php $this->load->view('layouts/script.php') ?>

    <?php if ($this->session->flashdata('login') == 'wrong') : ?>
        <script>
            Swal.fire(
                'ooopss...',
                'Email Atau Password Salah',
                'error'
            )
        </script>
    <?php endif ?>

    <?php if ($this->session->flashdata('login') == 'logout') : ?>
        <script>
            Swal.fire(
                'Sampai Jumpa',
                'Anda Telah Logout',
                'success'
            )
        </script>
    <?php endif ?>
</body>

</html>