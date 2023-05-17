# Graybull (backend)

### Add to composer.json
```json
"autoload": {
    "psr-4": {
        ...
        "Modules\\": "Modules/"
    },
    ...
},
```

### Add to config/app.php > providers section
```php
Modules\Blog\Providers\BlogServiceProvider::class
```

### Add to database/seeds/DatabaseSeeder.php
```php
$this->call(\Modules\Blog\Database\Seeders\CategorySeeder::class);
```

### Run commands
```shell script
php artisan migrate --seed
```
