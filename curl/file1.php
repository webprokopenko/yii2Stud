<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 3/12/18
 * Time: 7:12 PM
 */
// php.ini  extendsion = php_curl.dll
$ch = curl_init();
$url = 'http://test.com';
curl_setopt($ch, CURLOPT_URL,$url);

//Пример (задача получить только заголовок ответа от сервера)
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_NOBODY, 1);

//Инициировали сессию. То есть задали нужные параметры для запроса
//Соответственно следующий шаг - отправить запрос и получение результата

$ressult = curl_exec($ch);
//После получения результата закрываем сессию
curl_close($ch);
echo $result;





//$ch1 = curl_init('http://test.com');