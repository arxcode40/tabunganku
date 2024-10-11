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
								'icon' => 'person-fill',
								'name' => 'Profil saya'
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
					<i class="bi bi-person-fill"></i>
					Profil saya
				</h5>
				<div class="card-body">
					<div class="gx-3 mb-3 row">
						<label class="col-md-4 col-lg-3 col-form-label d-md-flex" for="username">
							Nama pengguna<b class="text-danger">*</b>
							<span class="d-none d-md-block fw-medium ms-auto">:</span>
						</label>
						<div class="col-md-8 col-lg-9">
							<input autocapitalize="off" autocomplete="username" autofocus="autofocus" class="form-control <?= form_error('username') === '' ? '' : 'is-invalid' ?>" id="username" name="username" placeholder="Masukkan nama pengguna" type="text" value="<?= html_escape(set_value('username', $profile['username'])) ?>" />
							<?= form_error('username', '<div class="invalid-feedback">', '</div>') ?>
						</div>
					</div>
					<div class="gx-3 mb-3 row">
						<label class="col-md-4 col-lg-3 col-form-label d-md-flex" for="currentPassword">
							Kata sandi saat ini
							<span class="d-none d-md-block fw-medium ms-auto">:</span>
						</label>
						<div class="col-md-8 col-lg-9">
							<div class="has-validation input-group">
								<input autocomplete="current-password" class="form-control <?= form_error('current_password') === '' ? '' : 'is-invalid' ?>" id="currentPassword" name="current_password" placeholder="Masukkan kata sandi saat ini" type="password" />
								<button class="btn btn-secondary" onclick="showPassword();" tabindex="-1" type="button">
									<i class="bi bi-eye-slash pe-none"></i>
								</button>
								<?= form_error('current_password', '<div class="invalid-feedback">', '</div>') ?>
							</div>
						</div>
					</div>
					<div class="gx-3 mb-3 row">
						<label class="col-md-4 col-lg-3 col-form-label d-md-flex" for="newPassword">
							Kata sandi baru
							<span class="d-none d-md-block fw-medium ms-auto">:</span>
						</label>
						<div class="col-md-8 col-lg-9">
							<div class="has-validation input-group">
								<input autocomplete="new-password" class="form-control <?= form_error('new_password') === '' ? '' : 'is-invalid' ?>" id="newPassword" name="new_password" placeholder="Masukkan kata sandi baru" type="password" />
								<button class="btn btn-secondary" onclick="showPassword();" tabindex="-1" type="button">
									<i class="bi bi-eye-slash pe-none"></i>
								</button>
								<?= form_error('new_password', '<div class="invalid-feedback">', '</div>') ?>
							</div>
						</div>
					</div>
					<div class="gx-3 row">
						<label class="col-md-4 col-lg-3 col-form-label d-md-flex" for="confirmPassword">
							Konfirmasi kata sandi baru
							<span class="d-none d-md-block fw-medium ms-auto">:</span>
						</label>
						<div class="col-md-8 col-lg-9">
							<div class="has-validation input-group">
								<input autocomplete="new-password" class="form-control <?= form_error('confirm_password') === '' ? '' : 'is-invalid' ?>" id="confirmPassword" name="confirm_password" placeholder="Masukkan konfirmasi kata sandi baru" type="password" />
								<button class="btn btn-secondary" onclick="showPassword();" tabindex="-1" type="button">
									<i class="bi bi-eye-slash pe-none"></i>
								</button>
								<?= form_error('confirm_password', '<div class="invalid-feedback">', '</div>') ?>
							</div>
						</div>
					</div>
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