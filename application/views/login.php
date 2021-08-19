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
                                        <h1 class="h4 text-gray-900 mb-4">Silahkan Login</h1>
                                    </div>
                                    <form action="<?php echo site_url('auth') ?>" method="post">
                                        <div class="form-group">
                                            <label for="email">email</label>
                                            <input class="form-control" type="text" name="email" id="email" placeholder="masukan email">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input class="form-control" type="password" name="password" id="password" placeholder="masukan password">
                                        </div>
                                        <input class="form-control btn btn-primary" type="submit" value="masuk">
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

    <?php if ($this->session->flashdata('status') == 'logout') : ?>
        <script>
            swal("Anda Telah Login", "", "success");
        </script>
    <?php endif ?>
</body>

</html>
