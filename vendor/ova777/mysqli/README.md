# MYSQLi
MYSQLi extension library

### 0. Установка
```
composer require ova777/mysqli
```
После этого подключаем composer autoloader
```php
require_once __DIR__.'/vendor/autoload.php';
```

### 1. Подключение к БД
```php
$db = new \ova777\MYSQLi\Connection('localhost', 'user', 'password', 'database');
```

### 2. Запросы на получение данных
```php
//Все строки результата в виде массива ассоциативных массивов
$rows = $db->command('SELECT * FROM table')->queryAll();
//Первую строка результата в виде ассоциативного массива
$row = $db->command('SELECT * FROM table')->queryRow();
//Данные первой колонки результата
$column = $db->command('SELECT * FROM table')->queryColumn();
//Первый столбец первой колонки
$value = $db->command('SELECT * FROM table')->queryScalar();
```

### 3. Привязка значений к запросу
```php
//Один параметр
$rows = $db->command('SELECT * FROM table WHERE id=?')
    ->bind('i', 1)
    ->queryAll();
    
//Несколько параметров
$rows = $db->command('SELECT * FROM table WHERE id=? AND foo=?')
    ->bind('is', array(1, 'bar'))
    ->queryAll();
```

### 4. INSERT, UPDATE, DELETE запросы
```php
$db->command('INSERT INTO table SET int_col=?, str_col=?')
    ->bind('is', array(1, 'foo'))
    ->execute();
```

### 5. Повторное использование подготовленных запросов
```php
//Полготавливаем запрос
$cmd = $db->command('INSERT INTO table SET a=?,b=?');
//Выполняем запросы
$cmd->bind('is', array(1, 'foo'))->execute();
$cmd->bind('is', array(2, 'bar'))->execute();
//При повторном вызове bind можно не передавать типы значений
$cmd->bind(array(3, 'xyz'))->execute();
...
$cmd->close();
```