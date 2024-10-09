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
								'name' => 'Data transaksi',
								'url' => '/transaksi/'
							),
							array(
								'icon' => 'person-standing',
								'name' => $member['name'],
								'url' => '/transaksi/' . $member['id'] . '/'
							),
							array(
								'icon' => 'plus-lg',
								'name' => 'Tambah data transaksi'
							)
						)
					)
				)
			?>

			<?=
				form_open(
					uri_string(),
					array(
						'class' => 'card shadow',
						'data-aos' => 'fade-up',
						'data-aos-delay' => 100
					)
				)
			?>
				<div class="align-items-center card-header d-flex">
					<h5 class="mb-0 me-auto">
						<i class="bi bi-plus-lg"></i>
						Tambah data transaksi
					</h5>
					<a class="btn btn-secondary btn-sm shadow" href="/transaksi/<?= $member['id'] ?>/">
						<i class="bi bi-arrow-left"></i>
						<span class="d-none d-sm-inline">Kembali</span>
					</a>
				</div>

				<div class="card-body">
					<div class="gx-3 mb-3 row">
						<label class="col-md-4 col-lg-3 col-form-label d-md-flex" for="id">
							Kode transaksi<b class="text-danger">*</b>
							<span class="d-none d-md-block fw-medium ms-auto">:</span>
						</label>
						<div class="col-md-8 col-lg-9">
							<input class="form-control" disabled="disabled" id="id" type="text" value="<?= html_escape($last_id) ?>" />
						</div>
					</div>
					<div class="gx-3 mb-3 row">
						<label class="col-md-4 col-lg-3 col-form-label d-md-flex" for="name">
							Nama anggota<b class="text-danger">*</b>
							<span class="d-none d-md-block fw-medium ms-auto">:</span>
						</label>
						<div class="col-md-8 col-lg-9">
							<input class="form-control" disabled="disabled" id="name" type="text" value="<?= html_escape($member['name']) ?>" />
						</div>
					</div>
					<div class="gx-3 mb-3 row">
						<label class="col-md-4 col-lg-3 col-form-label d-md-flex" for="date">
							Tanggal transaksi<b class="text-danger">*</b>
							<span class="d-none d-md-block fw-medium ms-auto">:</span>
						</label>
						<div class="col-md-8 col-lg-9">
							<input autofocus="autofocus" class="form-control <?= form_error('date') === '' ? '' : 'is-invalid' ?>" id="date" name="date" type="date" value="<?= html_escape(set_value('date', mdate('%Y-%m-%d'))) ?>" />
							<?= form_error('date', '<div class="invalid-feedback">', '</div>') ?>
						</div>
					</div>
					<div class="gx-3 mb-3 row">
						<label class="col-md-4 col-lg-3 col-form-label d-md-flex" for="deposit">
							Nominal pemasukan<b class="text-danger">*</b>
							<span class="d-none d-md-block fw-medium ms-auto">:</span>
						</label>
						<div class="col-md-8 col-lg-9">
							<div class="has-validation input-group">
								<span class="input-group-text">Rp</span>
								<input class="form-control <?= form_error('deposit') === '' ? '' : 'is-invalid' ?>" id="deposit" inputmode="numeric" name="deposit" oninput="currencyFormat();" type="text" value="<?= html_escape(set_value('deposit', 0)) ?>" />
								<?= form_error('deposit', '<div class="invalid-feedback">', '</div>') ?>
							</div>
						</div>
					</div>
					<div class="gx-3 row">
						<label class="col-md-4 col-lg-3 col-form-label d-md-flex" for="withdraw">
							Nominal pengeluaran<b class="text-danger">*</b>
							<span class="d-none d-md-block fw-medium ms-auto">:</span>
						</label>
						<div class="col-md-8 col-lg-9">
							<div class="has-validation input-group">
								<span class="input-group-text">Rp</span>
								<input class="form-control <?= form_error('withdraw') === '' ? '' : 'is-invalid' ?>" id="withdraw" inputmode="numeric" name="withdraw" oninput="currencyFormat();" type="text" value="<?= html_escape(set_value('withdraw', 0)) ?>" />
								<?= form_error('withdraw', '<div class="invalid-feedback">', '</div>') ?>
							</div>
						</div>
					</div>
				</div>

				<div class="card-footer">
					<button class="btn btn-primary shadow" type="submit">
						<i class="bi bi-plus-lg"></i>
						Tambah
					</button>
					<button class="btn btn-secondary shadow" type="reset">
						<i class="bi bi-x-lg"></i>
						Reset
					</button>
				</div>
			<?= form_close() ?>
		</div>
	</main>
	<?php $this->layout->include('components/scrolltop') ?>
	<?php $this->layout->include('layouts/footer') ?>
<?php $this->layout->end_section() ?>