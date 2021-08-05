

## Steps for installation
- clone repo
- ``composer install ``
- ``copy .env from .env.example``
- ```php artisan migrate```
- ```php artisan serv && php artisan queue:work --timeout=0 --queue=feed_update```

