                                                    Debtors Book

## Описание проекта

Проект Debtors Book на GitHub — это админ панель приложение, которое помогает пользователям управлять своими должниками и кредитами. Это позволяет пользователям легко добавлять, редактировать и удалять должников и кредиты, а также отслеживать их общее финансовое положение. Приложение также предоставляет напоминания о причитающихся платежах и позволяет пользователям создавать индивидуальный план платежей для каждого должника. Этот проект написан на языке PHP и использует MYSQL для хранения данных. Код имеет открытый исходный код и доступен для использования и изменения любым пользователем.

## Требования

Для установки приложение необходимо выполнение следующих требований:

php >=7.4.16

laravel >= 8.0

composer

## Установка

Клонировать репозиторию из GitHub:

```bash
git clone https://github.com/allayar27/debtors-book.git
```

- копировать .env.example в .env

- создать новый ключ для проекта выполнив команду:

```bash
 php artisan key:generate
```

- в файле .env надо настроить подключение к почтовому сервису.
  
- для запуска тестов создайте отдельное тестовое окружение .env.testing и тестовую базу.


## Использование

 Запустите миграцию с сидами с выполнив команду:

```bash
 php artisan migrate --seed
```

 И наконец выполните команду:

```bash
 php artisan serve
```

## Представление


<div><img src="../..//" style="width:100%;height:auto;"/></div>

