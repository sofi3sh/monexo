<?php

namespace App\Http\Controllers\Backend\ElChange;
use App\Http\Controllers\Controller;

/**
 * Класс, возвращающий курсы.
 *
 * Class ElChangeRateController
 * @package App\Http\Controllers\Backend\ElChange
 */
class ElChangeRateController extends Controller
{
    /**
     * Основная часть url чтения курсов
     *
     * @var string
     */
    protected $url = 'https://el-change.com/obmen/get_merchant_cources/';

    /**
     * Возвращает полный url для чтения курсов
     *
     * @return string
     */
    public function getFullUrl(): string
    {
        return $this->url . config('el-change.merchant_name');
    }

    /**
     * Возвращает курсы.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getRates()
    {
        try {
            return json_decode(@file_get_contents($this->getFullUrl()));
        } catch (\Exception $e) {
            $this->log('Ошибка чтения курсов.');
            throw new \Exception('Can\'t read rate.');
        }
    }
}