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

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Table Perusahaan</h6>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Perusahaan</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($companies as $company) : ?>
											<tr>
												<td><?php echo $i++ ?></td>
												<td> <?= $company->name ?> </td>
												<td>
													<a href="<?= site_url('coach/coachee/list/') . $company->id ?>" class="btn btn-info">Lihat Peserta</a>
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
