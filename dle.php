<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <title>Скачка DLE</title>
 </head>
 <body>
<?php
if(file_exists('engine/engine.php')) 
	die('CMS уже установлена');
if($_POST['name']) {
	if($file = file_get_contents("http://dev.mygame.su/DLE/{$_POST['name']}.zip"));
		file_put_contents('DLE.zip', $file);
	$zip = new ZipArchive;
	if ($zip->open('DLE.zip') === TRUE) {
		$zip->extractTo('.');
		$zip->close();
		unlink('DLE.zip');
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		echo "Скачивание завершено. Перенаправление...
		<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"3; URL=http://{$_SERVER['HTTP_HOST']}$uri/index.php\">";
	} else
		echo 'Ошибка';
} else {
?>
<form action="<?=$filename?>" method="post">
   <p><select style="width:200px" size="15" multiple name="name">
   <option disabled>Выберите версию</option>
<?php
	$check = json_decode(file_get_contents('http://dev.mygame.su/DLE/'),2);
	foreach($check as $temp) {
		echo "<option value=\"{$temp}\">{$temp}</option>";
	}
?>
   </select></p>
   <p><input type="submit" value="Скачать"></p>
  </form>
<?
}
?>
 </body>
</html>