<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('layouts/head'); ?>
</head>

<body id="page-top">
	<div class="modal fade" id="addPrework" tabindex="-1" aria-labelledby="addPreworkLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="<?= site_url('coachcontroller/preworkstore') ?>" method="post">
					<input type="hidden" name="company_id" value="<?= $company->id ?>">
					<div class="modal-header">
						<h5 class="modal-title" id="addPreworkLabel">Prework</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="name">Judul</label>
							<input type="text" name="name" id="name" class="form-control">
						</div>
						<div id="file-wrapper">
							<div class="form-group">
								<label for="">File</label>
								<input type="file" class="form-control-file" name="files[]" id="files" multiple>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success" id="submitPrework">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
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
					<h1 class="h3 mb-4 text-gray-800">List Peserta <strong><?= $company->name ?></strong></h1>

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Table Peserta</h6>
							<?php if ($this->session->flashdata('error') != null) { ?>
								<div class="alert alert-danger" role="alert">
									<?php echo $this->session->flashdata('error'); ?>
								</div>
							<?php } ?>
							<button type="button" class="btn btn-primary float-right mx-1" data-toggle="modal" data-target="#addPrework">Tambah Materi/Prework</button>
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
								<?php if($this->session->userdata('switch')): ?>
										<option value="staff" selected disabled>Staff</option>
									<?php else: ?>
										<option value="manager">Manager</option>
										<option value="staff">Staff</option>
								<?php endif; ?>
							</select>
						</div>
						<?php if($this->session->userdata('switch')): ?>
							<div class="form-group" id="manager_coach_id">
								<label for="">Manager</label>
								<select name="manager_coach_id" class="form-control select2">
									<?php foreach ($coaches as $coach) : ?>
										<option value="<?= $coach->id ?>"><?= $coach->name ?></option>
									<?php endforeach ?>
								</select>
								<input type="hidden" name="company_id" value="<?= $company->id ?>">
							</div>
						<?php else: ?>
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
						<?php endif; ?>
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
	<?php if ($this->session->flashdata('success')) : ?>
		<script>
			Swal.fire(
				'Berhasil',
				'<?= $this->session->flashdata('success') ?>',
				'success'
			)
		</script>
	<?php endif ?>

	<script>
        // const appendFile = function () {
        //     $('#file-wrapper').append(`<div class="form-group">
        //                                     <label for="">File ${$('#file-wrapper .form-group').length + 1}</label>
        //                                     <input type="file" class="form-control-file" name="file" id="file">
        //                                 </div>`)
        // }

        // const deleteFile = function () {
        //     $('#file-wrapper .form-group')[$('#file-wrapper .form-group').length - 1].remove()
        // }

        $('form').submit(function(){
            event.preventDefault();
            $('#submitPrework').html('Silahkan Tunggu..');
            const data = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                method: 'post',
                processData:false,
                contentType:false,
                cache:false,
                data,
                success: function (res){
                    if(res){
                        location.reload();
                    }
                },
                error: function(){
                    Swal.fire('Server Error', '', 'error');
                }

            })
        })
    </script>
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