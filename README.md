# **Пример библиотеки для back end сервиса в VK Mini Apps**

##### Настройка `config.php`
```php
<?php
  DEFINE("VIEW_PHP_ERROR", false); // Показывать PHP Ошибки(работает при ошибки в методах)
  DEFINE("CLIENT_SECRET", "123456789"); // Защитный ключ приложения, для проверки подписи
  DEFINE("METHOD_LIST", array( // Список доступных методов, которые находятся в папке `methods`
      "testing" // /methods/testing.php
));
```
##### Функции для методов
`$this->ResponseJson("Результат");` Используется в случае успешного достижения результата и возвращает определенную информацию.

`$this->ErrorResponse("Причина ошибки");` Тоже самое, что и выше, только в случае плохого результата.

<a href="https://vk.com/ghost1337gg"><img src="https://pngicon.ru/file/uploads/vk.png" height=30></img></a>
