<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
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
				<i class="fas fa-fw fa-tachometer-alt"></i>
				<span>Dashboard</span></a>
		</li>

	<?php elseif ($this->session->userdata('login') == 'coachee') : ?>

		<!-- Nav Item - Dashboard -->
		<li class="nav-item">
			<a class="nav-link" href="<?= site_url('coachee') ?>">
				<i class="fas fa-fw fa-tachometer-alt"></i>
				<span>Dashboard</span></a>
		</li>

	<?php endif ?>


	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>