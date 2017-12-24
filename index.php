<?php

#Массив с параметрами, которые нужно передать методом POST к API системы
$user=array(
 'USER_LOGIN'=>'mac-cormick@yandex.ru', #Ваш логин (электронная почта)
 'USER_HASH'=>'2dec3492ba111ef482236c1691407057' #Хэш для доступа к API (смотрите в профиле пользователя)
);
$subdomain='demomac'; #Наш аккаунт - поддомен
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
	echo 'Авторизация прошла успешно';
}
echo '<br>';



for ($i=0; $i<1000; $i++) {
	$name = md5(uniqid(rand(), true));
	$company = md5(uniqid(rand(), true));
	$array[] = array('name' => $name, 'company_name' => $company);
}

$data = array (
  'add' => $array
);
$link = "https://demomac.amocrm.ru/api/v2/contacts";

$headers[] = "Accept: application/json";

 //Curl options
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-
demomac/2.0");
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
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
// echo '<br>';



$link = 'https://demomac.amocrm.ru/api/v2/contacts/';

$headers[] = "Accept: application/json";

 //Curl options
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-
demomac/2.0");
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
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
echo '<br>';

$contacts = $result['_embedded']['items'];
foreach($contacts as $contact) {
  if (count($contact['leads']) == 0) {
    $contactId = $contact['id'];
    $companyId = $contact['company']['id'];
    echo $contactId . ' ';
    echo $companyId;
    $name = md5(uniqid(rand(), true));
    $leads[] = array('name' => $name, 'contacts_id' => [$contactId], 'company_id' => $companyId);
  }
}

echo '<pre>';
var_dump($leads);
echo '</pre>';

$data = array (
  'add' => $leads
);

$link = "https://demomac.amocrm.ru/api/v2/leads";

$headers[] = "Accept: application/json";

 //Curl options
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-
demomac/2.0");
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($curl, CURLOPT_URL, $link);
curl_setopt($curl, CURLOPT_HEADER,false);
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
$out = curl_exec($curl);
curl_close($curl);
$result = json_decode($out,TRUE);