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
							<h6 class="m-0 font-weight-bold text-primary">Table Coach</h6>
						</div>
						<div class="card-body">
							<form action="<?= site_url('admin/coach/update') ?>" method="POST">
								<div class="modal-body">
									<div class="form-group">
										<label for="name">nama</label>
										<input type="hidden" name="id" id="id" class="form-control" value="<?= $coach->id ?>">
										<input type="text" name="name" id="name" class="form-control" value="<?= $coach->name ?>" required>
									</div>
									<div class="form-group">
										<label for="email">email</label>
										<input type="email" name="email" id="email" class="form-control" value="<?= $coach->email ?>" required>
									</div>
									<div class="form-group">
										<label for="password">password</label>
										<input type="password" name="password" id="password" class="form-control">
										<input type="hidden" name="old_password" value="<?= $coach->password ?>">
									</div>
								</div>
								<div class="modal-footer">
									<button class="btn btn-secondary" type="submit">Submit</button>
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
</body>

</html>
