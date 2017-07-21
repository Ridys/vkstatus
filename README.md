# Автоматическая смена статуса на странице ВКонтакте
Скрипт для автоматической смены статуса на странице ВКонтакте. Скрипт выводит в ваш статус текущую погоду и время в вашем городе в строку статуса страницы ВКонтакте.

### Требования:
  - Возможность постоянной (циклической) работы скрипта, я использовал screen.
  - PHP >=5.6

### Установка:
1. Загрузите архив на ваш сервер, используя git или [загрузив zip-архив](https://github.com/Ridys/vkstatus/archive/master.zip).
```sh
$ git clone https://github.com/Ridys/vkstatus.git
```

2. *Далее необходимо настроить файл `vk_config.php`*. Укажите в первое поле ваш часовой пояс, например **Europe/Moscow** для Москвы. [Список часовых поясов](http://php.net/manual/ru/timezones.php).

3. Укажите в переменную `$user_id` в файле `vk_config.php` ваш числовой идентификатор ВКонтакте (без приставки id).

4. [Зарегистрируйтесь](https://home.openweathermap.org/users/sign_up) на сервисе openweathermap.org. После регистрации зайдите на страницу [API-ключи](https://home.openweathermap.org/api_keys) и создайте ключ, введя любое название ключа и нажав Generate. Полученный ключ вставьте в переменную `$weather_key` в файле `vk_config.php`.
![скриншот](https://lh3.googleusercontent.com/iNLaNPTQpdvEFeFyXZMPepqnt_pVH6gXm9MuF9Insh8kzHvzLSLB-usrrqajcHboOnafzlun=w1366-h658-rw)

5. Далее на сайте [openweathermap.org](https://openweathermap.org) вводим название города в поиск и нажимаем кнопку "Search". Выполняем поиск города (на английском языке) и в результатах поиска переходим на страницу с информацией о погоде. С URL копируем ID города и вставляем его в переменную `$city_id` в файле `vk_config.php`.
![скриншот](https://lh5.googleusercontent.com/p7DnCjAt5kyhvSyx_eDq83f_qNTiez6nXgyjNHBjuwLZOHt2BvsDZH5YQlvtOHr9DVwfo3RN=w1366-h658-rw)

6. Вам необходимо получить access_token для вашей страницы ВКонтакте. Для этого используем [официальное приложение Android от ВКонтакте](https://oauth.vk.com/authorize?client_id=2890984&scope=status,offline&redirect_uri=http://api.vk.com/blank.html&display=page&response_type=token) и копируем `access_token` из URL-адреса. Затем вставляем его в переменную `$access_key` в файле `vk_config.php`. 
![скриншот](https://lh4.googleusercontent.com/ZbMl9hpaOFNABvD2zWHaneWiLVMh1VolV5JCAXKYMep_BuE8ckJIQOZLENnjgTKkPjJ8YYzO=w1366-h658)

7. Настройка скрипта завершена. Осталось его запустить. Скрипт должен быть постоянно открыт (он работает в цикле), поэтому ему нужна сессия, которая не будет завершена. Для этого мы будем использовать `screen`.
```sh
$ sudo apt install screen # установка screen
$ screen -S vkstatus # создание screen с названием vkstatus
$ php путь_до_скрипта/vk.php # запуск скрипта
```

8. Если вы выполнили настройку верно - у вас уже должно выводиться время в статус вашей страницы. **Погода появится с 15-ой минуты**, т.к. запрос к погоде выполняется каждые 15 минут.

Дмитрий Агейкин © 2017 г.
Вы можете использовать данный скрипт для любых целей, включая коммерческие.
