<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員ページ</title>
</head>

<body style="background:rgb(224, 229, 231);">

<?php
require("comon.php");

if(!isset($_SESSION['mail'])){
	header('Location: ../../home.html');
}
?>

	<h1>会員専用ページ</h1>
	<p><?php echo $_SESSION['name'] ?></p><br>
	<p><?php echo $_SESSION['title01'] ?></p>
	<p><?php echo $_SESSION['textarea01'] ?></p><br>
	<p><?php echo $_SESSION['title02'] ?></p>
	<p><?php echo $_SESSION['textarea02'] ?></p><br>
	<p><?php echo $_SESSION['title03'] ?></p>
	<p><?php echo $_SESSION['textarea03'] ?></p><br>

	<ul>
		<li><a href="henko.php">文章を編集</a></li>
		<li><a href="sakuzyo.php">会員退会</a></li>
		<li><a href="logout.php">ログアウト</a></li>
	</ul>


</body>
</html>
