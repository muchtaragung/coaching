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
						<h1 class="h3 mb-0 text-gray-800">Data Hasil Penilaian Sesi</h1>
					</div>

					<div class="row">

						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-5 col-md-8 col-sm-12 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
												<h4>
													Data Hasil Penilaian Sesi
												</h4>
											</div>
											<?php if (!isset($penilaian)) : ?>
												<div class="h5 mb-0 font-weight-bold text-gray-800">Penilaian Dan Laporan Belum Ada</div>
											<?php else : ?>
												<table class="">
													<tr class="h5 mb-0 text-gray-800">
														<td class="font-weight-bold">
															id
														</td>
														<td>:</td>
														<td><?= $penilaian->id ?></td>
													</tr>
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
												<button onclick="confirmDelete('<?= site_url('admin/coachee/session/penilaian/delete/' . $penilaian->id . '/' . $session->id) ?>','Penilaian')" class="btn btn-danger">
													Hapus Penilaian
												</button>

											<?php endif ?>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-5 col-md-8 col-sm-12 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<?php if (!isset($report)) : ?>
												<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
													<h4>
														Laporan Belum Tersedia
													</h4>
												</div>
											<?php else : ?>
												<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
													<h4>
														Laporan Tersedia
													</h4>
												</div>
												<button onclick="confirmDelete('<?= site_url('admin/coachee/session/laporan/delete/' . $report->id . '/' . $session->id) ?>','Laporan')" class="btn btn-danger">
													Hapus Laporan
												</button>
												<a href="<?= site_url('AdminController/showReport/' . $session->id) ?>" class="btn btn-success btn-icon-split">
													<span class="icon text-white-50">
														<i class="fas fa-print"></i>
													</span>
													<span class="text">Laporan PDF</span>
												</a>
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

	<?php if ($this->session->flashdata('report')) : ?>
		<script>
			Swal.fire(
				'Berhasil',
				'<?= $this->session->flashdata('report') ?>',
				'success'
			)
		</script>
	<?php endif ?>

	<?php if ($this->session->flashdata('penilaian')) : ?>
		<script>
			Swal.fire(
				'Berhasil',
				'<?= $this->session->flashdata('penilaian') ?>',
				'success'
			)
		</script>
	<?php endif ?>

	<script>
		function confirmDelete(link, category) {
			Swal.fire({
				title: 'Apakah Anda Ingin Menghapus ' + category,
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
</body>


</html>