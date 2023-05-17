#Установка

В  `/root/.ssh/config`
```
Host laravel-referrals
HostName bitbucket.com
User git
IdentityFile ~/.ssh/id_rsa_laravel-referrals
IdentitiesOnly yes
```
В `composer.json`
```
"repositories": [
    {
      "type": "vcs",
      "url": "laravel-referrals:Dok5/laravel-referrals.git"
    }
  ],
  "require": {
      "dok5/laravel-referrals": "*"
  },
```

Публикация config-файла
php artisan vendor:publish --provider="Dok5\Referrals\ReferralsServiceProvider" --tag=config`
При необходимости в опубликованном файле изменить названия полей.

Публикация миграций
`php artisan vendor:publish --provider="Dok5\Referrals\ReferralsServiceProvider" --tag=migrations`