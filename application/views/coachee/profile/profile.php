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
					<?php if ($this->session->flashdata('pro') != null) { ?>
						<div class="alert alert-success" role="alert">
							<?php echo $this->session->flashdata('pro'); ?>
						</div>
					<?php } ?>
					<?php if ($this->session->flashdata('error') != null) { ?>
						<div class="alert alert-danger" role="alert">
							<?php echo $this->session->flashdata('error'); ?>
						</div>
					<?php } ?>
					<!-- Page Heading -->
					<h1 class="h3 mb-4 text-gray-800">Profile</h1>

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Ubah Password</h6>
							<!-- <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#addCompany">Tambah Goals</a> -->
						</div>
						<div class="card-body">
							<form action="<?= site_url('coachee/profile/update') ?>" method="post">
								<!-- <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"> -->
								<div class="form-group">
									<label for="">Password Lama </label>
									<input type="password" name="password" class="form-control" id="" placeholder="Masukan Password Lama" required>
									<?php
									echo form_error('password');
									?>
								</div>
								<div class="form-group">
									<label for="">Password Baru</label>
									<input type="password" name="password_baru" class="form-control" id="" placeholder="Masukan Password Baru" required>
									<?php
									echo form_error('password');
									?>
								</div>
								<div class="form-group">
									<label for="">Konfirmasi Password</label>
									<input type="password" name="repassword" class="form-control" id="" placeholder="Konfirmasi Password Baru" required>
									<?php
									echo form_error('repassword');
									?>
								</div>

								<button type="submit" class="btn btn-primary">Update</button>

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