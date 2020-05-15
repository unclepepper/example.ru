<!DOCTYPE html>
	<html>
	 <head>
	  <meta charset="utf-8">
	    <base href="http://vk.com/" />
	 </head>

	 <body>
	  
	   <br>
	  <form method="post" >
	  <div><input type="text" placeholder="Ваш ID ВКонтакте" name="id" /></div>
	  <div><input type="submit" value="Посмотреть" /></div>
	  </form>
	  <br>
	     
	<?php
	// парсим вконтактике имя пользователя
	if(isset($_POST['id'])) {
	 $id = $_POST['id'];
	 $urlTo = 'http://vk.com/id'.$id;      // Куда данные послать
	  $ch = curl_init();                     // Инициализация сеанса
	  curl_setopt($ch, CURLOPT_URL, $urlTo); // Куда данные послать
	  curl_setopt($ch, CURLOPT_HEADER, 0);   // получать заголовки
	  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);

	  curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');
	  curl_setopt($ch, CURLOPT_REFERER, 'http://vk.com');
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // Говорим скрипту, чтобы он следовал за редиректами которые происходят во время авторизации
	  curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Expect:')); // это необходимо, чтобы cURL не высылал заголовок на ожидание
	    $tempRes = curl_exec($ch);
	  curl_close($ch); // Завершаем сеанс
	
	$res = iconv('windows-1251', 'utf-8', $tempRes); // перекодируем с "windows-1251" в "utf-8"
	preg_match('#<title>(.*)\|(.*)<\/title>#ui', $res, $result);
	 $name = trim($result[1]); // получаем имя пользователя
	 
	// записываем в файл
	  if($name != '404 Not' && $name != 'Інформація' && $name != 'Информация' && $name != '') {
	       $write = fopen('id.txt','a+');
	       fwrite($write, $tempRes."\r\n");
	        fclose($write);
	    $results = 'Запись добавлена!';
	    } else {
	      $results = $id.' - Такого пользователя не существует';
	    }
	}
	 
	echo $results.'<br>';
	echo $name.'<br>'; // имя пользователя
	echo $res; // выводим страницу в браузер
	?>
	 </body>
	</html>