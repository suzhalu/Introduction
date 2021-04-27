<?php
	session_start();
	if(isset($_SESSION["name"])):
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員情報変更</title>
</head>
<body style="background:rgb(224, 229, 231);">
	<h1>文章変更</h1>
	<p>キティラ</p>
	<p style="opacity:0.5;"><?php echo $_SESSION['textarea01'] ?></p>
	<form action="henkotouroku.php" method="post">
		パスワード<input type="password" name="pass" size="12"><br>
		文章を編集 <br><textarea name="textarea01" id="" cols="30" rows="10"><?php echo $_SESSION['textarea01'] ?></textarea>
		<input type="submit" value="変更">
		<br>

	<p>オロウス</p>
	<p style="opacity:0.5;"><?php echo $_SESSION['textarea02'] ?></p>
		文章を編集 <br><textarea name="textarea02" id="" cols="30" rows="10"><?php echo $_SESSION['textarea02'] ?></textarea>
		<input type="submit" value="変更">
		<br>
	<p>イストロス</p>
	<p style="opacity:0.5;"><?php echo $_SESSION['textarea03'] ?></p>
		文章を編集 <br><textarea name="textarea03" id="" cols="30" rows="10"><?php echo $_SESSION['textarea03'] ?></textarea>
		<input type="submit" value="変更">
		<br>
	</form>

</body>
</html>
<?php
	else:
		die("直接アクセス禁止");
	endif;
?>
