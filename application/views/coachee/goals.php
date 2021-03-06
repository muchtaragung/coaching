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
					<h1 class="h3 mb-4 text-gray-800">List Goals</h1>

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Table Goals</h6>
							<a href="" class="btn btn-success float-right" data-toggle="modal" data-target="#addGoal">Tambah Goals</a>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>No</th>
											<th>Goals</th>
											<th>Status</th>
											<th>Due Date</th>
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
													<a href="<?= site_url('coachee/goal/') . $goal->id ?>" class="btn btn-primary">Detail Goal</a>
													<a href="<?= site_url('coachee/goal/edit/') . $goal->id ?>" class="btn btn-info">Edit</a>
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
					<h5 class="modal-title" id="exampleModalLabel">Tambah Goals</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">??</span>
					</button>
				</div>
				<form action="<?= site_url('coachee/addgoal') ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="goal">Goals</label>
							<textarea name="goal" id="" cols="30" rows="10" class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label for="due_date">due date</label>
							<input type="date" name="due_date" id="due_date" class="form-control" required>
						</div>
						<input type="hidden" name="students_id" value="<?= $this->session->userdata('id'); ?>">
					</div>
					<div class="modal-footer">
						<button class="btn btn-success" type="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php $this->load->view('layouts/script'); ?>
</body>

</html>