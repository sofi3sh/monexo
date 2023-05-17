#Установка

* В `composer.json` добавить:
```
"repositories": [
    {
        "type": "vcs",
        "url": "git@bitbucket.org:Dok5/active-menu-item.git"
    }
],

"require": {
    ...,
    "dok5/active-menu-item": "*"
  },
```

#Использование
Функция
`function isActive(string $path, string $className = 'active')`
возваращает `active` (или заданное значение параметра `$className`), когда текущий маршрут (URI) совпадает с `$path`. 
```
<ul class="navbar-nav ml-auto">
                <li class="nav-item {{ isActive('/') }}">
                    <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
```