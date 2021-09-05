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
							<h6 class="m-0 font-weight-bold text-primary">Table Goals <?= $coachee->name ?></h6>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>id</th>
											<th>Goals</th>
											<th>Due Date</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($goals as $goal) : ?>
											<tr>
												<td><?= $goal->id ?></td>
												<td> <?= $goal->goal ?> </td>
												<?php if ($goal->status == 'selesai') : ?>
													<td><button class="btn btn-success disabled">Selesai</button></td>
												<?php else : ?>
													<td><button class="btn btn-primary disabled">Belum Selesai</button></td>
												<?php endif ?>
												<td> <?= $goal->due_date ?> </td>
												<td>
													<a href="<?= site_url('admin/coachee/goal/show/') . $goal->id ?>" class="btn btn-primary">Lihat Goal</a>
													<a href="<?= site_url('admin/coachee/milestone/detail/') . $goal->id ?>" class="btn btn-primary">Detail Milestone</a>
													<a href="<?= site_url('admin/coachee/goal/edit/') . $goal->id ?>" class="btn btn-primary">Edit Goal</a>
													<a href="<?= site_url('admin/coachee/goal/delete/') . $goal->id ?>" class="btn btn-danger">Delete Goal</a>
													<button onclick=" confirmDelete('<?= site_url('admin/coachee/goal/delete/') . $goal->id ?>')" class="btn btn-danger">Hapus Goal</button>
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

	<?php if ($this->session->flashdata('goal')) : ?>
		<script>
			Swal.fire(
				'Berhasil',
				'<?= $this->session->flashdata('goal') ?>',
				'success'
			)
		</script>
	<?php endif ?>

	<script>
		function confirmDelete(link) {
			Swal.fire({
				title: 'Apakah Anda Ingin Menghapus Goal',
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
</body>

</html>