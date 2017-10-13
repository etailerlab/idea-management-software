
# Description
Внутренняя система для внесения идей (сотрудников, руководства, клиентов
 по результатам опросов и т.д) и контроля за их реализацией
  - Performance Improvement System.

# Requirements
 - php7.0+
 - composer

# Install
 - composer update --no-dev
 - php artisan key:generate
 - php artisan migrate
 - php artisan db:seed

##Default user
 ivan@example.com / 123456

##Roles list
 - superadmin
 - admin
 - user