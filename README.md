# Тестовое задание для LuckyOnline
Проект создал на базе Yii2.

## Первая часть (sql запросы)
Находятся в папке `/part_1`. В каждом файле своя часть.

## Вторая часть (подсчет максимального количества активных пользователей)
Основная логика подсчета находится в методе `\frontend\models\VisitsForm::getMaxOnlineUsers`
Там 2 запроса. Первый считает количество пользователей онлайн на начало периода. Это очень тяжелый запрос, и чем дольше живет сайт, тем запрос тяжелее.
Второй запрос просто тяжелый. Он берет все записи за текущий период (максимум день).

Чтобы облегчить первый запрос и вообще сделать получение пользователей он-лайн возможным, нужно по крону, например, раз в час вычислять количество пользователей онлайн и сохранять в отдельной табличке. После этого первый запрос станет вполне рабочим (стоимость 100 тыс у.е.)

То есть общая рекомендация использовать метод, который я написал, но использовать его раз в час, или раз в 10 минут, чтобы опираться на эти результаты и основной результат (максимальное количество пользователей он-лайн) получать мнговенно.

Ниже список файлов, которые я написал для выполнения тестового задания
* `\frontend\models\VisitsForm`
* `\common\models\Visits`
* `\frontend\controllers\RunController` (для заполнения БД)
* `\frontend\controllers\VisitsController`
* `\frontend/views/visits/index.php`

### Далее идет стандартное описание фреймворка Yii2
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>


<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.com/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.com/yiisoft/yii2-app-advanced)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
