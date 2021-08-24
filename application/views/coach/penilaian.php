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
					<h1 class="h3 mb-4 text-gray-800">Penilaian Sesi</h1>

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">

						</div>
						<div class="card-body">
							<form action="<?= site_url('coach/coachee/session/save-penilaian') ?>" method="POST" class="text-center">
								<div class="form-group">
									<input type="hidden" name="session_id" value="<?= $session->id ?>">
									<input type="hidden" name="coachee_id" value="<?= $coachee->id ?>">
								</div>
								<div class="card my-4">
									<div class="card-header">
										<h6 class="m-0 font-weight-bold text-secondary">Komunikasi Dan Respon Sebelum Coaching</h6>
									</div>
									<div class="card-body">
										<div class="row">
											<label for="" class="col">1</label>
											<label for="" class="col">2</label>
											<label for="" class="col">3</label>
											<label for="" class="col">4</label>
											<label for="" class="col">5</label>
										</div>
										<div class="row">
											<input type="radio" name="komunikasi" value="1" class="col">
											<input type="radio" name="komunikasi" value="2" class="col">
											<input type="radio" name="komunikasi" value="3" class="col">
											<input type="radio" name="komunikasi" value="4" class="col">
											<input type="radio" name="komunikasi" value="5" class="col">
										</div>
									</div>
								</div>

								<div class="card my-4">
									<div class="card-header">
										<h6 class="m-0 font-weight-bold text-secondary">Kehadiran Tiap Sesi</h6>
									</div>
									<div class="card-body">
										<div class="row">
											<label for="" class="col">1</label>
											<label for="" class="col">2</label>
											<label for="" class="col">3</label>
											<label for="" class="col">4</label>
											<label for="" class="col">5</label>
										</div>
										<div class="row">
											<input type="radio" name="kehadiran" value="1" class="col">
											<input type="radio" name="kehadiran" value="2" class="col">
											<input type="radio" name="kehadiran" value="3" class="col">
											<input type="radio" name="kehadiran" value="4" class="col">
											<input type="radio" name="kehadiran" value="5" class="col">
										</div>
									</div>
								</div>

								<div class="card my-4">
									<div class="card-header">
										<h6 class="m-0 font-weight-bold text-secondary">Effort Proses Coaching</h6>
									</div>
									<div class="card-body">
										<div class="row">
											<label for="" class="col">1</label>
											<label for="" class="col">2</label>
											<label for="" class="col">3</label>
											<label for="" class="col">4</label>
											<label for="" class="col">5</label>
										</div>
										<div class="row">
											<input type="radio" name="effort" value="1" class="col">
											<input type="radio" name="effort" value="2" class="col">
											<input type="radio" name="effort" value="3" class="col">
											<input type="radio" name="effort" value="4" class="col">
											<input type="radio" name="effort" value="5" class="col">
										</div>
									</div>
								</div>

								<div class="card my-4">
									<div class="card-header">
										<h6 class="m-0 font-weight-bold text-secondary">Komitment Melakukan Action Plans</h6>
									</div>
									<div class="card-body">
										<div class="row">
											<label for="" class="col">1</label>
											<label for="" class="col">2</label>
											<label for="" class="col">3</label>
											<label for="" class="col">4</label>
											<label for="" class="col">5</label>
										</div>
										<div class="row">
											<input type="radio" name="komitment" value="1" class="col">
											<input type="radio" name="komitment" value="2" class="col">
											<input type="radio" name="komitment" value="3" class="col">
											<input type="radio" name="komitment" value="4" class="col">
											<input type="radio" name="komitment" value="5" class="col">
										</div>
									</div>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary float-right">Submit</button>
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

	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
					<a class="btn btn-primary" href="login.html">Logout</a>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="addCoachee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Peserta</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>

			</div>
		</div>
	</div>
	<?php $this->load->view('layouts/script'); ?>

	<?php if ($this->session->flashdata('status') == 'login') : ?>
		<script>
			Swal.fire(
				'Selamat Datang',
				'Anda Telah Login',
				'success'
			)
		</script>
	<?php endif ?>
</body>


</html>
