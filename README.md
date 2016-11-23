HoP microservcie base for starting development
==============================================
HoP microservcie base for starting development

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist gastons26/hop-microservice "*"
```

or add

```
"gastons26/hop-microservice": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \hop\microservice\AutoloadExample::widget(); ?>```