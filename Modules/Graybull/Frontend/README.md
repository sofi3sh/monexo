# Graybull (frontend)

Copy **.env.development.local.example** to **.env.development.local**

Fill **VUE_APP_HOST** in **.env.development.local**

Check out **vue.config.js** file for more information

###### You must run commands from here Modules/Graybull/Frontend

### Project setup
```
yarn install
```

### Compiles and hot-reloads for development
```
yarn serve
```

###### In this mode, you will not have a user in the session
###### Quick option, playing with fake auth like 
```php
    public function __construct() // TODO remove
    {
        Auth::loginUsingId(66);
    }
```

### Compiles and minifies for production
```
yarn build
```

###### This will update the Modules/Graybull/Resources/views/app.blade.php file

### Lints and fixes files
```
yarn lint
```

### Customize configuration
See [Configuration Reference](https://cli.vuejs.org/config/).
