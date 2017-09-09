Musrenbang Online [codename SMDSPR]
======================================================

Musrenbang Online (codename SMDSPR) adalah aplikasi Perencaan Pembangunan dan Anggaran.

Musrenbang Online terdiri dari sisi public - yang merupakan sisi frontend - dan sisi eksekutif - yang merupakan sisi backend- yang dibatasi oleh fase musrenbang RW-Desa/Kelurahan.

Ini adalah fase WIPS.

Sebelum Menginstall pastikan installasi wamp terlebih dahulu, lakukan clone menuju folder instalasi wamp anda (wamp jika anda menggunakan windows, untuk linux sama). Kemudian install [composer](https://getcomposer.org/).

Setelah anda melakukan clone dan composer lakukan perintah berikut pada command prompt
```
composer global require "fxp/composer-asset-plugin:^1.2.0"
composer update
```

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-advanced/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-advanced/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-advanced)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
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
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
tests                    contains various tests for the advanced application
    codeception/         contains tests developed with Codeception PHP Testing Framework
```