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
					<h1 class="h3 mb-4 text-gray-800">
						Goal : <?= $goal->goal ?>
						<br>
						<?php if ($goal->status == 'selesai') : ?>
							<span class="badge badge-pill badge-success">Goal Selesai</span>
						<?php else : ?>
							<span class="badge badge-pill badge-secondary">Goal Belum Selesai</span>
						<?php endif ?>
					</h1>
					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h4 class="m-0 font-weight-bold text-primary float-left">Success Criteria : <?= $criteria->criteria ?></h4>
							<a href="" class="btn btn-success float-right" data-toggle="modal" data-target="#addNote">Tambah Notes</a>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th rowspan="2">No</th>
											<th rowspan="2">Action</th>
											<th colspan="3">Result</th>
										</tr>
										<tr>
											<th>Berhasil</th>
											<th>Tidak Berhasil</th>
											<th>Butuh Waktu Lama</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($actions as $action) : ?>
											<tr>
												<td><?= $i++ ?></td>
												<td><?= $action->action ?></td>
												<form>
													<td><?php if ($action->result == 'berhasil') { ?> <h2>✓</h2> <?php } ?></td>
													<td> <?php if ($action->result == 'tidak berhasil') { ?> <h2>✓</h2> <?php } ?></td>
													<td> <?php if ($action->result == 'butuh waktu lama') { ?> <h2>✓</h2> <?php } ?></td>
												</form>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<?php foreach ($notes as $note) : ?>
						<div class="row mb-3">
							<div class="col-lg-6">
								<div class="card border-left-primary shadow h-100 py-2">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
													Komentar</div>
												<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $note->comment ?></div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="card">
									<div class="card border-left-success shadow h-100 py-2">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Result</div>
													<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $note->result ?></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- end notes -->
					<?php endforeach ?>
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

	<div class="modal fade" id="addNotes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Notes</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="<?= site_url('coach/coachee/save-notes') ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="comment">Komentar</label>
							<textarea name="comment" id="comment" class="form-control" id="" cols="30" rows="10"></textarea>
						</div>
						<div class="form-group">
							<label for="result">Result</label>
							<textarea name="result" id="result" class="form-control" id="" cols="30" rows="10"></textarea>
						</div>
						<div class="form-group">
							<input type="hidden" name="goals_id" id="goals_id" value="<?= $goal->id ?>">
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="addNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Notes</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="<?= site_url('coach/coachee/note/add') ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="comment">Komentar</label>
							<textarea name="comment" id="comment" class="form-control" id="" cols="30" rows="10" required></textarea>
						</div>
						<div class="form-group">
							<label for="result">Result</label>
							<textarea name="result" id="result" class="form-control" id="" cols="30" rows="10" required></textarea>
						</div>
						<div class="form-group">
							<input type="hidden" name="goals_id" id="goals_id" value="<?= $goal->id ?>" required>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-success" type="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php $this->load->view('layouts/script'); ?>
	<?php if ($this->session->flashdata('milestone') == 'add') : ?>
		<script>
			Swal.fire(
				'Sukses',
				'Milestone Telah Di Tambahkan',
				'success'
			)
		</script>
	<?php endif ?>

	<?php if ($this->session->flashdata('milestone') == 'ada') : ?>
		<script>
			Swal.fire(
				'',
				'Milestone Sudah Ada',
			)
		</script>
	<?php endif ?>
</body>

</html>
