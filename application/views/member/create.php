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
								'name' => 'Data anggota',
								'url' => '/anggota/'
							),
							array(
								'icon' => 'plus-lg',
								'name' => 'Tambah data anggota'
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
						Tambah data anggota
					</h5>
					<a class="btn btn-secondary btn-sm shadow" href="/anggota/">
						<i class="bi bi-arrow-left"></i>
						<span class="d-none d-sm-inline">Kembali</span>
					</a>
				</div>

				<div class="card-body">
					<div class="mb-3 g-3 row">
						<label class="col-md-4 col-lg-3 col-form-label d-md-flex" for="id">
							Kode anggota<b class="text-danger">*</b>
							<span class="d-none d-md-block fw-medium ms-auto">:</span>
						</label>
						<div class="col-md-8 col-lg-9">
							<input class="form-control" disabled="disabled" id="id" type="text" value="<?= html_escape($last_id) ?>" />
						</div>
					</div>
					<div class="mb-3 g-3 row">
						<label class="col-md-4 col-lg-3 col-form-label d-md-flex" for="name">
							Nama anggota<b class="text-danger">*</b>
							<span class="d-none d-md-block fw-medium ms-auto">:</span>
						</label>
						<div class="col-md-8 col-lg-9">
							<input autofocus="autofocus" class="form-control <?= form_error('name') === '' ? '' : 'is-invalid' ?>" id="name" name="name" placeholder="Masukkan nama anggota" type="text" value="<?= html_escape(set_value('name')) ?>" />
							<?= form_error('name', '<div class="invalid-feedback">', '</div>') ?>
						</div>
					</div>
					<fieldset class="mb-3 g-3 row">
						<legend class="col-md-4 col-lg-3 col-form-label d-md-flex pt-0">
							Jenis kelamin<b class="text-danger">*</b>
							<span class="d-none d-md-block fw-medium ms-auto">:</span>
						</legend>
						<div class="col-md-8 col-lg-9">
							<div class="form-check form-check-inline">
								<input class="form-check-input <?= form_error('gender') === '' ? '' : 'is-invalid' ?>" <?= set_radio('gender', 'Laki-laki', TRUE) ?> id="male" name="gender" type="radio" value="Laki-laki" />
								<label class="form-check-label" for="male">Laki-laki</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input <?= form_error('gender') === '' ? '' : 'is-invalid' ?>" <?= set_radio('gender', 'Perempuan') ?> id="female" name="gender" type="radio" value="Perempuan" />
								<label class="form-check-label" for="female">Perempuan</label>
							</div>
							<?= form_error('gender', '<div class="invalid-feedback">', '</div>') ?>
						</div>
					</fieldset>
					<div class="mb-3 g-3 row">
						<label class="col-md-4 col-lg-3 col-form-label d-md-flex" for="email">
							Email anggota<b class="text-danger">*</b>
							<span class="d-none d-md-block fw-medium ms-auto">:</span>
						</label>
						<div class="col-md-8 col-lg-9">
							<input class="form-control <?= form_error('email') === '' ? '' : 'is-invalid' ?>" id="email" name="email" placeholder="Masukkan email anggota" type="email" value="<?= html_escape(set_value('email')) ?>" />
							<?= form_error('email', '<div class="invalid-feedback">', '</div>') ?>
						</div>
					</div>
					<div class="mb-3 g-3 row">
						<label class="col-md-4 col-lg-3 col-form-label d-md-flex" for="tel">
							Nomor telepon<b class="text-danger">*</b>
							<span class="d-none d-md-block fw-medium ms-auto">:</span>
						</label>
						<div class="col-md-8 col-lg-9">
							<input class="form-control <?= form_error('tel') === '' ? '' : 'is-invalid' ?>" id="tel" name="tel" placeholder="Masukkan nomor telepon" type="tel" value="<?= html_escape(set_value('tel')) ?>" />
							<?= form_error('tel', '<div class="invalid-feedback">', '</div>') ?>
						</div>
					</div>
					<div class="g-3 row">
						<label class="col-md-4 col-lg-3 col-form-label d-md-flex" for="address">
							Alamat anggota
							<span class="d-none d-md-block fw-medium ms-auto">:</span>
						</label>
						<div class="col-md-8 col-lg-9">
							<textarea class="form-control <?= form_error('address') === '' ? '' : 'is-invalid' ?>" id="address" name="address" placeholder="Masukkan alamat anggota"><?= html_escape(set_value('address')) ?></textarea>
							<?= form_error('address', '<div class="invalid-feedback">', '</div>') ?>
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