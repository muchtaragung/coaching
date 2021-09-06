<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<style>
		table {
			width: 100%;
			border-collapse: collapse;
		}
	</style>
</head>

<body style="font-family: DejaVu Serif;">
	<div class="row">
		<center>
			<h1>Laporan Coaching</h1>
		</center>

		<h4>Coachee : </h4>
		<table class="table text-left">
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><?= $coachee['name'] ?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td>:</td>
				<td><?= $coachee['email'] ?></td>
			</tr>
		</table>

		<h4>Coach : </h4>
		<table class="table text-left">
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><?= $coach['name'] ?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td>:</td>
				<td><?= $coach['email'] ?></td>
			</tr>
		</table>

		<h4>Sesi : </h4>
		<table class="table text-left">
			<tr>
				<td>Sesi Ke </td>
				<td>:</td>
				<td><?= $session['session'] ?></td>
			</tr>
			<tr>
				<td>Waktu Mulai</td>
				<td>:</td>
				<td><?= $session['start_time'] ?></td>
			</tr>
			<tr>
				<td>Waktu Selesai</td>
				<td>:</td>
				<td><?= $session['end_time'] ?></td>
			</tr>
		</table>


	</div>

	<br>
	<hr>
	<br>

	<div class="row">
		<h2>Goals</h2>
	</div>

	<?php for ($i = 0; $i < count($goals); $i++) : ?>
		<div class="row d-flex">
			<h4 class="float-left">Goal : <?= $goals[$i]['goal'] ?></h4>
			<h4 class="float-right">Due Date : <?= $goals[$i]['due_date'] ?></h4>
			<h4>Success Criteria : <?= $success_criteria[$i][0]['criteria'] ?></h4>
			<h4>Status Goal : <?= $goals[$i]['status'] ?></h4>
		</div>

		<table border="1">
			<tr>
				<th>Action Plan</th>
				<th>Result</th>
				<th>Keterangan</th>
			</tr>

			<?php
			for ($j = 0; $j < count($action_plan[$i]); $j++) : ?>
				<tr style="text-align: center;">
					<td><?= $action_plan[$i][$j]['action'] ?></td>
					<td>
						<?= $action_plan[$i][$j]['result'] ?>
					</td>
					<td><?= $action_plan[$i][$j]['keterangan'] ?></td>
				</tr>
			<?php endfor ?>
		</table>
		<br><br>
	<?php endfor ?>
</body>

</html>