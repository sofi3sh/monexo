module.exports = {

    // проксировать запросы к API на этапе разработки
    devServer: {
        proxy: process.env.VUE_APP_HOST
    },

    // каталог, в котором при запуске vue-cli-service build будут создаваться файлы сборки для production
    outputDir: '../../../public/graybull',

    // базовый URL-адрес сборки приложения, по которому оно будет опубликовано
    publicPath: process.env.NODE_ENV === 'production'
        ? process.env.VUE_APP_BASE_URL
        : '/',

    // путь к сгенерированному index.html (относительно outputDir)
    indexPath: process.env.NODE_ENV === 'production'
        ? '../../Modules/Graybull/Resources/views/app.blade.php'
        : 'index.html',

    pages: {
        index: {
            // точка входа для страницы
            entry: 'src/main.js',

            // исходный шаблон
            template: 'src/public/index.html',

            // когда используется опция title, то <title> в шаблоне
            // должен быть <title><%= htmlWebpackPlugin.options.title %></title>
            title: 'Graybull',

            // все фрагменты, добавляемые на этой странице, по умолчанию
            // это извлечённые общий фрагмент и вендорный фрагмент.
            chunks: ['chunk-vendors', 'chunk-common', 'index']
        }
    }
}

process.env.NODE_ENV !== 'production' && console.log('\x1b[33m%s\x1b[0m', 'Game is here "/game"');
