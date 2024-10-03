<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!doctype html>
<html data-bs-theme="light" lang="id">
<head>
	<meta charset="utf-8" />
	<meta content="initial-scale=1.0, width=device-width" name="viewport" />
	<meta content="ie=edge" http-equiv="X-UA-Compatible" />
	<meta content="light" name="color-scheme" />
	<meta content="#0d6efd" name="theme-color" />

	<link href="/favicon.svg" rel="icon shortcut" type="image/x-icon">
	<link href="/favicon.svg" rel="apple-touch-icon">
	<title><?= $status_code ?> | <?= preg_replace('/(<p>|<\/p>)/', '', $message) ?></title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-body-secondary container-fluid d-flex flex-column min-vh-100 py-3">
	<div class="hstack gap-3 m-auto">		
		<h1 class="mb-0"><?= $status_code ?></h1>
		<div class="vr"></div>
		<h1 class="mb-0"><?= preg_replace('/(<p>|<\/p>)/', '', $message) ?></h1>
	</div>
</body>
</html>