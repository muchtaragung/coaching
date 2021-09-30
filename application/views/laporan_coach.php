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

		<h4>Penilaian Sesi :</h4>
		<table class="table text-left">
			<tr>
				<td>Komunikasi Dan Respon</td>
				<td>:</td>
				<td>
					<?php if ($penilaian_sesi['komunikasi'] == '1') { ?> 1 <?php } ?>
					<?php if ($penilaian_sesi['komunikasi'] == '2') { ?> 2 <?php } ?>
					<?php if ($penilaian_sesi['komunikasi'] == '3') { ?> 3 <?php } ?>
					<?php if ($penilaian_sesi['komunikasi'] == '4') { ?> 4 <?php } ?>
					<?php if ($penilaian_sesi['komunikasi'] == '5') { ?> 5 <?php } ?>
				</td>
			</tr>
			<tr>
				<td>Kehadiran Setiap Sesi </td>
				<td>:</td>
				<td>
					<?php if ($penilaian_sesi['kehadiran'] == '1') { ?> 1 <?php } ?>
					<?php if ($penilaian_sesi['kehadiran'] == '2') { ?> 2 <?php } ?>
					<?php if ($penilaian_sesi['kehadiran'] == '3') { ?> 3 <?php } ?>
					<?php if ($penilaian_sesi['kehadiran'] == '4') { ?> 4 <?php } ?>
					<?php if ($penilaian_sesi['kehadiran'] == '5') { ?> 5 <?php } ?>
				</td>
			</tr>
			<tr>
				<td>Effort Proses Coaching </td>
				<td>:</td>
				<td>
					<?php if ($penilaian_sesi['effort'] == '1') { ?> 1 <?php } ?>
					<?php if ($penilaian_sesi['effort'] == '2') { ?> 2 <?php } ?>
					<?php if ($penilaian_sesi['effort'] == '3') { ?> 3 <?php } ?>
					<?php if ($penilaian_sesi['effort'] == '4') { ?> 4 <?php } ?>
					<?php if ($penilaian_sesi['effort'] == '5') { ?> 5 <?php } ?>
				</td>
			</tr>
			<tr>
				<td>Komitment Melakukan Action Plan</td>
				<td>:</td>
				<td>
					<?php if ($penilaian_sesi['komitment'] == '1') { ?> 1 <?php } ?>
					<?php if ($penilaian_sesi['komitment'] == '2') { ?> 2 <?php } ?>
					<?php if ($penilaian_sesi['komitment'] == '3') { ?> 3 <?php } ?>
					<?php if ($penilaian_sesi['komitment'] == '4') { ?> 4 <?php } ?>
					<?php if ($penilaian_sesi['komitment'] == '5') { ?> 5 <?php } ?>
				</td>
			</tr>
		</table>

		<h4>Rangkuman Penilaian :</h4>
		<p><?= $penilaian_sesi['keterangan'] ?></p>
	</div>

	<br>
	<hr>


	<?php for ($i = 0; $i < count($goals); $i++) : ?>
		<div style="page-break-before: always;">
			<h2>Goals</h2>
			<div class="row d-flex">
				<h4 class="float-left">Goal : <?= $goals[$i]['goal'] ?></h4>
				<h4 class="float-right">Due Date : <?= $goals[$i]['due_date'] ?></h4>
				<h4>Success Criteria : <?= $success_criteria[$i][0]['criteria'] ?></h4>
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

			<br>

			<table border="1">
				<tr>
					<th>Komentar</th>
					<th>Result</th>
				</tr>
				<?php for ($j = 0; $j < count($notes[$i]); $j++) : ?>
					<tr>
						<td><?= $notes[$i][$j]['comment'] ?></td>
						<td><?= $notes[$i][$j]['result'] ?></td>
					</tr>
				<?php endfor ?>
			</table>

			<h4>Milestone</h4>
			<table>
				<tr>
					<td>Milestone</td>
					<td>:</td>
					<td><?= $milestone[$i][0]['milestone'] ?></td>
				</tr>
				<tr>
					<td>Keterangan</td>
					<td>:</td>
					<td><?= $milestone[$i][0]['keterangan'] ?></td>
				</tr>
			</table>
		</div>
	<?php endfor ?>
</body>

</html>