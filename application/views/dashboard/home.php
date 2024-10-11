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
								'icon' => 'speedometer',
								'name' => 'Dasbor'
							)
						)
					)
				)
			?>

			<div class="g-3 row">
				<div class="col-sm-6 col-md-4 col-lg-3">
					<div class="card shadow" data-aos="fade-up" data-aos-delay="50">
						<h5 class="card-header">
							<i class="bi bi-person-standing"></i>
							Data anggota
						</h5>
						<div class="card-body">
							<h1 class="mb-0"><?= $total_members ?></h1>
						</div>
						<div class="card-footer">
							<a class="btn btn-primary" href="/anggota/">
								Lihat selengkapnya
								<i class="bi bi-arrow-right"></i>
							</a>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-3">
					<div class="card shadow" data-aos="fade-up" data-aos-delay="100">
						<h5 class="card-header">
							<i class="bi bi-arrow-down-up"></i>
							Data transaksi
						</h5>
						<div class="card-body">
							<h1 class="mb-0"><?= $total_transactions ?></h1>
						</div>
						<div class="card-footer">
							<a class="btn btn-primary" href="/transaksi/">
								Lihat selengkapnya
								<i class="bi bi-arrow-right"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<?php $this->layout->include('components/scrolltop') ?>
	<?php $this->layout->include('layouts/footer') ?>
<?php $this->layout->end_section() ?>