# Установка

* В `composer.json` добавить:
```
"repositories": [
    {
        "type": "vcs",
        "url": "git@bitbucket.org:Dok5/laravel-migration-helper.git"
    }
],

"require": {
    "dok5/laravel-migration-helper": "*"
  },
  
```

* При необходимости:

Публикация config-файла:

`php artisan vendor:publish --provider="Dok5\LangSwitcher\LangSwitcherServiceProvider" --tag=config`


Публикация представления:

`php artisan vendor:publish --provider="Dok5\LangSwitcher\LangSwitcherServiceProvider" --tag=view`