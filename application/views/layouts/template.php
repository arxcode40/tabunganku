<!doctype html>
<html data-bs-theme="<?= $settings['application_theme'] ?>" lang="id">
<head>
	<?php $this->layout->include('layouts/meta') ?>

	<base href="<?= base_url() ?>" />

	<link href="favicon.svg" rel="apple-touch-icon">
	<link href="favicon.svg" rel="icon shortcut" type="image/x-icon">
	<title><?= $title ?> | <?= $settings['application_name'] ?></title>

	<?php $this->layout->include('layouts/assets/css') ?>
</head>
<body class="bg-body-secondary d-flex flex-column min-dvh-100">
	<?php $this->layout->render_section('content') ?>
	<?php $this->layout->include('layouts/assets/js') ?>
</body>
</html>