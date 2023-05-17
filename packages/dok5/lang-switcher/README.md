#Общее
Код сделан на основе https://github.com/rappasoft/laravel-5-boilerplate.
#Установка

* В `composer.json` добавить:
```
"repositories": [
    {
        "type": "vcs",
        "url": "git@bitbucket.org:Dok5/lang-switcher.git"
    }
],

"require": {
    "dok5/lang-switcher": "1.1.0.x-dev"
  },
  
```

В представлении
@include('LangSwitcher::lang')

* При необходимости:

Публикация config-файла:

`php artisan vendor:publish --provider="Dok5\LangSwitcher\LangSwitcherServiceProvider" --tag=config`


Публикация представления:

`php artisan vendor:publish --provider="Dok5\LangSwitcher\LangSwitcherServiceProvider" --tag=view`