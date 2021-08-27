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
					<h1 class="h3 mb-4 text-gray-800">Goal : <?= $goal->goal ?></h1>
					<h1 class="h3 mb-4 text-gray-800">Status : <?= $goal->status ?></h1>
					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<?php if (!isset($criteria)) : ?>
								<form action="<?= site_url('admin/coachee/criteria/save') ?>" method="POST">
									<input type="hidden" name="goals_id" id="goals_id" value="<?= $goal->id ?>" class="form-control">
									<div class="row form-group">
										<div class="col-lg-12">
											<label for="criteria">Success Criteria</label>
										</div>
										<div class="col-lg-10">
											<input type="hidden" name="goals_id" value="<?= $goal->id ?>">
											<input type="text" name="criteria" id="" class="form-control" placeholder="success criteria" required>
										</div>
										<div class="col-lg-2">
											<button type="submit" class="btn btn-success form-control">Save</button>
										</div>
									</div>
								</form>
							<?php else : ?>
								<form action="<?= site_url('admin/coachee/criteria/update') ?>" method="POST">
									<input type="hidden" name="goals_id" id="goals_id" value="<?= $goal->id ?>" class="form-control">
									<div class="row form-group">
										<div class="col-lg-12">
											<label for="criteria">Success Criteria</label>
										</div>
										<div class="col-lg-10">
											<input type="hidden" name="id" value="<?= $criteria->id ?>">
											<input type="hidden" name="goals_id" value="<?= $criteria->goals_id ?>">
											<input type="text" name="criteria" id="" class="form-control" placeholder="success criteria" value="<?= $criteria->criteria ?>">
										</div>
										<div class="col-lg-1">
											<button type="submit" class="btn btn-primary">Update</button>
										</div>
										<div class="col-lg-1">
											<a onclick=" confirmDelete('<?= site_url('admin/coachee/criteria/delete/' . $criteria->id . '/' . $goal->id) ?>','criteria')" class="btn btn-danger">Hapus</a>
										</div>
									</div>
								</form>
							<?php endif ?>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th rowspan="2">No</th>
											<th rowspan="2">Action Plans</th>
											<th colspan="3">Result</th>
											<th rowspan="2">Action</th>
										</tr>
										<tr>
											<th>Berhasil</th>
											<th>Tidak Berhasil</th>
											<th>Butuh Waktu Lama</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1 ?>
										<?php foreach ($actions as $action) : ?>
											<tr>
												<td><?= $i++ ?></td>
												<td><?= $action->action ?></td>
												<td><?php if ($action->result == 'berhasil') { ?> <h2>✓</h2> <?php } ?></td>
												<td> <?php if ($action->result == 'tidak berhasil') { ?> <h2>✓</h2> <?php } ?></td>
												<td> <?php if ($action->result == 'butuh waktu lama') { ?> <h2>✓</h2> <?php } ?></td>
												<td>
													<button onclick=" confirmReset('<?= site_url('admin/coachee/action/reset/') . $action->id . '/' . $goal->id ?>')" class="btn btn-danger">Hapus</button>
													<button onclick=" confirmDelete('<?= site_url('admin/coachee/notes/delete/' . $note->id . '/' . $goal->id) ?>', 'delete')" class="btn btn-danger">Hapus</button>


												</td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<?php foreach ($notes as $note) : ?>
						<div class="row mb-3">
							<div class="col-lg-5">
								<div class="card border-left-primary shadow h-100 py-2">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
													Komentar</div>
												<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $note->comment ?></div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-5">
								<div class="card">
									<div class="card border-left-success shadow h-100 py-2">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Result</div>
													<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $note->result ?></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-2">
								<div class="card border-left-seccondary shadow h-100 py-2">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Action</div>
												<div class="h5 mb-0 font-weight-bold">
													<button onclick=" confirmDelete('<?= site_url('admin/coachee/notes/delete/' . $note->id . '/' . $goal->id) ?>', 'notes')" class="btn btn-danger">Hapus</button>
													<a href="<?= site_url('admin/coachee/notes/edit/' . $note->id) ?>" class="btn btn-primary w-100 my-1">Edit</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach ?>
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
<?php if ($this->session->flashdata('criteria')) : ?>
	<script>
		Swal.fire(
			'Berhasil',
			'<?= $this->session->flashdata('criteria') ?>',
			'success'
		)
	</script>
<?php endif ?>

<?php if ($this->session->flashdata('action')) : ?>
	<script>
		Swal.fire(
			'Berhasil',
			'<?= $this->session->flashdata('action') ?>',
			'success'
		)
	</script>
<?php endif ?>

<?php if ($this->session->flashdata('notes')) : ?>
	<script>
		Swal.fire(
			'Berhasil',
			'<?= $this->session->flashdata('notes') ?>',
			'success'
		)
	</script>
<?php endif ?>

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

</html>
