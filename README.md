# Symfony Project

На данный момент я планирую сделать простой блог, а дальше, как покажет развитие.

Я использую MySQL 8, PHP 8.1, Symfony 5.4 for now.

## Примерный план

Этапы реализации:
- Установить фреймворк Symfony и запустите сервер
- Разделенный интерфейс и область администрирования, каждая со своим собственным шаблоном-скелетом
  - front: [Bootstrap 5](https://getbootstrap.com)
  - admin: [SB Admin](https://startbootstrap.com/template/sb-admin)
- Регистрация, аутентификация, авторизация (отдельные формы для фронтальной и административной областей)
- Пользователи с ролями: `ROLE_USER`, `ROLE_ADMIN`, `ROLE_SUPER_ADMIN`

### В области администрирования
- Информационная панель
- Управление блогом
  - Публикации
  - Категории
  - Теги
- Управление страницами
- Управление пользователями

---

## Установка

У вас локально установлены: php8, mysql, composer, nodejs, npm, yarn, symfony


```
git clone git@github.com:reustorator/demoSymfony.git
cd demoSymfony
cp .env .env.local
composer install
yarn install
yarn encore dev
make db-seed
symfony server:start -d
```

## Установить через Docker

Добавить в `/etc/hosts` строку файла `127.0.0.1 syblog.test`

```
git clone git@github.com:reustorator/demoSymfony.git
cd demoSymfony
cp .env .env.local
```
Задать `DATABASE_URL` в `.env.local` файле:
```
DATABASE_URL="mysql://symfony:symfony@mysql:3306/symfony?serverVersion=8.0"
```
Смотрите подключение к базе данных в `docker-compose.yml`

### Инициализация и настройка:

```
make init
make setup
sudo chown -R $USER:$USER .
```

### Заполнение

Ввод демонстрационных данных:
```
make db-dul
```
(schema:drop, schema:update, fixtures:load)

## Docker

### Up

Подключение `docker-compose up -d` или:
```
make up
```

### Down

Отключение `docker-compose down --remove-orphans` или:
```
make down
```

Смотрите все команды в `Makefile` файле.

## Доступ к сайту


Front:
```
https://127.0.0.1:8000
```
Front для Docker:
```
http://syblog.test
```

Admin:
```
https://127.0.0.1:8000/admin
```
Admin для Docker:
```
http://syblog.test/admin
```

### Пользователи
```
user@example.com   - User
admin@example.com  - Admin
sadmin@example.com - Super Admin
```
Пароль: `password`