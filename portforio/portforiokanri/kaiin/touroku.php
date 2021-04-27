<?php
if($_SERVER["REQUEST_METHOD"]==="POST"):
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=portforio;charset=utf8','root','',
		array(PDO::ATTR_EMULATE_PREPARES => false));
	}
	catch (PDOException $e) {
		die('データベース接続失敗。'.$e->getMessage());
	}

	$errors=array();

	$mail=null;
	//日本語いれないでメールアドレス
	$mailmatch="/^[a-zA-Z0-9]+[a-zA-Z0-9\._-]*@[a-zA-Z0-9_-]+.[a-zA-Z0-9\._-]+$/";
	if(!preg_match($mailmatch,$_POST["mail"])):
		$errors["mail"]="メールアドレスを正しく入力してください";
	else:
		if(strlen($_POST["mail"])>50):
			$errors["mail"]="メールアドレスが長すぎます";
		else:
			$stmt=$pdo->prepare("SELECT * FROM `portforio` WHERE `mail`=:mail");
			$stmt->bindParam(':mail',$_POST["mail"]);
			$stmt->execute();
			$result=$stmt->fetch();
			if($result):
				$errors["mail"]="このメールアドレスは既に登録されています。";
			else:
				$mail=$_POST["mail"];
			endif;
			$stmt=null;
		endif;
	endif;

	$pass=null;
	$passmatch="/^[a-zA-Z0-9]{6,12}$/";
	if(!preg_match($passmatch,$_POST["pass"])):
		$errors["pass"]="パスワードを正しく入力してください";
	else:
		$pass=$_POST["pass"];
	endif;

	$title01=null;
	$title01match="/^[ぁ-んァ-ヶー々一-龠０-９a-zA-Z0-9]+$/";
	if(!preg_match($title01match,$_POST["title01"])):
		$errors["title01"]="表示名を正しく入力してくださいtitle01";
	else:
		$title01=$_POST["title01"];
	endif;

	$textarea01=null;
	$textarea01match="/^[ぁ-んァ-ヶー々一-龠０-９a-zA-Z0-9]+$/";
	if(!preg_match($textarea01match,$_POST["textarea01"])):
		$errors["textarea01"]="表示名を正しく入力してくださいtextarea01";
	else:
		$textarea01=$_POST["textarea01"];
	endif;

	$title02=null;
	$title02match="/^[ぁ-んァ-ヶー々一-龠０-９a-zA-Z0-9]+$/";
	if(!preg_match($title02match,$_POST["title02"])):
		$errors["title02"]="表示名を正しく入力してくださいtitle02";
	else:
		$title02=$_POST["title02"];
	endif;

	$textarea02=null;
	$textarea02match="/^[ぁ-んァ-ヶー々一-龠０-９a-zA-Z0-9]+$/";
	if(!preg_match($textarea02match,$_POST["textarea02"])):
		$errors["textarea02"]="表示名を正しく入力してくださいtextarea02";
	else:
		$textarea02=$_POST["textarea02"];
	endif;


	$title03=null;
	$title03match="/^[ぁ-んァ-ヶー々一-龠０-９a-zA-Z0-9]+$/";
	if(!preg_match($title03match,$_POST["title03"])):
		$errors["title03"]="表示名を正しく入力してくださいtitle03";
	else:
		$title03=$_POST["title03"];
	endif;

	$textarea03=null;
	$textarea03match="/^[ぁ-んァ-ヶー々一-龠０-９a-zA-Z0-9]+$/";
	if(!preg_match($textarea03match,$_POST["textarea03"])):
		$errors["textarea03"]="表示名を正しく入力してくださいtextarea03";
	else:
		$textarea03=$_POST["textarea03"];
	endif;

	if(count($errors)===0):
		$stmt = $pdo -> prepare("INSERT INTO `portforio` (`mail`,`pass`,`title01`,`title02`,`title03`,`textarea01`,`textarea02`,`textarea03`) VALUES (:mail,:pass,:title01,:title02,:title03,:textarea01,:textarea02,:textarea03)");
		$stmt->bindParam(':mail',$mail);
		$stmt->bindParam(':pass',$pass);
		$stmt->bindParam(':title01',$title01);
		$stmt->bindParam(':title02',$title02);
		$stmt->bindParam(':title03',$title03);
		$stmt->bindParam(':textarea01',$textarea01);
		$stmt->bindParam(':textarea02',$textarea02);
		$stmt->bindParam(':textarea03',$textarea03);
		$stmt->execute();
		$stmt=null;
	endif;
$pdo=null;
else:
	die("直接アクセス禁止");
endif;
?>
<DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>登録</title>
</head>
<body>
<?php if (count($errors)): ?>
	<ul class="error_list">
<?php foreach($errors as $error): ?>
		<li>
<?php echo htmlspecialchars($error,ENT_QUOTES,"UTF-8") ?>
		</li>
<?php endforeach; ?>
		<li><a href="touroku.html">登録画面に戻る</a></li>
	</ul>
<?php else: ?>
	<p>登録完了しました</p>
	<p><a href="index.html">ログインページへ</a></p>
<?php endif; ?>
</body>
</html>
