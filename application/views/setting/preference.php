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
								'icon' => 'gear-fill',
								'name' => 'Pengaturan'
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
				<h5 class="card-header">
					<i class="bi bi-gear-fill"></i>
					Pengaturan
				</h5>

				<div class="card-body">
					<div class="gx-3 mb-3 row">
						<label class="col-md-4 col-lg-3 col-form-label d-md-flex" for="applicationName">
							Nama aplikasi<b class="text-danger">*</b>
							<span class="d-none d-md-block fw-medium ms-auto">:</span>
						</label>
						<div class="col-md-8 col-lg-9">
							<input autofocus="autofocus" class="form-control <?= form_error('application_name') === '' ? '' : 'is-invalid' ?>" id="applicationName" name="application_name" placeholder="Masukkan nama pengguna" type="text" value="<?= html_escape(set_value('application_name', $settings['application_name'])) ?>" />
							<?= form_error('application_name', '<div class="invalid-feedback">', '</div>') ?>
						</div>
					</div>
					<fieldset class="gx-3 row">
						<legend class="col-md-4 col-lg-3 col-form-label d-md-flex pt-0">
							Tema aplikasi<b class="text-danger">*</b>
							<span class="d-none d-md-block fw-medium ms-auto">:</span>
						</legend>
						<div class="col-md-8 col-lg-9">
							<div class="form-check">
								<input class="form-check-input <?= form_error('application_theme') === '' ? '' : 'is-invalid' ?>" <?= set_radio('application_theme', 'light', html_escape($settings['application_theme']) === 'light') ?> id="lightTheme" name="application_theme" type="radio" value="light" />
								<label class="form-check-label" for="lightTheme">Tema terang</label>
							</div>
							<div class="form-check">
								<input class="form-check-input <?= form_error('application_theme') === '' ? '' : 'is-invalid' ?>" <?= set_radio('application_theme', 'dark', html_escape($settings['application_theme']) === 'dark') ?> id="darkTheme" name="application_theme" type="radio" value="dark" />
								<label class="form-check-label" for="darkTheme">Tema gelap</label>
							</div>
							<?= form_error('application_theme', '<div class="invalid-feedback">', '</div>') ?>
						</div>
					</fieldset>
				</div>

				<div class="card-footer">
					<button class="btn btn-primary shadow" type="submit">
						<i class="bi bi-floppy-fill"></i>
						Simpan
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
