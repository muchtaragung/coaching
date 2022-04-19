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
							<h6 class="m-0 font-weight-bold text-primary">Table Perusahaan</h6>
							<a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#addCompany">Tambah Perusahaan</a>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>id</th>
											<th>Nama</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($companies as $key => $company) : ?>
											<tr>
												<td><?= $company->id ?></td>
												<td> <?= $company->name ?> </td>
												<td>
													<a href="<?= site_url('admin/company/edit/') . $company->id ?>" class="btn btn-primary">edit Perusahaan</a>
													<button onclick=" confirmDelete('<?= site_url('admin/company/delete/') . $company->id ?>')" class="btn btn-danger">Hapus Perusahaan</button>
													<a href="<?= site_url('admin/coachee/list/') . $company->id ?>" class="btn btn-primary">Lihat Peserta</a>
													<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPrework<?= $key ?>">Tambah Materi/Prework</button>
													<a href="<?= site_url('admin/company/tugas/' . $company->id) ?>" class="btn btn-success">Lihat Tugas</a>
												</td>
											</tr>
											<div class="modal fade" id="addPrework<?= $key ?>" tabindex="-1" aria-labelledby="addPreworkLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<form action="<?= site_url('admincontroller/preworkstore') ?>" method="post">
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
																	<input type="text" name="name" id="name" class="form-control" required>
																</div>
																<div id="file-wrapper">
																	<div class="form-group">
																		<label for="">File</label>
																		<input type="file" class="form-control-file" name="files[]" id="files" multiple required>
																	</div>
																</div>
																<div class="form-group">
																	<label for="">To</label>
																	<select name="to" id="" required>
																		<option value="all">Semua</option>
																		<option value="manager" selected>Manager</option>
																		<option value="staff">Staff</option>
																	</select>
																</div>
															</div>
															<div class="modal-footer">
																<button type="submit" class="btn btn-success" id="submitPrework">Submit</button>
															</div>
														</form>
													</div>
												</div>
											</div>
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

	<div class="modal fade" id="addCompany" tabindex="-1" role="dialog" aria-labelledby="addCompany" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addCompany">Tambah Perusahaan</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="<?= site_url('admin/company/save') ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="name">Nama Perusahaan</label>
							<input type="text" name="name" id="name" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" type="submit" id="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php $this->load->view('layouts/script'); ?>
	<?php if ($this->session->flashdata('company')) : ?>
		<script>
			Swal.fire(
				'Berhasil',
				'<?= $this->session->flashdata('company') ?>',
				'success'
			)
		</script>
	<?php endif ?>

	<script>
		$('form').submit(function(){
            event.preventDefault();
            const data = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
				beforeSend: function(){
					$('#submit').html('Silahkan Tunggu..');
				},
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
		
		function confirmDelete(link) {
			Swal.fire({
				title: 'Apakah Anda Ingin Menghapus Perusahaan',
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