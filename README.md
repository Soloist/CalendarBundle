CalendarBundle
==============

A simple Calendar/Event CMS bundle

Status: hard-development

Dependances
-----------

  * SonataIntlBundle - To show date in your language
  * FrequenceWebDashboardBundle - Only for the admin part

Installation
------------

### 1) Add it to composer
Add it to the composer.json:
```JSON
    "soloist/calendar-bundle": "dev-master"
```

Load the installation:
```BASH
    composer install
```

### 2) Add it to your kernel
```PHP
// app/AppKernel.php

// ...

        $bundles = array(
            // ... your bundles ...
            new Soloist\Bundle\CalendarBundle\SoloistCalendarBundle(),
        );

// ...
```

### 3) Add it in your routing
```JSON
# Admin part, you can use your favorite admin prefix
# and add "soloist" in the prefix to be sure it will not override any part of your routes
SoloistCalendarBundle_backend:
    resource: "@SoloistCalendarBundle/Resources/config/routing_backend.xml"
    prefix:   /admin/soloist

# You should do the same operation for the front office
SoloistCalendarBundle_frontend:
    resource: "@SoloistCalendarBundle/Resources/config/routing_frontend.xml"
    prefix:   /
```
