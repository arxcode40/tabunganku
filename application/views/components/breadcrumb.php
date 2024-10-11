<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<nav class="mb-3">
	<ol class="bg-body-tertiary breadcrumb p-3 rounded shadow" data-aos="fade-right">
		<?php foreach ($items as $item): ?>
			<?php if (isset($item['url']) === FALSE): ?>
				<li class="active breadcrumb-item">
					<i class="bi bi-<?= $item['icon'] ?>"></i>
					<?= $item['name'] ?>
				</li>
			<?php else: ?>
				<li class="breadcrumb-item">
					<a class="link-underline link-underline-opacity-0" href="<?= $item['url'] ?>">
						<i class="bi bi-<?= $item['icon'] ?>"></i>
						<?= $item['name'] ?>
					</a>
				</li>
			<?php endif ?>
		<?php endforeach ?>
	</ol>
</nav>