<?php $this->layout->extend('layouts/template') ?>

<?php $this->layout->section('content') ?>
	<main class="my-auto">
		<div class="container-auth py-3">			
			<?=
				form_open(
					uri_string(),
					array(
						'class' => 'card shadow',
						'data-aos' => 'zoom-in'
					)
				)
			?>
				<div class="align-items-center card-header d-flex">
					<img alt="Logo <?= html_escape($settings['application_name']) ?>" loading="lazy" src="favicon.svg" width="24" />
					<h5 class="mb-0 ms-2"><?= html_escape($settings['application_name']) ?></h5>
				</div>
				
				<div class="card-body">
					<?php $this->layout->include('components/alert') ?>

					<div class="g-3 row">
						<div class="col-12">
							<label class="form-label" for="username">
								Nama pengguna<b class="text-danger">*</b>
							</label>
							<input autocapitalize="off" autocomplete="username" autofocus="autofocus" class="form-control <?= form_error('username') === '' ? '' : 'is-invalid' ?>" id="username" name="username" placeholder="Masukkan nama pengguna" type="text" value="<?= html_escape(set_value('username')) ?>" />
							<?= form_error('username', '<div class="invalid-feedback">', '</div>') ?>
						</div>

						<div class="col-12">
							<label class="form-label" for="password">
								Kata sandi<b class="text-danger">*</b>
							</label>
							<div class="has-validation input-group">
								<input autocomplete="current-password" class="form-control <?= form_error('password') === '' ? '' : 'is-invalid' ?>" id="password" name="password" placeholder="Masukkan kata sandi" type="password" />
								<button class="btn btn-secondary" onclick="showPassword();" tabindex="-1" type="button">
									<i class="bi bi-eye-slash pe-none"></i>
								</button>
								<?= form_error('password', '<div class="invalid-feedback">', '</div>') ?>
							</div>
						</div>
					</div>
				</div>

				<div class="card-footer">
					<button class="btn btn-primary shadow" type="submit">
						<i class="bi bi-box-arrow-in-right"></i>
						Masuk
					</button>
					<button class="btn btn-secondary shadow" type="reset">
						<i class="bi bi-x-lg"></i>
						Reset
					</button>
				</div>
			<?= form_close() ?>
		</div>
	</main>
<?php $this->layout->end_section() ?>