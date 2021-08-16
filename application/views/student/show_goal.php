<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('student/layouts/head');?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('student/layouts/sidebar');?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view('student/layouts/topbar.php');?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><?= $goal->goal ?></h6>
                            <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#addActionPlan">Tambah Action Plan</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if (!isset($criteria)): ?>
                                        <form action="<?= site_url('student/addcriteria') ?>" method="POST">
                                            <input type="hidden" name="goals_id" id="goals_id" value="<?= $goal->id ?>" class="form-control">
                                            <div class="row form-group">
                                                <div class="col-lg-10">
                                                    <label for="criteria">Success Criteria</label>
                                                    <input type="text" name="criteria" id="" class="form-control" placeholder="success criteria">
                                                </div>
                                                <div class="col-lg-2">
                                                    <button type="submit" class="btn btn-primary form-control">submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    <?php else: ?>
                                        <form action="<?= site_url('student/addCriteria') ?>">
                                            <div class="row form-group">
                                                <div class="col-lg-10">
                                                    <label for="criteria">Success Criteria</label>
                                                    <input type="text" name="criteria" id="" class="form-control" value="<?= $criteria->criteria ?>" readonly>
                                                </div>
                                                <div class="col-lg-2">
                                                    <button type="submit" class="btn btn-primary form-control" disabled>submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Goals</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $i=1; foreach ($actions as $action): ?>
                                            <tr>
                                                <td><?php echo $i++ ?></td>
                                                <td> <?= $action->action ?> </td>
                                            </tr>       
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('student/layouts/footer'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addActionPlan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Peserta</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?= site_url('student/addaction') ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="action">Action Plan</label>
                            <input type="text" name="action" id="action" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="goals_id" id="goals_id" value="<?= $goal->id ?>" class="form-control">
                        </div>
                        <input type="hidden" name="students_id"  >
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php $this->load->view('student/layouts/script'); ?>
</body>

</html>