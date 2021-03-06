Keyword
===============================
面向对象


配置
===============================

需求
-------------------------------
Yii2 需要PHP版本高于5.4,最佳匹配PHP7

安装
-------------------------------
- composer

  `curl -sS https://getcomposer.org/installer | php`


- 更新框架

  `php composer.phar update`

  *由于众所周知的网络问题，此步有极大几率失败。

  解决方案1：科学上网

  解决方案2：composer更换国内源



- 环境初始化

  `./init`



- 配置数据库
 
```
'db' => [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=localhost;dbname=yii2_test', //Postgresql
    // 'dsn' => 'mysql:host=localhost;dbname=yii2',  //MySQL
    'username' => 'yii',
    'password' => 'yii',
    'charset' => 'utf8',
],
```
环境配置信息应写在main-local.php中

yii2_test.sql是Postgresql的数据库DUMP，可导入使用。

空库开始的话需要用初始化数据库

`yii migrate/up`


使用
===============================

OAuth2.0
-------------------------------

先初始化数据库：
`yii migrate --migrationPath=@conquer/oauth2/migrations`

* Client_id发行页面

http://backend.dev/Oauth/

此页面需要登录

http://frontend.dev/site/signup

* 认证页面：
http://frontend.dev/auth/index?response_type=code&client_id=111&redirect_uri=http://sourcedomain/callback

* 请求token：
http://frontend.dev/auth/token?code=HSL7-cBgPjm02D4J3CifRdOxbyq9dd7KcLsfMNsv&grant_type=authorization_code&client_id=111

* token过期后刷新：
http://frontend.dev/auth/token?refresh_token=TU3h1HDj2iX9V7lIW8tdfmut6DM4uhv7rObrnJo2&grant_type=refresh_token&client_id=111&client_secret=j4jjdfjg4ijs

api节点下的thread 接口配置为OAuth认证，可使用access_token进行查询:
`curl -i http://api.yii.dev/threads?access_token=yFf6YSA-tkA35-qakM_8kU5BLXxblLy0_toHpHbC`

TODO

Scope管理

-------------------------------

Yii 2 Advanced Project Template
===============================

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, console, and api, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-advanced/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-advanced/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)

DIRECTORY STRUCTURE
-------------------

```
yii2_test.sql            Postgresql db dump
requirements.php         Application requirement checker script.
api
    config/              contains api configurations
    controllers/         contains Api controller classes
    models/              contains api-specific model classes
    web/                 contains the entry script
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

Apache configration
===============================

Frontend sample
```
<VirtualHost frontend.dev:80>
    ServerAdmin webmaster@xxx.com
    ServerName frontend.dev

    DocumentRoot /srv/www/vhosts/yii2/frontend/web

    ErrorLog /var/log/apache2/yii2_frontend.dev-error_log
    CustomLog /var/log/apache2/yii2_frontend.dev-access_log combined

    HostnameLookups Off
    UseCanonicalName Off
    ServerSignature On

    <Directory "/srv/www/vhosts/yii2/frontend/web">
	Options Indexes FollowSymLinks
	AllowOverride None

        # For Apache 2.4
	<IfModule !mod_access_compat.c>
	    Require all granted
	</IfModule>

        # for Apache 2.2
	<IfModule mod_access_compat.c>
	    Order allow,deny
	    Allow from all
	</IfModule>

	RewriteEngine on
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule . index.php

    </Directory>
</VirtualHost>
```