<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
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
					<?php if ($penilaian_sesi[0]['komunikasi'] == '1') { ?> buruk <?php } ?>
					<?php if ($penilaian_sesi[0]['komunikasi'] == '2') { ?> sedikit buruk <?php } ?>
					<?php if ($penilaian_sesi[0]['komunikasi'] == '3') { ?> cukup <?php } ?>
					<?php if ($penilaian_sesi[0]['komunikasi'] == '4') { ?> cukup baik <?php } ?>
					<?php if ($penilaian_sesi[0]['komunikasi'] == '5') { ?> baik <?php } ?>
				</td>
			</tr>
			<tr>
				<td>Kehadiran Setiap Sesi </td>
				<td>:</td>
				<td>
					<?php if ($penilaian_sesi[0]['kehadiran'] == '1') { ?> buruk <?php } ?>
					<?php if ($penilaian_sesi[0]['kehadiran'] == '2') { ?> sedikit buruk <?php } ?>
					<?php if ($penilaian_sesi[0]['kehadiran'] == '3') { ?> cukup <?php } ?>
					<?php if ($penilaian_sesi[0]['kehadiran'] == '4') { ?> cukup baik <?php } ?>
					<?php if ($penilaian_sesi[0]['kehadiran'] == '5') { ?> baik <?php } ?>
				</td>
			</tr>
			<tr>
				<td>Effort Proses Coaching </td>
				<td>:</td>
				<td>
					<?php if ($penilaian_sesi[0]['effort'] == '1') { ?> buruk <?php } ?>
					<?php if ($penilaian_sesi[0]['effort'] == '2') { ?> sedikit buruk <?php } ?>
					<?php if ($penilaian_sesi[0]['effort'] == '3') { ?> cukup <?php } ?>
					<?php if ($penilaian_sesi[0]['effort'] == '4') { ?> cukup baik <?php } ?>
					<?php if ($penilaian_sesi[0]['effort'] == '5') { ?> baik <?php } ?>
				</td>
			</tr>
			<tr>
				<td>Komitment Melakukan Action Plan</td>
				<td>:</td>
				<td>
					<?php if ($penilaian_sesi[0]['komitment'] == '1') { ?> buruk <?php } ?>
					<?php if ($penilaian_sesi[0]['komitment'] == '2') { ?> sedikit buruk <?php } ?>
					<?php if ($penilaian_sesi[0]['komitment'] == '3') { ?> cukup <?php } ?>
					<?php if ($penilaian_sesi[0]['komitment'] == '4') { ?> cukup baik <?php } ?>
					<?php if ($penilaian_sesi[0]['komitment'] == '5') { ?> baik <?php } ?>
				</td>
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
		</div>

		<table border="1">
			<tr>
				<th rowspan="2">Action Plan</th>
				<th colspan="3">Result</th>
			</tr>
			<tr>
				<th>Berhasil</th>
				<th>Tidak Berhasil</th>
				<th>Butuh Waktu Lama</th>
			</tr>

			<?php for ($j = 0; $j < count($action_plan); $j++) : ?>
				<tr>
					<td><?= $action_plan[$i][$j]['action'] ?></td>
					<td><?php if ($action_plan[$i][$j]['result'] == 'berhasil') {
							echo "Berhasil";
						} ?></td>
					<td> <?php if ($action_plan[$i][$j]['result'] == 'tidak berhasil') {
								echo "Tidak Berhasil";
							} ?></td>
					<td> <?php if ($action_plan[$i][$j]['result'] == 'butuh waktu lama') {
								echo "Butuh Waktu Lama";
							} ?></td>
				</tr>
			<?php endfor ?>
		</table>

		<br>

		<table border="1">
			<tr>
				<th>Komentar</th>
				<th>Result</th>
			</tr>
			<?php for ($j = 0; $j < count($notes); $j++) : ?>
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
	<?php endfor ?>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>

</html>
