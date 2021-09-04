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
					<h1 class="h3 mb-4 text-gray-800">Edit Milestone</h1>

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h4 class="m-0 font-weight-bold text-primary float-left">Edit Milestone</h4>
						</div>
						<div class="card-body">
							<form action="<?= site_url('admin/coachee/milestone/update') ?>" method="POST" class="text-center">
								<div class="form-group">
									<input type="hidden" name="milestone_id" value="<?= $milestone->id ?>">
									<input type="hidden" name="goals_id" value="<?= $milestone->goals_id ?>">
								</div>
								<div class="card my-4">
									<div class="card-header">
										<h6 class="m-0 font-weight-bold text-secondary">Hasil Milestone</h6>
									</div>
									<div class="card-body">
										<div class="row">
											<label for="" class="col">1</label>
											<label for="" class="col">2</label>
											<label for="" class="col">3</label>
											<label for="" class="col">4</label>
											<label for="" class="col">5</label>
											<label for="" class="col">6</label>
											<label for="" class="col">7</label>
											<label for="" class="col">8</label>
											<label for="" class="col">9</label>
											<label for="" class="col">10</label>
										</div>
										<div class="row">
											<input type="radio" name="milestone" value="1" class="col" <?php if ($milestone->milestone == '1') : ?> checked <?php endif ?> required>
											<input type="radio" name="milestone" value="2" class="col" <?php if ($milestone->milestone == '2') : ?> checked <?php endif ?> required>
											<input type="radio" name="milestone" value="3" class="col" <?php if ($milestone->milestone == '3') : ?> checked <?php endif ?> required>
											<input type="radio" name="milestone" value="4" class="col" <?php if ($milestone->milestone == '4') : ?> checked <?php endif ?> required>
											<input type="radio" name="milestone" value="5" class="col" <?php if ($milestone->milestone == '5') : ?> checked <?php endif ?> required>
											<input type="radio" name="milestone" value="6" class="col" <?php if ($milestone->milestone == '6') : ?> checked <?php endif ?> required>
											<input type="radio" name="milestone" value="7" class="col" <?php if ($milestone->milestone == '7') : ?> checked <?php endif ?> required>
											<input type="radio" name="milestone" value="8" class="col" <?php if ($milestone->milestone == '8') : ?> checked <?php endif ?> required>
											<input type="radio" name="milestone" value="9" class="col" <?php if ($milestone->milestone == '9') : ?> checked <?php endif ?> required>
											<input type="radio" name="milestone" value="10" class="col" <?php if ($milestone->milestone == '10') : ?> checked <?php endif ?> required>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label for="">Keterangan</label>
									<textarea name="keterangan" id="" cols="30" rows="10" class="form-control" required><?= $milestone->keterangan ?></textarea>
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