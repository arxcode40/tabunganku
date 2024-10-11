<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<footer class="border-top bg-body-tertiary shadow">
	<div class="container py-3">
		<div class="align-items-md-center d-flex flex-column flex-md-row justify-content-md-between">
			<div class="align-items-center d-flex mb-2 mb-md-0">
				<img alt="Logo <?= html_escape($settings['application_name']) ?>" loading="lazy" src="/favicon.svg" width="24">
				<h5 class="mb-0 ms-2"><?= html_escape($settings['application_name']) ?></h5>
			</div>
			<p class="mb-0">Copyright &copy; <?= mdate('%Y') ?> <?= html_escape($settings['application_name']) ?>. All Rights Reserved.</p>
		</div>
	</div>
</footer>