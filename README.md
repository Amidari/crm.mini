<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

Запуск проекта

```
- docker-compose up -d
- composer install
- php init
```

Настройки подключения к БД:
'dsn' => 'mysql:host=YOU_IP:8101;dbname=crm', <br>
'username' => 'root', <br>
'password' => 'root', <br>
'charset' => 'utf8', <br>

Указать свой локальный IP

```
- php yii migrate
- php yii migrate --migrationPath=@yii/rbac/migrations
- php yii rbac/init
```

frontend часть: http://localhost:20080/  <br>
backend часть:  http://localhost:21080/ <br>

login:  admin@example.com
password: 123