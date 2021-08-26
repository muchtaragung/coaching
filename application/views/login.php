<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('layouts/head') ?>
</head>

<body class="bg-gradient-primary">

	<div class="container">

		<!-- Outer Row -->
		<div class="row justify-content-center">

			<div class="col-xl-10 col-lg-6 col-md-9">

				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-8 mx-auto">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">Silahkan Login</h1>
									</div>
									<?php if ($this->session->flashdata('regis') != null) { ?>
										<div class="alert alert-success" role="alert">
											<?php echo $this->session->flashdata('regis'); ?>
										</div>
									<?php } ?>
									<form action="<?php echo site_url('auth') ?>" method="post">
										<div class="form-group">
											<label for="email">Email</label>
											<input class="form-control" type="email" name="email" id="email" placeholder="masukan email" required>
										</div>
										<div class="form-group">
											<label for="password">Password</label>
											<input class="form-control" type="password" name="password" id="password" placeholder="masukan password" required>
										</div>
										<input class="form-control btn btn-primary" type="submit" value="masuk">
									</form>
									<hr>
									<div class="row">
										<p><a href="<?php echo site_url('auth/lupa_password') ?>">Lupa Password</a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

	<?php $this->load->view('layouts/script.php') ?>

	<?php if ($this->session->flashdata('login') == 'wrong') : ?>
		<script>
			Swal.fire(
				'ooopss...',
				'Email Atau Password Salah',
				'error'
			)
		</script>
	<?php endif ?>

	<?php if ($this->session->flashdata('login') == 'logout') : ?>
		<script>
			Swal.fire(
				'Sampai Jumpa',
				'Anda Telah Logout',
				'success'
			)
		</script>
	<?php endif ?>
</body>

</html>