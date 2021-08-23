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
					<h1 class="h3 mb-4 text-gray-800">Coacha</h1>

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Table Goals <?= $coachee->name ?></h6>
							<a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#addCompany">Tambah Goals</a>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>No</th>
											<th>Goals</th>
											<th>Due Date</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($goals as $goal) : ?>
											<tr>
												<td><?php echo $i++ ?></td>
												<td> <?= $goal->goal ?> </td>
												<?php if ($goal->status == 'selesai') : ?>
													<td><button class="btn btn-success disabled">Selesai</button></td>
												<?php else : ?>
													<td><button class="btn btn-primary disabled">Belum Selesai</button></td>
												<?php endif ?>
												<td> <?= $goal->due_date ?> </td>
												<td>
													<a href="<?= site_url('admin/coachee/goal/show/') . $goal->id ?>" class="btn btn-primary">Lihat Goal</a>
													<a href="<?= site_url('admin/coachee/goal/delete/') . $goal->id ?>" class="btn btn-danger">Delete Goal</a>
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
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="<?= site_url('login') ?>">Logout</a>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="addCompany" tabindex="-1" role="dialog" aria-labelledby="addCompany" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addGoal">Tambah Goal</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="<?= site_url('admin/coachee/goal/save') ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="name">Goal</label>
							<textarea name="goal" id="" cols="30" rows="5" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label for="name">Due Date</label>
							<input type="date" name="due_date" class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" type="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php $this->load->view('layouts/script'); ?>
</body>

</html>
