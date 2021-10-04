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
					<h1 class="h3 mb-4 text-gray-800">Edit Goal</h1>

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Edit Goals</h6>
						</div>
						<div class="card-body">
							<form action="<?= site_url('coach/coachee/goal/update') ?>" method="POST">
								<div class="form-group">
									<input type="hidden" name="id" value="<?= $goal->id ?>">
									<input type="hidden" name='coachee_id' value="<?= $goal->coachee_id ?>">
								</div>
								<div class="form-group">
									<label for="">Goal</label>
									<textarea name="goal" id="" cols="30" rows="3" class="form-control" required><?= $goal->goal ?></textarea>
								</div>
								<div class="form-group">
									<label for="">Due Date</label>
									<input type="date" name="due_date" value="<?= $goal->due_date ?>" class="form-control" required>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-success float-right">Submit</button>
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

	</div>
	<?php $this->load->view('layouts/script'); ?>
</body>

</