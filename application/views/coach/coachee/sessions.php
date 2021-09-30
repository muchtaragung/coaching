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
					<h1 class="h3 mb-4 text-gray-800">List Sesi <strong><?= $coachee->name ?></strong></h1>

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary float-left">Sesi</h6>
							<?php if (isset($report_terakhir[0]) | $report_terakhir == 0) : ?>
								<button onclick="addSession('<?= site_url('coach/coachee/session/new/' . $coachee->id) ?>')" class="btn btn-success float-right	mx-1">Tambah Sesi</button>
							<?php endif ?>
							<a href="<?= site_url('coach/coachee/') . $coachee->id ?>" class="btn btn-primary float-right mx-1">Lihat Goals Peserta</a>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>No</th>
											<th>Sesi Ke</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($sessions as $session) : ?>
											<tr>
												<td><?php echo $i++ ?></td>
												<td> <?= 'Sesi Ke-' . $session->session ?> </td>
												<td>
													<?php if ($session->status == 'belum mulai') : ?>
														<a href="" class="btn btn-danger disabled">Belum Dimulai</a>
													<?php elseif ($session->status == 'belum selesai') : ?>
														<a href="" class="btn btn-primary disabled">Belum Selesai</a>
													<?php elseif ($session->status == 'selesai') : ?>
														<a href="" class="btn btn-success disabled">Selesai</a>
													<?php endif ?>
												</td>
												<td>
													<?php if ($session->status == 'belum mulai') : ?>
														<button onclick=" confirmStart('<?= site_url('coach/coachee/session/start/' . $session->id . '/' . $session->coachee_id) ?>')" class="btn btn-primary">Mulai Sesi</button>
													<?php elseif ($session->status == 'belum selesai') : ?>
														<button onclick=" confirmEnd('<?= site_url('coach/coachee/session/end/' . $session->id . '/' . $session->coachee_id) ?>')" class="btn btn-primary">Selesaikan Sesi</button>
													<?php elseif ($session->status == 'selesai') : ?>

														<!-- menggunakan db di view karena gue ga tau cara lain lagi... -->
														<?php $data_report = $this->db->where('session_id', $session->id)->get('report')->row(); ?>

														<!-- jika $data_report tidak null maka report tersedia & siap hanya menampilkan create report -->
														<?php if ($data_report != null) : ?>
															<a href="<?= site_url('coach/coachee/session/report/show/' . $session->id . '/' . $coachee->id) ?>" class="btn btn-success btn-icon-split">
																<span class="icon text-white-50">
																	<i class="fas fa-print"></i>
																</span>
																<span class="text">Laporan PDF</span>
															</a>
														<?php else : ?>
															<a href="<?= site_url('coach/coachee/session/show/' . $session->id . '/' . $session->coachee_id) ?>" class="btn btn-primary">Penilaian Dan Laporan</a>
														<?php endif ?>


													<?php endif ?>
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
	<script>
		function addSession(link) {
			Swal.fire({
				title: 'Apakah Anda Ingin Menambah Sesi',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya'
			}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire(
						'Berhasil!',
						'Berhasil Menambahkan Sesi',
						'success'
					);
					window.location.replace(link)
				}
			})
		}

		function confirmEnd(link) {
			Swal.fire({
				title: 'Apakah Anda Ingin Mengakhiri Sesi',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya'
			}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire(
						'Berhasil!',
						'Berhasil Mengakhiri Sesi',
						'success'
					);
					window.location.replace(link)
				}
			})
		}

		function confirmStart(link) {
			Swal.fire({
				title: 'Apakah Anda Ingin Memulai Sesi',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya'
			}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire(
						'Berhasil!',
						'Berhasil Memulai Sesi',
						'success'
					);
					window.location.replace(link)
				}
			})
		}
	</script>

	<?php if ($this->session->flashdata('penilaian') == 'save') : ?>
		<script>
			Swal.fire(
				'',
				'Sukses Menyimpan Penilaian',
				'success'
			)
		</script>
	<?php endif ?>

	<?php if ($this->session->flashdata('penilaian') == 'ada') : ?>
		<script>
			Swal.fire(
				'',
				'Penilaian Sudah Ada',
			)
		</script>
	<?php endif ?>

	<?php if ($this->session->flashdata('penilaian') == 'berhasil') : ?>
		<script>
			Swal.fire(
				'Berhasil',
				'Berhasil Memberikan Penilaian',
				'success'
			)
		</script>
	<?php endif ?>


</body>

</html>