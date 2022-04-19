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
					<div class="d-flex justify-content-between">
                    </div>
					<!-- DataTales Example -->
					<h1>List File</h1>
                    <?php foreach($files as $key => $file): ?>
                        <a href="<?= base_url($file->path) ?>" class="btn btn-primary">File <?= $key+1 ?></a>
                    <?php endforeach; ?>

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
</body>
</html>