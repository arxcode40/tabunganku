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
								<?php foreach ($transactions as $index => $transaction): ?>
									<tr class="align-middle">
										<th class="text-start" scope="row"><?= $index + 1 ?></th>
										<td><?= html_escape($transaction['id']) ?></td>
										<td><?= html_escape($transaction['name']) ?></td>
										<td>Rp<?= html_escape(number_format($transaction['deposit'], 0, ',', '.')) ?></td>
										<td>Rp<?= html_escape(number_format($transaction['withdraw'], 0, ',', '.')) ?></td>
										<td>Rp<?= html_escape(number_format($transaction['total'], 0, ',', '.')) ?></td>
										<td class="text-nowrap">
											<a class="btn btn-primary btn-sm shadow" href="/transaksi/detail/<?= html_escape($transaction['id']) ?>/">
												<i class="bi bi-eye"></i>
												<span class="d-none d-sm-inline">Rincian</span>
											</a>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</main>
	<?php $this->layout->include('components/scrolltop') ?>
	<?php $this->layout->include('layouts/footer') ?>
<?php $this->layout->end_section() ?>