<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Test</title>
</head>
<body>

  <h2>Добавление контактов</h2>
  <form action="add-contacts.php" method="post">
    <label for="contacts-count">Сколько контактов добавить?</label>
    <p><input type="text" name="contacts-count" id="contacts-count"></p>
    <p><input type="submit" value="Добавить"></p>
  </form>

  <hr>

  <h2>Добавление доп. поля типа мультисписок</h2>
  <form action="add-multisel.php" method="post">
  	<label for="multi-name">Название мультисписка</label>
  	<p><input type="text" name="multi-name" id="multi-name"></p>
  	<h3>Выберите сущность</h3>
  	<p><input type="radio" name="choise" value="contact"> Контакт</p>
  	<p><input type="radio" name="choise" value="sdelka"> Сделка</p>
  	<p><input type="radio" name="choise" value="company"> Компания</p>
  	<p><input type="radio" name="choise" value="pokup"> Покупатель</p>
  	<p><input type="submit" value="Создать"></p>
  </form>

  <hr>

  <h2>Добавление доп. поля типа текст</h2>
  <form action="add-doptext.php" method="post">
  	<label for="doptext-name">Название поля</label>
  	<p><input type="text" name="doptext-name" id="doptext-name"></p>
  	<label for="doptext-mean">Значение поля</label>
  	<p><input type="text" name="doptext-mean" id="doptext-mean"></p>
  	<h3>Выберите сущность</h3>
  	<p><input type="radio" name="choise" value="contact"> Контакт</p>
  	<p><input type="radio" name="choise" value="sdelka"> Сделка</p>
  	<p><input type="radio" name="choise" value="company"> Компания</p>
  	<p><input type="radio" name="choise" value="pokup"> Покупатель</p>
  	<p><input type="submit" value="Создать"></p>
  </form>

  <hr>

  <h2>Добавление примечания</h2>
  <form action="add-note.php" method="post">
  	<label for="elem-id">ID элемента</label>
  	<p><input type="text" name="elem-id" id="elem-id"></p>
  	<h3>Тип элемента</h3>
  	<p><input type="radio" name="choise" value="contact"> Контакт</p>
  	<p><input type="radio" name="choise" value="sdelka"> Сделка</p>
  	<p><input type="radio" name="choise" value="company"> Компания</p>
  	<p><input type="radio" name="choise" value="pokup"> Покупатель</p>
  	<label for="note-text">Текст примечания</label>
  	<p><input type="text" name="note-text" id="note-text"></p>
  	<h3>Тип примечания</h3>
  	<p><input type="radio" name="note-choise" value="simple-note"> Обычное примечание</p>
  	<p><input type="radio" name="note-choise" value="call-note"> Входящий звонок</p>
  	<p><input type="submit" value="Добавить примечание"></p>
  </form>

  <hr>

  <h2>Завершение задачи</h2>
  <form action="end-task.php" method="post">
    <label for="task-id">ID задачи</label>
    <p><input type="text" name="task-id" id="task-id"></p>
    <label for="date">Дата изменения</label>
    <p><input type="datetime-local" name="date" id="date"></p>
    <label for="task-text">Текст примечания</label>
    <p><input type="text" name="task-text" id="task-text"></p>
    <p><input type="submit" value="Завершить задачу"></p>
  </form>
  
</body>
</html>