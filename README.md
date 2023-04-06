## Книга должников

Это простое веб-приложение, которое позволяет вам отслеживать своих должников и их платежи. Это может быть полезно для владельцев малого бизнеса или частных лиц, которые ссужают деньги другим и хотят вести учет всех соответствующих транзакций.

## Особенности

- Добавляйте, редактируйте и удаляйте профили должников, включая их имя, контактную информацию и непогашенный остаток.
- Записывайте платежи от должников и автоматически обновляйте их баланс.
- Просмотр списка всех должников и их соответствующие детали.
- Поиск и фильтрация должников по имени или по датам транзакций.
- Отслеживать история транзакций должников.


## Технологии

Приложение построено с использованием следующих технологий:

- PHP 7.4.16 (backend)
- Laravel 8.0 (web-framework)
- Livewire v.2x (full-stack framework)
- MYSQL 5.7 (Database ORM)
- Bootstrap 4.0 (frontend-library)
- jQuery 3.6+ (frontend-framework)


## Установка

Для локального запуска приложения необходимо выполнить следующие действия:

1. Клонировать репозиторию из GitHub:

```bash
git clone https://github.com/allayar27/debtors-book.git
```

2. Копировать .env.example в .env

3. Создать новый ключ для проекта выполнив команду:

```bash
 php artisan key:generate
```

4. В файле .env надо настроить подключение к почтовому сервису.

5. Запустите миграцию с сидами с выполнив команду:

```bash
 php artisan migrate --seed
``` 
  
6. Для запуска тестов создайте отдельное тестовое окружение .env.testing и тестовую базу.
   
7. Запустите приложение:

```bash
 php artisan serve
```





