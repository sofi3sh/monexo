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
Modules\Graybull\Providers\GraybullServiceProvider::class
```

### Add to database/seeds/DatabaseSeeder.php
```php
$this->call(\Modules\Graybull\Database\Seeders\AlertTypeSeeder::class);
$this->call(\Modules\Graybull\Database\Seeders\TransactionTypeSeeder::class);
$this->call(\Modules\Graybull\Database\Seeders\BetCurrencySeeder::class);
```

### Run commands
```shell script
php artisan migrate --seed
```

### Add to Console/Kernel.php > schedule method
###### use Modules\Graybull\Services\GraybullService;
```php
$schedule->call(function () {
    GraybullService::controlBets();
})->everyMinute();
```

# Next go to Modules/Graybull/Frontend/README.md
