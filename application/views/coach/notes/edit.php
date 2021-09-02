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
                    <h1 class="h3 mb-4 text-gray-800">Edit Notes</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Notes</h6>
                            <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#addCoach">Tambah Coach</a>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('coach/coachee/notes/update') ?>" method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" name="id" id="id" value="<?= $note->id ?>">
                                        <input type="hidden" name="goals_id" value="<?= $note->goals_id ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Komentar</label>
                                        <textarea name="comment" id="" cols="30" rows="3" class="form-control" required><?= $note->comment ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="result">Result</label>
                                        <textarea name="result" id="" cols="30" rows="3" class="form-control" required><?= $note->result ?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-success" type="submit">Submit</button>
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

    <?php $this->load->view('layouts/script'); ?>
</body>

</html>