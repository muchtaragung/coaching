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

					<div class="row">
						<div class="col-xl-4 col-md-8 col-sm-12 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
												<h4>
													Jumlah Perusahaan
												</h4>
											</div>

											<div class="h6 mb-0 font-weight-bold text-gray-800">Jumlah Perusahaan : <?= $company ?></div>
											<a href="<?= site_url('admin/company/list') ?>" class="btn btn-primary btn-icon-split float-right">
												<span class="icon text-white-50">
													<i class="fas fa-table"></i>
												</span>
												<span class="text">Lihat Perusahaan</span>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-4 col-md-8 col-sm-12 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
												<h4>
													Jumlah Coach
												</h4>
											</div>

											<div class="h6 mb-0 font-weight-bold text-gray-800">Jumlah Coach : <?= $coach ?></div>
											<a href="<?= site_url('admin/coach/list') ?>" class="btn btn-primary btn-icon-split float-right">
												<span class="icon text-white-50">
													<i class="fas fa-table"></i>
												</span>
												<span class="text">Lihat Coach</span>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-4 col-md-8 col-sm-12 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
												<h4>
													Jumlah Peserta
												</h4>
											</div>

											<div class="h6 mb-0 font-weight-bold text-gray-800">Jumlah Peserta : <?= $coachee ?></div>
											<a href="<?= site_url('admin/company/list') ?>" class="btn btn-primary btn-icon-split float-right">
												<span class="icon text-white-50">
													<i class="fas fa-table"></i>
												</span>
												<span class="text">Lihat Perusahaan Untuk Melihat Peserta</span>
											</a>
										</div>
									</div>
								</div>
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
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
					<a class="btn btn-primary" href="login.html">Logout</a>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="addCoachee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Peserta</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="<?= site_url('admin/addcoachee') ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="name">nama</label>
							<input type="text" name="name" id="name" class="form-control">
						</div>
						<div class="form-group">
							<label for="email">email</label>
							<input type="email" name="email" id="email" class="form-control">
						</div>
						<div class="form-group">
							<label for="password">password</label>
							<input type="password" name="password" id="password" class="form-control">
						</div>
						<div class="form-group">
							<label for="coach">coach</label>
							<select name="coach" id="" class="form-control">
								<?php foreach ($coaches as $coach) : ?>
									<option value="<?= $coach->id ?>"><?= $coach->name ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php $this->load->view('layouts/script'); ?>
</body>

</html>