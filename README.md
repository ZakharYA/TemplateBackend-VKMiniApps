# **Пример библиотеки для back end сервиса в VK Mini Apps**

##### Настройка `config.php`
```php
<?php
  DEFINE('VIEW_PHP_ERROR', false); // Показывать PHP Ошибки(работает при ошибки в методах)
  DEFINE('CLIENT_SECRET', 'SECRET_ABC'); // Защитный ключ приложения, для проверки подписи
  DEFINE('METHOD_LIST', array( // Список доступных методов, которые находятся в папке `methods`
      'testing' // /methods/testing.php
));
```
##### Функции для методов
`$this->SuccessResponse('Результат')` Используется в случае успешного достижения результата и возвращает определенную информацию.

`$this->ErrorResponse('Причина ошибки', 401)` Тоже самое, что и выше, только в случае плохого результата, и с возратом кода состояния.

P.S Второй аргумент(401) не является обязательным, по дефолту 200.

Пример запроса: 
```
http://localhost/TemplateBackend-VKMiniApps/index.php?method=testing&vk_access_token_settings=notify&vk_app_id=1&vk_are_notifications_enabled=0&vk_is_app_user=1&vk_language=ru&vk_platform=mobile_web&vk_ref=other&vk_user_id=1&sign=aMKOCC2GYNVL-AewtNxa1O31xgI3qEFJBZfaLnEFSXI
```
<a href="https://vk.com/ghost1337gg"><img src="https://pngicon.ru/file/uploads/vk.png" height=30></img></a>
