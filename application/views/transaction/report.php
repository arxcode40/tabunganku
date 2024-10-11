<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<?php $this->layout->extend('layouts/template') ?>

<?php $this->layout->section('content') ?>
	<main class="flex-grow-1">
		<div class="container py-3 text-body-emphasis">
			<h4 class="mb-0 text-center">Laporan <?= html_escape($settings['application_name']) ?></h4>
			<h4 class="mb-3 text-center"><?= str_replace('Laporan ', '', $title) ?></h4>
			<table class="align-middle border-black mb-0 table table-bordered table-sm w-100">
				<thead>
					<tr class="align-middle table-dark">
						<th class="text-start" scope="col">#</th>
						<th scope="col">Kode</th>
						<th scope="col">Tanggal</th>
						<th scope="col">Pemasukan</th>
						<th scope="col">Pengeluaran</th>
					</tr>
				</thead>
				<tbody class="table-group-divider">
					<?php $deposit = $withdraw = 0 ?>
					<?php foreach ($transactions as $index => $transaction): ?>
						<tr class="align-middle">
							<th class="text-start" scope="row"><?= $index + 1 ?></th>
							<td><?= html_escape($transaction['id']) ?></td>
							<td><?= html_escape(nice_date($transaction['date'], 'd M Y')) ?></td>
							<td>Rp<?= html_escape(number_format($transaction['deposit'], 0, ',', '.')) ?></td>
							<?php $deposit += $transaction['deposit'] ?>
							<td>Rp<?= html_escape(number_format($transaction['withdraw'], 0, ',', '.')) ?></td>
							<?php $withdraw += $transaction['withdraw'] ?>
						</tr>
					<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr class="align-middle table-dark">
						<td class="text-end" colspan="3">Total</td>
						<td>
							<strong>Rp<?= html_escape(number_format($deposit, 0, ',', '.')) ?></strong>
						</td>
						<td>
							<strong>Rp<?= html_escape(number_format($withdraw, 0, ',', '.')) ?></strong>
						</td>
					</tr>
					<tr class="align-middle table-dark">
						<td class="text-end" colspan="3">Jumlah</td>
						<td colspan="2">
							<strong>Rp<?= html_escape(number_format($deposit - $withdraw, 0, ',', '.')) ?></strong>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</main>
<?php $this->layout->end_section() ?>

<script>
	window.print();
</script>