<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
		<div class="sidebar-brand-icon ">
			<i class="fas fa-building"></i>
		</div>
		<div class="sidebar-brand-text mx-3">Program Coaching</div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<?php if ($this->session->userdata('login') == 'admin') : ?>
		<!-- Nav Item - Dashboard -->
		<li class="nav-item">
			<a class="nav-link" href="<?= site_url('admin') ?>">
				<i class="fas fa-fw fa-tachometer-alt"></i>
				<span>Dashboard</span></a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="<?= site_url('admin/coach/list') ?>">
				<i class="fas fa-fw fa-table"></i>
				<span>List Coach</span></a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="<?= site_url('admin/company/list') ?>">
				<i class="fas fa-fw fa-table"></i>
				<span>List Company</span></a>
		</li>

	<?php elseif ($this->session->userdata('login') == 'coach') : ?>

		<!-- Nav Item - Dashboard -->
		<li class="nav-item">
			<a class="nav-link" href="<?= site_url('coach') ?>">
				<i class="fas fa-table"></i>
				<span>List Perusahaan</span></a>
		</li>
		<?php $perusahaan = $this->db->get('company')->result(); ?>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				<i class="fas fa-building"></i>
				<span>Perusahaan</span>
			</a>
			<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
				<div class="bg-white py-2 collapse-inner rounded">
					<h6 class="collapse-header">List Perusahaan:</h6>
					<?php foreach ($perusahaan as $p) : ?>
						<a class="collapse-item" href="<?= site_url('/coach/coachee/list/' . $p->id) ?>"><?= $p->name ?></a>
					<?php endforeach ?>
				</div>
			</div>
		</li>

	<?php elseif ($this->session->userdata('login') == 'coachee') : ?>

		<!-- Nav Item - Dashboard -->
		<li class="nav-item">
			<a class="nav-link" href="<?= site_url('coachee') ?>">
				<i class="fas fa-table"></i>
				<span>Sesi Anda</span></a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="<?= site_url('coachee/goals') ?>">
				<i class="fas fa-table"></i>
				<span>Goals Anda</span></a>
		</li>

	<?php endif ?>


	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>