SIMDA Perencanaan [codename SMDSPR] @satgas_simda bpkp
======================================================

SIMDA Perencanaan (codename SMDSPR) adalah aplikasi yang dikembangkan oleh  [tim aplikasi SATGAS SIMDA BPKP](http://www.simda-online.com/) sebagai salah satu subsistem SIMDA Keuangan yang digunakan untuk Perencaan Pembangunan dan Anggaran.

SIMDA Perencaanaan terdiri dari sisi public - yang merupakan sisi frontend - dan sisi eksekutif - yang merupakan sisi backend- yang dibatasi oleh fase musrenbang RW-Desa/Kelurahan.

Ini adalah fase pengembangan untuk development terbatas Tim Aplikasi SATGAS SIMDA BPKP. Silahkan lakukan pull-modified-commit-push melalui command yang dapat dilihat di [link ini] (http://www.belajararief.com/index.php/tulisan/tekno/172-git-cheatsheet) dan jangan lupa message setiap commit dilakukan.
Gunakan aplikasi [gitkraket](https://www.gitkraken.com/) Untuk mempermudah penatausahaan git.

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