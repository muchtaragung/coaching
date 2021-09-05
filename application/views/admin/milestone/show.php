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
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800">Data Hasil Penilaian Milestone</h1>
					</div>

					<div class="row">

						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-5 col-md-8 col-sm-12 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
												<h4>
													Data Hasil Penilaian Sesi
												</h4>
											</div>
											<?php if (!isset($milestone)) : ?>
												<div class="h5 mb-0 font-weight-bold text-gray-800">Penilaian Milestone Belum Tersedia</div>
											<?php else : ?>
												<table class="">
													<tr class="h5 mb-0 text-gray-800">
														<td class="font-weight-bold">
															Hasil Milestone
														</td>
														<td>:</td>
														<td><?= $milestone->milestone ?></td>
													</tr>
												</table>
												<br>
												<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $milestone->keterangan ?></div>
												<button onclick="confirmDelete('<?= site_url('admin/coachee/milestone/delete/' . $milestone->id . '/' . $milestone->goals_id) ?>','Penilaian')" class="btn btn-danger">
													Hapus Milestone
												</button>
											<?php endif ?>
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

	<?php $this->load->view('layouts/script'); ?>
	<script>
		function confirmDelete(link, category) {
			Swal.fire({
				title: 'Apakah Anda Ingin Menghapus ' + category,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.replace(link)
				}
			})
		}
	</script>

	<?php if ($this->session->flashdata('milestone')) : ?>
		<script>
			Swal.fire(
				'Berhasil',
				'<?= $this->session->flashdata('milestone') ?>',
				'success'
			)
		</script>
	<?php endif ?>
</body>


</html>