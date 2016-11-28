HoP microservice base for starting development
==============================================

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

add git repository

```
"repositories":[
    {
        "type": "git",
        "url": "https://github.com/gastons26/yii2-hop-microservice"
    }
],
```


to the require section of your `composer.json` file.


Usage
-----

After installation you need to register application. For security reasons you can do this through console.
You need to include microservice extension into console config + configure it:

```
$config['bootstrap'][] = 'microservice';
$config["modules"]["microservice"] = [
    'class' => 'hop\microservice\Module',

    'secretKey' => "AskHopMicroserviceDevelopers",
    'gatewayUrl' => 'http://localhost:9003',

    'registrationConfig' => [
        'appRegistrationMode' =>  1,
        "h2OApp" => [
            "name" => "phpmicro",
            "host" => "http://localhost:9059",
            "version" => 1,
            "angularStates" => [
                 [
                    "title" => "Micro PHP service",
                    "state" => "H2O.php.micro",
                    "htmlId" => "menu-php-micro",
                    "stateType" => 1
                    "icon" => "data:image/png;base64,iVBORw.....",
                 ]
            ],
            "requiredModules" => [
                "H2O_PHPMICRO"
            ],
            "requiredRoles" => [],
            "applicationStaticFiles" => [
                [
                    "fileName" => "php-micro.js",
                    "fileContent" => "It's will be automatically computed"
                ],
                [
                    "fileName" => "php-micro.css",
                    "fileContent" => "It's will be automatically computed"
                ]
            ],
            "applicationParameters" => [
                "requireLogoutEvent" => false,
                "supportsMultipleInstances" => false
            ]

        ]
   ]
];
```

There are full of stories in web how to hide index.php, but always it's pient in ass to get right code.
add .htaccess into webroot:
```
RewriteEngine on
# If a directory or a file exists, use it directly
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
# Otherwise forward it to index.php
RewriteRule . index.php
```

Configure frontend routing:
```
'urlManager' => [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'enableStrictParsing' => false,
    'rules' => [
    ],
],
```

Configure front-end configuration:
```
$config['bootstrap'][] = 'microservice';
$config["modules"]["microservice"] = [
    'class' => 'hop\microservice\Module'
];
```

Once registration done start develop. In webroot write your angular code!!
