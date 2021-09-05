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
                        <h1 class="h3 mb-0 text-gray-800 float-left">Detail Coachee</h1>
                    </div>

                    <div class="row">
                        <div class="col-xl-5 col-md-8 col-sm-12 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <h4>Profil</h4>
                                            </div>
                                            <table class="h6 text-dark">
                                                <tr>
                                                    <td>id</td>
                                                    <td>:</td>
                                                    <td><?= $coachee->id ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Nama</td>
                                                    <td>:</td>
                                                    <td><?= $coachee->name ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td>:</td>
                                                    <td><?= $coachee->email ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Perusahaan</td>
                                                    <td>:</td>
                                                    <td><?= $company->name ?></td>
                                                </tr>
                                            </table>
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= site_url('admin/coachee/edit/') . $coachee->id ?>" class="btn btn-info">Edit</a>

                                                </div>
                                                <div class="col">
                                                    <button onclick=" confirmDelete('<?= site_url('admin/coachee/delete/') . $coachee->id ?>')" class="btn btn-danger">Hapus</button>

                                                </div>
                                                <div class="col">
                                                    <a href="<?= site_url('admin/coachee/goal/list/') . $coachee->id ?>" class="btn btn-primary">Lihat Goal</a>

                                                </div>
                                                <div class="col">
                                                    <a href="<?= site_url('admin/coachee/session/list/') . $coachee->id ?>" class="btn btn-primary">Lihat Sesi</a>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 float-left">Penilaian Persesi</h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Komunikasi Dan Respon Sebelum Coaching</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="komunikasiChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Kehadiran Tiap Sesi</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="kehadiranChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Effort Proses Coaching</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="effortChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Komitment Melakukan Action Plans</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="komitmentChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 float-left">Milestone Goal</h1>
                    </div>

                    <div class="row">
                        <?php for ($i = 0; $i < count($history_milestone); $i++) : ?>
                            <div class="col-lg-6">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Goal : <?= $goals[$i]['goal'] ?></h6>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="milestoneChart<?= $i ?>"></canvas>
                                    </div>
                                </div>
                            </div>
                        <?php endfor ?>
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
    <script>
        function confirmDelete(link) {
            Swal.fire({
                title: 'Apakah Anda Ingin Menghapus Coachee',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace(link)
                }
            })
        }
    </script>

    <script>
        function confirmDelete(link) {
            Swal.fire({
                title: 'Apakah Anda Ingin Menghapus Coachee',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace(link)
                }
            })
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var komunikasi = document.getElementById('komunikasiChart');
        var myChart = new Chart(komunikasi, {
            type: 'line',
            data: {
                labels: [
                    <?php for ($i = 1; $i < count($history_penilaian) + 1; $i++) : ?> '<?= 'Sesi Ke ' . $i ?>',
                    <?php endfor ?>
                ],
                datasets: [{
                    label: 'Komunikasi',
                    data: [
                        <?php foreach ($history_penilaian as $penilaian) : ?>
                            <?= $penilaian->komunikasi ?>,
                        <?php endforeach ?>
                    ],
                    borderColor: 'rgb(78, 114, 223)',
                    borderWidth: 4
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

        var kehadiran = document.getElementById('kehadiranChart');
        var myChart = new Chart(kehadiran, {
            type: 'line',
            data: {
                labels: [
                    <?php for ($i = 1; $i < count($history_penilaian) + 1; $i++) : ?> '<?= 'Sesi Ke ' . $i ?>',
                    <?php endfor ?>
                ],
                datasets: [{
                    label: 'Kehadiran',
                    data: [
                        <?php foreach ($history_penilaian as $penilaian) : ?>
                            <?= $penilaian->kehadiran ?>,
                        <?php endforeach ?>
                    ],
                    borderColor: 'rgb(78, 114, 223)',
                    borderWidth: 4
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

        var effort = document.getElementById('effortChart');
        var myChart = new Chart(effort, {
            type: 'line',
            data: {
                labels: [
                    <?php for ($i = 1; $i < count($history_penilaian) + 1; $i++) : ?> '<?= 'Sesi Ke ' . $i ?>',
                    <?php endfor ?>
                ],
                datasets: [{
                    label: 'effort',
                    data: [
                        <?php foreach ($history_penilaian as $penilaian) : ?>
                            <?= $penilaian->effort ?>,
                        <?php endforeach ?>
                    ],
                    borderColor: 'rgb(78, 114, 223)',
                    borderWidth: 4
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

        var komitment = document.getElementById('komitmentChart');
        var myChart = new Chart(komitment, {
            type: 'line',
            data: {
                labels: [
                    <?php for ($i = 1; $i < count($history_penilaian) + 1; $i++) : ?> '<?= 'Sesi Ke ' . $i ?>',
                    <?php endfor ?>
                ],
                datasets: [{
                    label: 'Komitment',
                    data: [
                        <?php foreach ($history_penilaian as $penilaian) : ?>
                            <?= $penilaian->komitment ?>,
                        <?php endforeach ?>
                    ],
                    borderColor: 'rgb(78, 114, 223)',
                    borderWidth: 4
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

    <?php for ($i = 0; $i < count($history_milestone); $i++) : ?>
        <script>
            var milestoneChart<?= $i ?> = document.getElementById('milestoneChart<?= $i ?>');
            var milestone<?= $i ?> = new Chart(milestoneChart<?= $i ?>, {
                type: 'line',
                data: {
                    labels: [
                        <?php for ($j = 1; $j <= count($history_milestone[$i]); $j++) : ?> '<?= 'milestone ke ' . $j ?>',
                        <?php endfor ?>
                    ],
                    datasets: [{
                        label: 'Hasil Milestone',
                        data: [
                            <?php foreach ($history_milestone[$i] as $milestone) : ?>
                                <?= $milestone->milestone ?>,
                            <?php endforeach ?>
                        ],
                        borderColor: 'rgb(78, 114, 223)',
                        borderWidth: 4
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
    <?php endfor ?>

</body>


</html>