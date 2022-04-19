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
					<h1 class="h3 mb-4 text-gray-800">Penilaian</h1>
					
					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">List Ranking</h6>
						</div>
						<div class="card-body">
							<table class="table table-borderless table-thead-bordered table-nowrap table-text-center table-align-middle card-table">
								<thead class="thead-light">
									<tr>
										<th>Rank</th>
										<th>Name</th>
										<th>Status</th>
										<th>Point</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($ranks as $key => $rank): ?>
										<tr>
											<?php if($key == 0): ?>
												<td><img src="https://img.icons8.com/color/50/000000/medal2--v1.png"/></td>
											<?php elseif($key == 1): ?>
												<td><img src="https://img.icons8.com/color/48/000000/medal-second-place--v1.png"/></td>
											<?php elseif($key == 2): ?>
												<td><img src="https://img.icons8.com/color/48/000000/medal2-third-place--v1.png"/></td>
											<?php else: ?>
												<td><?= $key+1 ?></td>
											<?php endif ?>
												<td><?= ucwords($rank->name) ?></td>
												<td><?= $rank->role ?></td>
												<td><?= $rank->total_nilai ?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
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
	<?php if ($this->session->flashdata('report') == 'belum ada') : ?>
		<script>
			Swal.fire(
				'',
				'Report belum Ada',
			)
		</script>
	<?php endif ?>
</body>

</html>