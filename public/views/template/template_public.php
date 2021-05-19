<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Public</title>
	<link rel="stylesheet" href="/css/public-styles.css">
</head>
<body class="wrapper">
	<?php include __DIR__.'/../public/public_header.php';?>
	<main>
		<?php include __DIR__.'/../public/'.$content_view; ?>
	</main>
	<?php include __DIR__.'/../public/public_footer.php';?>
	<?php include __DIR__.'/../public/public_basket-popup.php';?>
</body>
<script src="../../js/libs/swiper.min.js"></script>
<script src="../../js/modules/slider.js"></script>
<script src="../../js/modules/popup-basket.js"></script>
</body>
</html>