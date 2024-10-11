<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<?php $alert = $this->session->flashdata('alert') ?>
<?php if (isset($alert)): ?>
	<div class="alert alert-<?= $alert['status'] ?> alert-dismissible fade shadow show">
		<i class="bi bi-<?= $alert['icon'] ?>-circle-fill"></i>
		<span class="ms-2"><?= $alert['text'] ?></span>
		<button class="btn-close" data-bs-dismiss="alert" type="button"></button>
	</div>
<?php endif ?>