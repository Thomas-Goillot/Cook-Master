# mvc-php
Introduction au MVC en PHP


## Installation

1. Cloner le projet	
2. Installer les dépendances avec composer
```bash
composer install
composer dump-autoload
```


### Rules of database

* Event table :
``` place is the number of place available for the event
    place = 0 => no inscription needed
    place = -1 => unlimited place
```

