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
								'icon' => 'person-standing',
								'name' => 'Data anggota'
							)
						)
					)
				)
			?>

			<div class="card shadow" data-aos="fade-up" data-aos-delay="100">
				<div class="align-items-center card-header d-flex">
					<h5 class="mb-0 me-auto">
						<i class="bi bi-table"></i>
						Tabel anggota
					</h5>
					<div class="dropdown me-1">
						<button class="btn btn-secondary btn-sm dropdown-toggle shadow" data-bs-toggle="dropdown" type="button">
							<i class="bi bi-upload"></i>
							<span class="d-none d-sm-inline">Ekspor</span>
						</button>

						<ul class="dropdown-menu dropdown-menu-end">
							<li>
								<h6 class="dropdown-header">
									<i class="bi bi-upload"></i>
									Ekspor
								</h6>
							</li>
							<li>
								<button class="dropdown-item" onclick="tableToCSV('<?= html_escape($settings['application_name']) ?>', '<?= $title ?>', '<?= mdate('%Y%m%d%H%i%s') ?>');" type="button">
									<i class="bi bi-filetype-csv"></i>
									CSV
								</button>
							</li>
							<li>
								<button class="dropdown-item" onclick="tableToExcel('<?= html_escape($settings['application_name']) ?>', '<?= $title ?>', '<?= mdate('%Y%m%d%H%i%s') ?>');" type="button">
									<i class="bi bi-filetype-xlsx"></i>
									Excel
								</button>
							</li>
							<li>
								<button class="dropdown-item" onclick="tableToPDF('<?= html_escape($settings['application_name']) ?>', '<?= $title ?>', '<?= mdate('%Y%m%d%H%i%s') ?>');" type="button">
									<i class="bi bi-filetype-pdf"></i>
									PDF
								</button>
							</li>
							<li>
								<a class="dropdown-item" href="/anggota/laporan/" target="_blank">
									<i class="bi bi-printer-fill"></i>
									Cetak
								</a>
							</li>
						</ul>
					</div>
					<a class="btn btn-primary btn-sm shadow" href="/anggota/tambah/">
						<i class="bi bi-plus-lg"></i>
						<span class="d-none d-sm-inline">Tambah</span>
					</a>
				</div>

				<div class="card-body">
					<div class="table-responsive">
						<table class="align-middle mb-0 table table-bordered table-hover table-striped w-100" id="dataTable">
							<thead>
								<tr class="align-middle">
									<th class="text-start" scope="col">#</th>
									<th scope="col">Kode</th>
									<th scope="col">Nama</th>
									<th scope="col">Jenis kelamin</th>
									<th scope="col">Email</th>
									<th class="text-start" scope="col">No. telp</th>
									<th scope="col">Aksi</th>
								</tr>
							</thead>

							<tbody class="table-group-divider">
								<?php foreach ($members as $index => $member): ?>
									<tr class="align-middle">
										<th class="text-start" scope="row"><?= $index + 1 ?></th>
										<td><?= html_escape($member['id']) ?></td>
										<td><?= html_escape($member['name']) ?></td>
										<td><?= html_escape($member['gender']) ?></td>
										<td><?= html_escape($member['email']) ?></td>
										<td class="text-start"><?= html_escape($member['tel']) ?></td>
										<td class="text-nowrap">
											<a class="btn btn-primary btn-sm shadow" href="/anggota/ubah/<?= html_escape($member['id']) ?>/">
												<i class="bi bi-pencil-square"></i>
												<span class="d-none d-sm-inline">Ubah</span>
											</a>
											<?=
												form_open(
													"anggota/hapus/",
													array('class' => 'd-inline-block'),
													array('id' => html_escape($member['id']))
												)
											?>
												<button class="btn btn-danger btn-sm shadow" type="submit">
													<i class="bi bi-trash-fill"></i>
													<span class="d-none d-sm-inline">Hapus</span>
												</button>
											<?= form_close() ?>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div hidden="hidden">
			<div class="container py-3 text-body-emphasis" data-bs-theme="light" id="reportPage">
				<h4 class="mb-0 text-center">Laporan <?= html_escape($settings['application_name']) ?></h4>
				<h4 class="mb-3 text-center"><?= $title ?></h4>

				<table class="align-middle mb-0 table table-borderless table-printed table-sm w-100" id="reportTable">
					<thead>
						<tr class="align-middle table-dark">
							<th class="text-start" scope="col">#</th>
							<th scope="col">Kode</th>
							<th scope="col">Nama</th>
							<th scope="col">Jenis kelamin</th>
							<th scope="col">Email</th>
							<th class="text-start" scope="col">No. telp</th>
							<th scope="col">Alamat</th>
						</tr>
					</thead>

					<tbody class="table-group-divider">
						<?php foreach ($members as $index => $member): ?>
							<tr class="align-middle">
								<th class="text-start" scope="row"><?= $index + 1 ?></th>
								<td><?= html_escape($member['id']) ?></td>
								<td><?= html_escape($member['name']) ?></td>
								<td><?= html_escape($member['gender']) ?></td>
								<td><?= html_escape($member['email']) ?></td>
								<td class="text-start"><?= html_escape($member['tel']) ?></td>
								<td><?= html_escape($member['address']) ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</main>
	<?php $this->layout->include('components/scrolltop') ?>
	<?php $this->layout->include('layouts/footer') ?>
<?php $this->layout->end_section() ?>