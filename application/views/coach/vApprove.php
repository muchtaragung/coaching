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
                    <div>
                        <h3 class="text-dark">Approve Tugas</h3>
                    </div>
                    <div class="card">
                        <div class="card-header text-primary font-weight-bold">
                            Approve Tugas
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Nama</td>
                                            <td>Email</td>
                                            <td>Files</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($coachee as $key => $value): ?>
                                            <tr>
                                                <td><?= $key+1 ?></td>
                                                <td><?= $value->name ?></td>
                                                <td><?= $value->email ?></td>
                                                <td><a href="<?= site_url('coach/tugas/' . $value->id) ?>" class="btn btn-primary">Show File</a></td>
                                                <td>
													<button type="button" class="btn btn-success" onclick="confirmApprove()">Approve</button>
													<!-- <a href="<?= site_url('coach/tugas/' . $value->id . '/approve') ?>" class="btn btn-success">Approve</a> -->
												</td>
                                            </tr>
                                        <?php endforeach; ?>
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

		confirmApprove = function (){
			Swal.fire({
			title: 'Apakan anda yakin untuk menyetujui file ini?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = '<?= site_url('coach/tugas/' . $value->id . '/approve') ?>';
				}
			})
		}
    </script>
</body>


</html>