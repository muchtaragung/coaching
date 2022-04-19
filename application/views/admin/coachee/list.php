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
							<?php if ($this->session->flashdata('error') != null) { ?>
								<div class="alert alert-danger" role="alert">
									<?php echo $this->session->flashdata('error'); ?>
								</div>
							<?php } ?>
							<a href="<?= site_url('pdf') ?>" class="">test pdf</a>
							<a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#addCoachee">Tambah Peserta</a>
							<a href="" class="btn btn-info float-right mr-2" data-toggle="modal" data-target="#uploadCsv">Upload CSV</a>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>id</th>
											<th>Nama</th>
											<th>email</th>
											<th>coach</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($coachees as $coachee) : ?>
											<tr>
												<td><?= $coachee->id ?></td>
												<td> <?= $coachee->name ?> </td>
												<td><?= $coachee->email ?></td>
												<td>
													<?php
													$coach = $this->db->where('id', $coachee->coach_id)->get('coach')->row();									
														echo $coach->name;
													?>
												</td>
												<td><?= $coachee->role ?></td>
												<td>
													<a href="<?= site_url('admin/coachee/detail/') . $coachee->id ?>" class="btn btn-primary">Detail Coachee</a>
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
						<input type="hidden" name="id" value="<?php echo $this->uri->segment('4') ?>">
						<div class="form-group">
							<label for="name">Nama</label>
							<input type="text" name="name" id="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="email" id="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="password" id="password" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="level">Level</label>
							<select name="level" id="level" class="form-control" required>
								<option value="manager">Manager</option>
								<option value="staff">Staff</option>
							</select>
						</div>
						<div class="form-group" id="coach_id">
							<label for="">Coach</label>
							<select name="coach_id" class="form-control select2">
								<?php foreach($coachKorpora as $value): ?>
									<option value="<?= $value->id ?>"><?= $value->name ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group d-none" id="manager_coach_id">
							<label for="">Manager</label>
							<select name="manager_coach_id" class="form-control select2">
								<option disabled selected value=""></option>
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

	<div class="modal fade" id="uploadCsv" tabindex="-1" role="dialog" aria-labelledby="uploadCsv" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="uploadCsv">Tambah Peserta</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="<?= site_url('admin/coachee/csv-save') ?>" method="POST" enctype="multipart/form-data">
					<div class="modal-body">
						<input type="hidden" name="id" value="<?php echo $this->uri->segment('4') ?>">

						<div class="form-group">
							<label for="">CSV</label>
							<input type="file" name="csv" required accept=".csv">
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
	<script>
		$(document).ready(function() {
			$("#select2").select2({
				dropdownParent: $("#addCoachee")
			});
		});
	</script>
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
		$('#level').change(function(){
			if(this.value == 'staff'){
				$('#manager_coach_id').removeClass(`d-none`)
				$('#coach_id').addClass(`d-none`)
				
			}else{
				$('#coach_id').removeClass(`d-none`)
				$('#manager_coach_id').addClass('d-none');
			}
		})
	</script>
</body>

</html>