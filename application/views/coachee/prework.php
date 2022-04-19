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
                    <div class="container-fluid">
    
                        <!-- Page Heading -->
                        <div class="d-flex justify-content-between">
                            <div><h1 class="h3 mb-4 text-gray-800">List Prework</h1></div>
                            <div><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#submitTugas">Submit Tugas</button></div>
                            <div class="modal fade" id="submitTugas" tabindex="-1" aria-labelledby="submitTugasLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="<?= site_url('coacheecontroller/submitTugas') ?>" method="post">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="submitTugasLabel">Submit Tugas</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="company_id" value="<?= $user->company_id ?>">
                                                <div class="form-group">
                                                    <label for="files">Files</label>
                                                    <input type="file" name="files[]" class="form-control-file" id="files" multiple>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prework_id">Materi</label>
                                                    <select name="prework_id" id="prework_id">
                                                        <?php foreach($preworks as $prework): ?>
                                                            <option value="<?=$prework->id?>"><?= $prework->name ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" id="submitPrework">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar Materi</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table bordered datatable">
                                        <thead>
                                            <tr>
                                                <td>No</td>
                                                <td>Judul</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($preworks as $key => $prework): ?>
                                                <tr>
                                                    <td><?= $key+1 ?></td>
                                                    <td><?= $prework->name ?></td>
                                                    <td>
                                                        <a href="<?= site_url('coachee/prework/'. $prework->id) ?>" class="btn btn-primary">Lihat File</a>
                                                    </td>
                                                    
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
    
                    </div>
                        <!-- <div class="container-fluid">

                            <div class="mb-3">
                                Anda belum melakukan test silahkan test dulu di bawah ini
                            </div>

                            <a href="" class="btn btn-primary">Lakukan test</a>



                        </div> -->
                    
				<!-- Begin Page Content -->
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
        $('form').submit(function(){
            event.preventDefault();
            $('#submitPrework').html('Silahkan Tunggu..');
            const data = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                method: 'post',
                processData:false,
                async: false,
                contentType:false,
                cache:false,
                data,
                success: function (res){
                    // console.log(res);
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
</body>
</html>