Google Translation Client
=========================
 
This is a minimalistic API client for Google Translation API

Installation
------------

Installation is conveniently provided via Composer.

To get started, install composer in your project:

```sh
$ curl -s https://getcomposer.org/installer | php
```

Next, add a composer.json file containing the following:

```js
}
    "require": {
        "google/translation-client": "dev-master"
    }
}
```

Finall, install!

```sh
$ php composer.phar install
```

Usage
-----

Using the Google Translation client is easy:

``` php
<?php

require_once '../src/Client.php';

try {
    $client = new Goolge_Translate('YOUR API KEY');
    $client->setSource('en')
        ->setTarget('gl')
        ->setText('If wishes were fishes, we\'d all cast nets')
        ->translate();
} catch (Exception $e) {
    echo $e->getMessage();
}

```