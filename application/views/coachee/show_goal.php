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
					<h1 class="h3 mb-4 text-gray-800">Goal : <?= $goal->goal ?></h1>
					<h1 class="h3 mb-4 text-gray-800">Status : <?= $goal->status ?></h1>
					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary float-left"><?= $goal->goal ?></h6>
							<?php if ($goal->status == 'belum selesai') : ?>
								<?php if (isset($criteria)) : ?>
									<a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#addActionPlan">Tambah Action Plan</a>
									<button onclick="endGoal('<?= site_url('coachee/endGoal/' . $goal->id) ?>')" class="btn btn-success float-right mx-2">Selesaikan Goal</button>
								<?php endif ?>
							<?php endif ?>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12">
									<?php if (!isset($criteria)) : ?>
										<form action="<?= site_url('coachee/addcriteria') ?>" method="POST">
											<input type="hidden" name="goals_id" id="goals_id" value="<?= $goal->id ?>" class="form-control">
											<div class="row form-group">
												<div class="col-lg-12">
													<label for="criteria">Success Criteria</label>
												</div>
												<div class="col-lg-10">
													<input type="text" name="criteria" id="" class="form-control" placeholder="success criteria" required>
												</div>
												<div class="col-lg-2">
													<button type="submit" class="btn btn-success form-control">submit</button>
												</div>
											</div>
										</form>
									<?php else : ?>
										<div class="row my-2">
											<div class="col-lg-12">
												<label for="criteria">Success Criteria</label>
											</div>
											<div class="col-lg-10">
												<input type="text" name="criteria" id="" class="form-control" placeholder="success criteria" value="<?= $criteria->criteria ?>" readonly>
											</div>
											<div class=" col-lg-2">
												<a href="" class="btn btn-info float-right w-100" data-toggle="modal" data-target="#editCriteria">Edit</a>
											</div>
										</div>
									<?php endif ?>
								</div>
							</div>
							<div class=" table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th rowspan="2">No</th>
											<th rowspan="2">Action</th>
											<th colspan="4">Result</th>
										</tr>
										<tr>
											<th>Berhasil</th>
											<th>Tidak Berhasil</th>
											<th>Butuh Waktu Lama</th>
											<?php if ($goal->status == 'belum selesai') : ?>
												<th>Action</th>
											<?php endif ?>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($actions as $action) : ?>
											<tr>
												<td><?php echo $i++ ?></td>
												<td> <?= $action->action ?> </td>
												<?php if ($action->result == null) : ?>
													<form action="<?= site_url('coachee/saveResult') ?>" method="POST">
														<input type="hidden" name="id" value="<?= $action->id ?>">
														<input type="hidden" name="goals_id" value="<?= $action->goals_id ?>">
														<td><input type="radio" name="result" id="" value="berhasil"></td>
														<td><input type="radio" name="result" id="" value="tidak berhasil"></td>
														<td><input type="radio" name="result" id="" value="butuh waktu lama"></td>
														<?php if ($goal->status == 'belum selesai') : ?>
															<td><button type="submit" class="btn btn-sm btn-primary">Submit</button></td>
														<?php endif ?>
													</form>
												<?php else : ?>
													<td><?php if ($action->result == 'berhasil') { ?> <h2>✓</h2> <?php } ?></td>
													<td> <?php if ($action->result == 'tidak berhasil') { ?> <h2>✓</h2> <?php } ?></td>
													<td> <?php if ($action->result == 'butuh waktu lama') { ?> <h2>✓</h2> <?php } ?></td>
													<?php if ($goal->status == 'belum selesai') : ?>
														<td><button type="submit" class="btn btn-sm btn-secondary disabled">Submit</button></td>
													<?php endif ?>
												<?php endif ?>
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


	<div class="modal fade" id="addActionPlan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Peserta</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="<?= site_url('coachee/addaction') ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="action">Action Plan</label>
							<textarea name="action" id="" cols="20" rows="10" class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<input type="hidden" name="goals_id" id="goals_id" value="<?= $goal->id ?>" class="form-control" required>
						</div>
						<input type="hidden" name="coachee_id">
					</div>
					<div class="modal-footer">
						<button class="btn btn-success" type="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editCriteria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Peserta</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="<?= site_url('coachee/update-criteria') ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="action">Success Criteria</label>
							<input name="criteria" id="" type='text' class="form-control" required value="<?= $criteria->criteria ?>">
						</div>
						<div class="form-group">
							<input type="hidden" name="criteria_id" value="<?= $criteria->id ?>" class="form-control" required>
							<input type="hidden" name="goals_id" value="<?= $criteria->goals_id ?>" class="form-control" required>
						</div>
						<input type="hidden" name="coachee_id">
					</div>
					<div class="modal-footer">
						<button class="btn btn-success" type="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php $this->load->view('layouts/script'); ?>
	<script>
		function endGoal(link) {
			Swal.fire({
				title: 'Apakah Anda Menyelesaikan Goal Ini',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya'
			}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire(
						'Berhasil!',
						'Berhasil Menyelesaikan Goal',
						'success'
					);
					window.location.replace(link)
				}
			})
		}
		s
	</script>

	<?php if ($this->session->flashdata('criteria') == 'berhasil') : ?>
		<script>
			Swal.fire(
				'Berhasil',
				'Berhasil Menambahkan Criteria',
				'success'
			)
		</script>
	<?php endif ?>

	<?php if ($this->session->flashdata('action_plan') == 'berhasil') : ?>
		<script>
			Swal.fire(
				'Berhasil',
				'Berhasil Menambahkan Action Plan',
				'success'
			)
		</script>
	<?php endif ?>

	<?php if ($this->session->flashdata('criteria') == 'update') : ?>
		<script>
			Swal.fire(
				'Berhasil',
				'Berhasil Mengupdate Success Criteria',
				'success'
			)
		</script>
	<?php endif ?>
</body>

</html>