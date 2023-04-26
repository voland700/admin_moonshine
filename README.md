
## Laravel + admin panel Moonshine

Каталог товаров с использованием фреймворка Laravel и админ-панели Moonshine
- [Admin-hfnel Moonshine](https://moonshine.cutcode.dev).
- [kalnoy/nestedset - построение дерева категорий](https://github.com/lazychaser/laravel-nestedset).
- [spatie/laravel-medialibrary - библиотека для загрузки изображений, миниатюр для токаров и категорий](https://spatie.be/docs/laravel-medialibrary/v10/introduction).

### Установка

- git clone
- composer install
- cp .env.example .env
- php artisan storage:link
- php artisan migrate --seed

Создать пользователя с правми администратора:
- php artisan moonshine:user

Доступ к админ панели: domen/moonshine