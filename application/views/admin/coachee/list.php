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
					<h1 class="h3 mb-4 text-gray-800">Peserta <?= $company->name ?></h1>

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Table Peserta <?= $company->name ?></h6>
							<a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#addCoachee">Tambah Peserta</a>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>email</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($coachees as $coachee) : ?>
											<tr>
												<td><?php echo $i++ ?></td>
												<td> <?= $coachee->name ?> </td>
												<td><?= $coachee->email ?></td>
												<td>
													<a href="<?= site_url('admin/coachee/edit/') . $coachee->id ?>" class="btn btn-primary">edit Data</a>
													<button onclick=" confirmDelete('<?= site_url('admin/coachee/delete/') . $coachee->id ?>')" class="btn btn-danger">Hapus Peserta</button>
													<a href="<?= site_url('admin/coachee/goal/list/') . $coachee->id ?>" class="btn btn-primary">Lihat Goal</a>
													<a href="<?= site_url('admin/coachee/session/list/') . $coachee->id ?>" class="btn btn-primary">Lihat Sesi</a>
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


	<div class="modal fade" id="addCoachee" tabindex="-1" role="dialog" aria-labelledby="addCoachee" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addCoachee">Tambah Peserta</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="<?= site_url('admin/coachee/save') ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="name">Nama</label>
							<input type="text" name="name" id="name" class="form-control">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="email" id="email" class="form-control">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="password" id="password" class="form-control">
						</div>
						<div class="form-group">
							<label for="">Coach</label>
							<select name="coach_id" id="" class="form-control">
								<?php foreach ($coaches as $coach) : ?>
									<option value="<?= $coach->id ?>"><?= $coach->name ?></option>
								<?php endforeach ?>
							</select>
							<input type="hidden" name="company_id" value="<?= $company->id ?>">
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" type="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php $this->load->view('layouts/script'); ?>

	<?php if ($this->session->flashdata('coachee')) : ?>
		<script>
			Swal.fire(
				'Berhasil',
				'<?= $this->session->flashdata('coachee') ?>',
				'success'
			)
		</script>
	<?php endif ?>

	<script>
		function confirmDelete(link) {
			Swal.fire({
				title: 'Apakah Anda Ingin Menghapus Coachee',
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
