<?php

namespace App\Models;

class UserProperty
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Дата регистрации.
     *
     * @return \Illuminate\Support\Carbon|null
     */
    public function getDateRegistration()
    {
        return $this->user->created_at;
    }

    /**
     * Ваша почта.
     *
     * @return string
     */
    public function getYourEmail()
    {
        return $this->user->email;
    }

    /**
     * Наставник.
     *
     * @return mixed
     */
    public function getMentor()
    {
        return User::on()
            ->where('id', $this->user->parent_id)
            ->value('email');
    }

    /**
     * Страна текущего пользователя.
     *
     * @return string|null
     */
    public function getCountry()
    {
        return $this->user->country;
    }
}
