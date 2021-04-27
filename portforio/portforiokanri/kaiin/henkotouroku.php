<?php
	session_start();
	if(isset($_SESSION["name"])):
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>変更</title>
</head>
<body>
<?php
		if($_SERVER["REQUEST_METHOD"]==="POST"):
			try {
				$pdo = new PDO('mysql:host=localhost;dbname=portforio;charset=utf8','root','',
				array(PDO::ATTR_EMULATE_PREPARES => false));
			}
			catch (PDOException $e) {
				die('データベース接続失敗。'.$e->getMessage());
			}
			$stmt=$pdo->prepare("SELECT `pass` FROM `portforio` WHERE `mail`=:mail");
			$stmt->bindParam(':mail',$_SESSION["mail"]);
			$stmt->execute();
			$result=$stmt->fetch();
			if($result):
				if($_POST["pass"]===$result["pass"]):
					$postmatch="/^[ぁ-んァ-ヶー々一-龠０-９a-zA-Z0-9]+$/";
					if(!preg_match($postmatch,$_POST["textarea01"])):
						$errors="文章を正しく入力してください";
					else:


						
						$stmt=null;
						$sql = 'UPDATE `portforio` SET `textarea01` = :textarea01 , `textarea02` = :textarea02 , `textarea03` = :textarea03 WHERE `mail` = :mail';

						$stmt = $pdo -> prepare($sql);
						$stmt->bindParam(':textarea01',$_POST['textarea01']);
						$stmt->bindParam(':textarea02',$_POST['textarea02']);
						$stmt->bindParam(':textarea03',$_POST['textarea03']);
						$stmt->bindParam(':mail',$_SESSION['mail']);
						$stmt->execute();
?>
		<p>文章を変更しました。</p>
<?php
					endif;
				else:
					$errors="パスワードが違います";
				endif;
			else:
				die("セッション切れ");
			endif;
			$stmt=null;
		else:
			die("送信エラー");
		endif;
		$pdo=null;
		if(isset($errors)):
?>
	<p><?php echo $errors; ?></p>
	<p><a href='henko.php'>前画面に戻る</a></p>
<?php
		endif;
?>
</body>
</html>
<?php
	else:
		die("直接アクセス禁止");
	endif;
?>
