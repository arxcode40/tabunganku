<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<?php $this->layout->extend('layouts/template') ?>

<?php $this->layout->section('content') ?>
	<?php $this->layout->include('layouts/navbar') ?>
	<main class="flex-grow-1">
		<div class="container py-3">
			<?php $this->layout->include('components/alert') ?>

			<?php
			$this->layout->include(
				'components/breadcrumb',
					array(
						'items' => array(
							array(
								'icon' => 'house-door-fill',
								'name' => 'Beranda',
								'url' => '/'
							),
							array(
								'icon' => 'arrow-down-up',
								'name' => 'Data transaksi'
							)
						)
					)
				)
			?>

			<div class="card shadow" data-aos="fade-up" data-aos-delay="100">
				<div class="align-items-center card-header d-flex">
					<h5 class="mb-0 me-auto">
						<i class="bi bi-table"></i>
						Tabel transaksi
					</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="align-middle mb-0 table table-bordered table-hover table-striped w-100" id="dataTable">
							<thead>
								<tr class="align-middle">
									<th class="text-start" scope="col">#</th>
									<th scope="col">Kode</th>
									<th scope="col">Nama</th>
									<th scope="col">Pemasukan</th>
									<th scope="col">Pengeluaran</th>
									<th scope="col">Total</th>
									<th scope="col">Aksi</th>
								</tr>
							</thead>
							<tbody class="table-group-divider">
								<?php $deposit = $withdraw = $total = 0 ?>
								<?php foreach ($transactions as $index => $transaction): ?>
									<tr class="align-middle">
										<th class="text-start" scope="row"><?= $index + 1 ?></th>
										<td><?= html_escape($transaction['id']) ?></td>
										<td><?= html_escape($transaction['name']) ?></td>
										<td>Rp<?= html_escape(number_format($transaction['deposit'] ?? 0, 0, ',', '.')) ?></td>
										<?php $deposit += $transaction['deposit'] ?>
										<td>Rp<?= html_escape(number_format($transaction['withdraw'] ?? 0, 0, ',', '.')) ?></td>
										<?php $withdraw += $transaction['withdraw'] ?>
										<td>Rp<?= html_escape(number_format($transaction['total'] ?? 0, 0, ',', '.')) ?></td>
										<?php $total += $transaction['total'] ?>
										<td class="text-nowrap">
											<a class="btn btn-primary btn-sm shadow" href="/transaksi/<?= html_escape($transaction['id']) ?>/">
												<i class="bi bi-eye"></i>
												<span class="d-none d-sm-inline">Rincian</span>
											</a>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
							<tfoot>
								<tr class="align-middle">
									<td class="text-end" colspan="3">Jumlah</td>
									<td>
										<strong>Rp<?= html_escape(number_format($deposit, 0, ',', '.')) ?></strong>
									</td>
									<td>
										<strong>Rp<?= html_escape(number_format($withdraw, 0, ',', '.')) ?></strong>
									</td>
									<td>
										<strong>Rp<?= html_escape(number_format($total, 0, ',', '.')) ?></strong>
									</td>
									<td>&nbsp;</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</main>
	<?php $this->layout->include('components/scrolltop') ?>
	<?php $this->layout->include('layouts/footer') ?>
<?php $this->layout->end_section() ?>