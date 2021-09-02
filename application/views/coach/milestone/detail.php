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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 float-left">Detail Milestone</h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Goal : <?= $goal->goal ?></h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="milestoneChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class=" col-xl-5 col-md-8 col-sm-12 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <h4>Milestone Sesi INI</h4>
                                            </div>
                                            <?php if ($milestone == null) : ?>
                                                <div class="text-uppercase mb-1">
                                                    Milestone belum ada
                                                </div>
                                                <br>
                                                <a href="<?= site_url('coach/coachee/session/milestone/add/' . $goal->id . '/' . $session->id) ?>" class="btn btn-success">Tambah Milestone</a>
                                            <?php else : ?>
                                                <table class="h6 text-dark">
                                                    <tr>
                                                        <td>Milestone </td>
                                                        <td>:</td>
                                                        <td><?= $milestone[0]->milestone ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Keterangan</td>
                                                        <td>:</td>
                                                        <td><?= $milestone[0]->keterangan ?></td>
                                                    </tr>
                                                </table>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

    <?php if ($this->session->flashdata('report') == 'berhasil') : ?>
        <script>
            Swal.fire(
                'Berhasil',
                'Berhasil Buat Laporan, Siap Di Cetak',
                'success'
            )
        </script>
    <?php endif ?>

    <?php if ($this->session->flashdata('milestone')) : ?>
        <script>
            Swal.fire(
                '',
                '<?= $this->session->flashdata('milestone') ?>',
            )
        </script>
    <?php endif ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var milestoneChart = document.getElementById('milestoneChart');
        var milestone = new Chart(milestoneChart, {
            type: 'line',
            data: {
                labels: [
                    <?php for ($j = 1; $j <= count($history_milestone); $j++) : ?> '<?= 'milestone ke ' . $j ?>',
                    <?php endfor ?>
                ],
                datasets: [{
                    label: 'Hasil Milestone',
                    data: [
                        <?php foreach ($history_milestone as $milestone) : ?>
                            <?= $milestone->milestone ?>,
                        <?php endforeach ?>
                    ],
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <?php if ($this->session->flashdata('milestone')) : ?>
        <script>
            Swal.fire(
                'Berhasil',
                '<?= $this->session->flashdata('milestone') ?>',
                'success'
            )
        </script>
    <?php endif ?>
</body>


</html>