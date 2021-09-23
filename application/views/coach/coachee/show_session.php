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
						<h1 class="h3 mb-0 text-gray-800 float-left">Data Hasil Penilaian Sesi</h1>
						<?php if (isset($report[0])) : ?>
							<a href="<?= site_url('coach/coachee/session/report/show/' . $session->id . '/' . $coachee->id) ?>" class="btn btn-success btn-icon-split float-right">
								<span class="icon text-white-50">
									<i class="fas fa-print"></i>
								</span>
								<span class="text">Cetak Laporan</span>
							</a>
						<?php endif ?>
					</div>

					<div class="row">
						<div class="col-xl-7 col-md-8 col-sm-12 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
												<h4>
													Data Penilaian Milestone
												</h4>
											</div>
											<br>
											<div class="h5 mb-0 font-weight-bold ">List Goal</div>
											<br>
											<table class="table">
												<?php foreach ($goals as $goal) : ?>
													<tr class="h5 mb-0 text-gray-700">
														<td class="">
															<?= $goal->goal ?>
															<br>
															<?php if ($goal->status == 'selesai') : ?>
																<span class="badge badge-pill badge-success">Selesai</span>
															<?php else : ?>
																<span class="badge badge-pill badge-secondary">Belum Selesai</span>
															<?php endif ?>
														</td>
														<td><a href="<?= site_url('coach/coachee/session/milestone/detail/' . $goal->id . '/' . $session->id) ?>" class="btn btn-sm btn-primary">Detail Milestone</a></td>
													</tr>
												<?php endforeach ?>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-5 col-md-8 col-sm-12 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<?php if ($status_milestone != 'true') : ?>
											<div class="col mr-2">
												<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
													<h4>
														Data Hasil Penilaian Sesi
													</h4>
												</div>
												<?php if (!isset($penilaian)) : ?>
													<div class="h5 mb-0 font-weight-bold text-gray-800">Penilaian Belum Ada</div>
													<a href="<?= site_url('coach/coachee/session/penilaian/' . $session->id . '/' . $coachee->id) ?>" class="btn btn-primary">Penilaian</a>
												<?php else : ?>
													<table class="">
														<tr class="h5 mb-0 text-gray-800">
															<td class="font-weight-bold">
																Komunikasi Dan Respon
															</td>
															<td>:</td>
															<td><?= $penilaian->komunikasi ?></td>
														</tr>
														<tr class="h5 mb-0 text-gray-800">
															<td class="font-weight-bold">
																Kehadiran Setiap Sesi
															</td>
															<td>:</td>
															<td><?= $penilaian->kehadiran ?></td>
														</tr>
														<tr class="h5 mb-0 text-gray-800">
															<td class="font-weight-bold">
																Effort Proses Coaching
															</td>
															<td>:</td>
															<td><?= $penilaian->effort ?></td>
														</tr>
														<tr class="h5 mb-0 text-gray-800">
															<td class="font-weight-bold">
																Komitment Melakukan Action Plan
															</td>
															<td>:</td>
															<td><?= $penilaian->komitment ?></td>
														</tr>
													</table>
													<br>
													<?php if (!isset($report[0])) : ?>
														<a href="<?= site_url('coach/coachee/session/report/create/' . $session->id . '/' . $coachee->id) ?>" class="btn btn-warning btn-icon-split float-right">
															<span class="icon text-white-50">
																<i class="fas fa-print"></i>
															</span>
															<span class="text">Buat Laporan</span>
														</a>
													<?php endif ?>
												<?php endif ?>
											</div>
										<?php else : ?>
											<div class="col mr-2">
												<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
													<h4>
														Silahkan isi penilaian milestone sebelum mengisi penilaian sesi.
													</h4>
												</div>
											</div>
										<?php endif ?>
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


</body>


</html>