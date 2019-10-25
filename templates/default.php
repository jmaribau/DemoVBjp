
<?= implode(' > ', $breadcrumb) . PHP_EOL;?>

Name / Created / Directory
--------------------------
<?php foreach($list as $item): ?>
<?= PHP_EOL. implode (' / ', $item) ?>
<?php endforeach;?>

<?=PHP_EOL.PHP_EOL?>
