<?php

namespace App\Models\Home\Ticket;

use Illuminate\Database\Eloquent\Model;

class Appeal extends Model
{
    // Технические сложности
    public const TECHNICAL_DIFFICULTIES = 1;

    // Партнёрская программа +
    public const AFFILIATE_PROGRAM = 2;

    // Пассивный доход +
    public const PASSIVE_INCOME = 3;

    // Пополнение/Вывод
    public const DEPOSIT_WITHDRAWAL = 4;

    // Нововведения на сайте +
    public const SITE_INNOVATIONS = 5;

    // Продукты компании +
    public const PRODUCTS_COMPANY = 6;

    // События компании +
    public const COMPANY_EVENTS = 7;

    protected $table = 'appeal';

    protected $fillable = [
        'descr',
        'is_mentor',
    ];
}
