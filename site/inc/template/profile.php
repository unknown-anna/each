<!DOCTYPE html>
<html>
<head>
	<? include("parts/head.php"); ?>
	<link rel="stylesheet" href="/site/html/css/profile.css">
</head>

<body>

	<div class="custom_background">
		
	</div>

	<!-- header -->
	<header>
		<? include("parts/header_member.php"); ?>
	</header>

	
	<div class="content clearfix inner">

		<!-- left block-->
		<article class="left">
			<? include("parts/aside.php"); ?>
		</article>

		<!-- right block-->
		<article class="right">
			<? include("parts/wall.php"); ?>
		</article>

	</div>

	<!-- footer -->
	<footer>
		<? include("parts/footer.php"); ?>
	</footer>

</body>
</html>