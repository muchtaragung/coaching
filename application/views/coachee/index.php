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
					<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Sesi Milik Anda</h6>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>No</th>
											<th>Sesi Ke</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($sessions as $session) : ?>
											<tr>
												<td><?php echo $i++ ?></td>
												<td> <?= $session->session ?> </td>
												<td>
													<?php if ($session->status == 'belum mulai') : ?>
														<a href="" class="btn btn-danger disabled">Sesi Belum Dimulai</a>
													<?php elseif ($session->status == 'belum selesai') : ?>
														<a href="" class="btn btn-primary disabled">Sesi Belum Selesai</a>
													<?php elseif ($session->status == 'selesai') : ?>
														<a href="" class="btn btn-success disabled">Sesi Sudah Selesai</a>
													<?php endif ?>
												</td>
												<td>
													<?php if ($session->status == 'belum mulai') : ?>
														<a href="" class="btn btn-primary disabled">Belum Di Mulai</a>
													<?php elseif ($session->status == 'belum selesai') : ?>
														<a href="<?= site_url('coachee/goals/') ?>" class="btn btn-primary">Lihat Goals</a>
													<?php elseif ($session->status == 'selesai') : ?>
														<a href="<?= site_url('coachee/report/show/' . $session->id) ?>" class="btn btn-primary">Cetak laporan</a>
													<?php endif ?>
												</td>
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

	<div class="modal fade" id="addGoal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Peserta</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="<?= site_url('coachee/addgoal') ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="goal">Goals</label>
							<input type="text" name="goal" id="goal" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="due_date">due date</label>
							<input type="date" name="due_date" id="due_date" class="form-control" required>
						</div>
						<input type="hidden" name="coachee_id" value="<?= $this->session->userdata('id'); ?>">
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="submit">Submit</button>
					</div>
				</form>
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
	<?php if ($this->session->flashdata('report') == 'belum ada') : ?>
		<script>
			Swal.fire(
				'',
				'Report belum Ada',
			)
		</script>
	<?php endif ?>
</body>

</html>