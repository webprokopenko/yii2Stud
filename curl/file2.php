<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 3/12/18
 * Time: 7:29 PM
 */

function get_page($url){
    $uagent = "Opena/9.80 (Windows NT 6.1; WOW64) Presto/2.12.388 Version/12.14";

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_HEADER, 0); // не получать заголовок ответа
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); //переходить по редиректам
    curl_setopt($ch, CURLOPT_ENCODING,""); //Обрабатывает все кодировки
    curl_setopt($ch, CURLOPT_USERAGENT, $uagent); //Useragent
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); //таймаут соединения
    curl_setopt($ch, CURLOPT_TIMEOUT, 120); //таймаут ответа
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10); //после 10-го редиректа не будет обрабатываться


    $content = curl_exec($ch); //Body ответа от сервера
    $err = curl_errno($ch); //Код ошибки если она есть
    $errmsg = curl_error($ch); //Текст ошибки если она есть
    $header = curl_getinfo($ch); // Заголовок
    //закрываем соединение
    curl_close($ch);

}