<?php $alert = $this->session->flashdata('alert') ?>
<?php if (isset($alert)): ?>
	<div class="alert alert-<?= html_escape($alert['status']) ?> alert-dismissible fade shadow show">
		<i class="bi bi-<?= html_escape($alert['icon']) ?>-circle-fill"></i>
		<span class="ms-2"><?= html_escape($alert['text']) ?></span>
		<button class="btn-close" data-bs-dismiss="alert" type="button"></button>
	</div>
<?php endif ?>