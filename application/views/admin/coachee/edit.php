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
							<a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#addCoach">Tambah Coach</a>
						</div>
						<div class="card-body">
							<form action="<?= site_url('admin/coachee/update') ?>" method="POST">
								<div class="modal-body">
									<div class="form-group">
										<label for="name">nama</label>
										<input type="hidden" name="id" id="id" class="form-control" value="<?= $coachee->id ?>">
										<input type="text" name="name" id="name" class="form-control" value="<?= $coachee->name ?>">
									</div>
									<div class="form-group">
										<label for="email">email</label>
										<input type="email" name="email" id="email" class="form-control" value="<?= $coachee->email ?>">
									</div>
									<div class="form-group">
										<label for="password">password</label>
										<input type="password" name="password" id="password" class="form-control" value="<?= $coachee->password ?>">
									</div>
									<div class="form-group">
										<label for="">Coach</label>
										<select name="coach_id" id="" class="form-control">
											<?php foreach ($coaches as $coach) : ?>
												<option value="<?= $coach->id ?>" <?php if ($coachee->coach_id == $coach->id) { ?> selected <?php } ?>><?= $coach->name ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="form-group">
										<label for="">Perusahaan</label>
										<select name="company_id" id="" class="form-control">
											<?php foreach ($companies as $company) : ?>
												<option value="<?= $company->id ?>" <?php if ($coachee->company_id == $company->id) { ?> selected <?php } ?>><?= $company->name ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="modal-footer">
									<button class="btn btn-primary" type="submit">Submit</button>
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
					<a class="btn btn-primary" href="<?= site_url('login') ?>">Logout</a>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="addCoach" tabindex="-1" role="dialog" aria-labelledby="addCoach" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addCoach">Tambah Peserta</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>

			</div>
		</div>
	</div>
	<?php $this->load->view('layouts/script'); ?>
</body>

</html>
