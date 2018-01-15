<?php

$text = md5(uniqid(rand(100000, 100000000), true));

echo $text;

// Функция принимает 2 параметра: длину случайной строки и символы, которые участвуют в ее формировании
function random_string ($str_length, $str_characters)
{
    $str_characters = array (0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    if (!is_int($str_length) || $str_length < 0)
    {
        return false;
    }
    // Подсчитываем реальное количество символов, участвующих в формировании случайной строки и вычитаем 1
    $characters_length = count($str_characters) - 1;
    // Объявляем переменную для хранения итогового результата
    $string = '';
    // Формируем случайную строку в цикле
    for ($i = $str_length; $i > 0; $i--)
    {
        $string .= $str_characters[mt_rand(0, $characters_length)];
    }
    // Возвращаем результат
    return $string;
}

echo random_string(10000, $str_characters);