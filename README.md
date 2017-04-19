# dev-odt

## Liste des paquets installés depuis composer
* composer require symfony/console
* composer require tecnickcom/tcpdf
* composer require phpoffice/phpword

## Ajout de l'espace de nom dans composer.json
    "autoload": {
        "psr-4": { 
        	"Odt\\": "src/"
        }
    }
Ensuite faire un update
   composer update
