<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('layouts/head'); ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('layouts/sidebar'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view('layouts/topbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Edit Action Plan</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Action Plan</h6>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('coachee/update-action') ?>" method="POST">
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?= $action->id ?>">
                                    <input type="hidden" name='goal_id' value="<?= $action->goals_id ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Action Plan</label>
                                    <input type="text" name="action" value="<?= $action->action ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">status</label>
                                    <select id="select2" name="result" id="" class="form-control">
                                        <option value=""></option>
                                        <option value="berhasil" <?php if ($action->result == 'berhasil') : ?> selected <?php endif ?>>Berhasil</option>
                                        <option value="tidak berhasil" <?php if ($action->result == 'tidak berhasil') : ?> selected <?php endif ?>>Tidak Berhasil</option>
                                        <option value="butuh waktu lama" <?php if ($action->result == 'butuh waktu lama') : ?> selected <?php endif ?>>Butuh Waktu Lama</option>
                                    </select>
                                </div>
                                <div class="form-group">
								<label for="">Keterangan</label>
                                    <textarea name="keterangan" id="" cols="30" rows="10" class="form-control"><?= $action->keterangan ?></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success float-right">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('layouts/footer'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    </div>
    <?php $this->load->view('layouts/script'); ?>
</body>

</html>
