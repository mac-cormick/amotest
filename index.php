<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Test</title>
</head>
<body>

  <form action="add-contacts.php" method="post">
    <label for="contacts-count">Сколько контактов добавить?</label>
    <p><input type="text" name="contacts-count" id="contacts-count"></p>
    <p><input type="submit" value="Добавить"></p>
  </form>

  <hr>

  <form action="add-multisel.php" method="post">
  	<label for="multi-name">Название мультисписка</label>
  	<p><input type="text" name="multi-name" id="multi-name"></p>
  	<label for="multi-thing">Выберите сущность</label>
  	<p><input type="radio" name="choise" value="contact"> Контакт</p>
  	<p><input type="radio" name="choise" value="sdelka"> Сделка</p>
  	<p><input type="radio" name="choise" value="company"> Компания</p>
  	<p><input type="radio" name="choise" value="pokup"> Покупатель</p>
  	<p><input type="submit" value="Создать"></p>
  </form>
  
</body>
</html>