# Файл выполняется автоматически при выполнении скрипта композера post-autoload-dump

STORAGE_LINK=./public/storage

if [ ! -d "$STORAGE_LINK" ]; then
    php artisan storage:link
fi
