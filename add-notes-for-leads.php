<?php

ini_set('max_execution_time', 900);

#Массив с параметрами, которые нужно передать методом POST к API системы
$user=array(
 'USER_LOGIN'=>'amolyakov@team.amocrm.com', #Ваш логин (электронная почта)
 'USER_HASH'=>'691c2c8c35794e95be679e7a21d40c40' #Хэш для доступа к API (смотрите в профиле пользователя)
);
$subdomain='newdemonew'; #Наш аккаунт - поддомен
#Формируем ссылку для запроса
$link='https://'.$subdomain.'.amocrm.ru/private/api/auth.php?type=json';
/* Нам необходимо инициировать запрос к серверу. Воспользуемся библиотекой cURL (поставляется в составе PHP). Вы также
можете
использовать и кроссплатформенную программу cURL, если вы не программируете на PHP. */
$curl=curl_init(); #Сохраняем дескриптор сеанса cURL
#Устанавливаем необходимые опции для сеанса cURL
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
curl_setopt($curl,CURLOPT_URL,$link);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($user));
curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
curl_setopt($curl,CURLOPT_HEADER,false);
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
$out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
$code=curl_getinfo($curl,CURLINFO_HTTP_CODE); #Получим HTTP-код ответа сервера
curl_close($curl); #Завершаем сеанс cURL
/* Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
$code=(int)$code;
$errors=array(
	301=>'Moved permanently',
	400=>'Bad request',
	401=>'Unauthorized',
	403=>'Forbidden',
	404=>'Not found',
	500=>'Internal server error',
	502=>'Bad gateway',
	503=>'Service unavailable'
);
try
{
  #Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
	if($code!=200 && $code!=204)
		throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error',$code);
}
catch(Exception $E)
{
	die('Ошибка: '.$E->getMessage().PHP_EOL.'Код ошибки: '.$E->getCode());
}
/*
 Данные получаем в формате JSON, поэтому, для получения читаемых данных,
 нам придётся перевести ответ в формат, понятный PHP
 */
 $Response=json_decode($out,true);
 $Response=$Response['response'];
if(isset($Response['auth'])) #Флаг авторизации доступен в свойстве "auth"
{
	echo 'Авторизация прошла успешно';
} else {
	echo 'Ошибка авторизации';
}
echo '<br>';

// Функция генерации случайной сттроки
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

// Получение сделок
for ($i=0; $i<173; $i++) {
	sleep(1);
	$leads = array();
	$offset = $i*500;
	$link = 'https://newdemonew.amocrm.ru/api/v2/leads?limit_rows=500&limit_offset='.$offset;

	$headers[] = "Accept: application/json";

 //Curl options
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-newdemonew/2.0");
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_URL, $link);
	curl_setopt($curl, CURLOPT_HEADER,false);
	curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
	curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
	$out = curl_exec($curl);
	curl_close($curl);
	$result = json_decode($out,TRUE);

// echo '<pre>';
// var_dump($result);
// echo '</pre>';

	$leads = $result['_embedded']['items'];

	// echo '<pre>';
	// var_dump($leads);
	// echo '</pre>';
	// echo '<br><br>';

// Формирование массива данных для добавления note для каждой сделки
	$array = [];

	foreach($leads as $item) {
		$elemId = $item['id'];
		$text = random_string(1000, $str_characters);
		$noteType = rand(4, 5);
		$array[] = array('element_id' => $elemId, 'element_type' => '2', 'text' => $text, 'note_type' => $noteType);
	}

	// echo '<pre>';
	// var_dump($array);
	// echo '</pre>';
	// echo '<br><br>';

	$data = array (
		'add' => $array
	);

// Добавление notes
	$link = "https://newdemonew.amocrm.ru/api/v2/notes";

	$headers[] = "Accept: application/json";

 //Curl options
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-newdemonew/2.0");
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($curl, CURLOPT_URL, $link);
	curl_setopt($curl, CURLOPT_HEADER,false);
	curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
	curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
	$out = curl_exec($curl);
	curl_close($curl);
	$result = json_decode($out,TRUE);

	echo '<pre>';
	var_dump($result);
	echo '</pre>';
}