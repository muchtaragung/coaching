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
					<h1 class="h3 mb-4 text-gray-800">List Peserta</h1>

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Table Peserta</h6>
							<?php if ($this->session->flashdata('error') != null) { ?>
								<div class="alert alert-danger" role="alert">
									<?php echo $this->session->flashdata('error'); ?>
								</div>
							<?php } ?>
							<a href="" class="btn btn-success float-right" data-toggle="modal" data-target="#addCoachee">Tambah Peserta</a>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Peserta</th>
											<th>Email</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($coachee as $coachee) : ?>
											<tr>
												<td><?php echo $i++ ?></td>
												<td> <?= $coachee->name ?> </td>
												<td><?= $coachee->email ?></td>
												<td>
													<a href="<?= site_url('coach/coachee/show/') . $coachee->id ?>" class="btn btn-primary">Detail Coachee</a>
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


	<div class="modal fade" id="addCoachee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Peserta</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="<?= site_url('coach/addcoachee') ?>" method="POST">
					<input type="hidden" name="id" value="<?php echo $this->uri->segment('4') ?>">
					<div class="modal-body">
						<div class="form-group">
							<label for="name">nama</label>
							<input type="text" name="name" required id="name" class="form-control">
						</div>
						<div class="form-group">
							<label for="email">email</label>
							<input type="email" name="email" required id="email" class="form-control">
						</div>
						<div class="form-group">
							<label for="password">password</label>
							<input type="password" name="password" required id="password" class="form-control">
						</div>
						<div class="form-group">
							<input type="hidden" name="company_id" value="<?= $company_id ?>">
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

	<?php if ($this->session->flashdata('add coach') == 'berhasil') : ?>
		<script>
			Swal.fire(
				'Berhasil',
				'Peserta Telah Di Tambahkan',
				'success'
			)
		</script>
	<?php endif ?>
</body>


</html>