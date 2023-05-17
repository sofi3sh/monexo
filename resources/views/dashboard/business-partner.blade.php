@extends('dashboard.app')

@section('content')
        <div class="title">
            Предложение бизнес-партнерам
        </div>
        <div class="business-flex">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida
                dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis
                natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus
                pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget.Cum sociis natoque penatibus
                et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate,
                felis tellus mollis orci, sed rhoncus sapien nunc eget.Cum sociis natoque penatibus et magnis dis
                parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus
                mollis orci, sed rhoncus sapien nunc eget.Cum sociis natoque penatibus et magnis dis parturient montes.
            </p>
            <div class="investment-item investment-item_red">
                <div class="investment-pic">
                    <img src="{{asset('images/lk/action.png')}}" alt="">
                </div>
                <div class="investment-title">
                    Пакет акций
                </div>
                <div class="investment-profit">
                    <span>3% ежедневно</span>
                </div>
                <div class="investment-line">
                    <img src="{{asset('images/lk/action-pay.png')}}" alt="">
                    <span>Сумма: min 10$ - max 1000$</span>
                </div>
                <div class="investment-line">
                    <img src="{{asset('images/lk/action-hour.png')}}" alt="">
                    <span>Период: бессрочно</span>
                </div>
                <div class="investment-info">Комиссия на вывод 10%</div>
            </div>
        </div>
        <div class="block">
            <div class="title">Расчет доходности и покупка</div>
            <div class="business-calculate">
                <form action="#" class="calculate calculate-business">
                    <div class="calculate-summa">
                        <div class="calculate-summa__left">
                            <div class="calculate-label">Сумма</div>
                            <div class="calculate-input__container">
                                <input type="text" placeholder="0" id="slider-value2">
                                USD
                            </div>
                        </div>
                        <div class="calculate-summa__right">
                            <div class="calculate-slider">
                                <div id="slider2"></div>
                                <div class="calculate-slider__min calculate-slider__info">Min</div>
                                <div class="calculate-slider__max calculate-slider__info">Max</div>
                            </div>
                        </div>
                    </div>
                    <div class="calculate-summa">
                        <div class="calculate-summa__left">
                            <div class="calculate-label">Количество акций</div>
                            <div class="calculate-input__container">
                                <input type="text" placeholder="0" id="slider-value3">
                                USD
                            </div>
                        </div>
                        <div class="calculate-summa__right">
                            <div class="calculate-slider">
                                <div id="slider3"></div>
                                <div class="calculate-slider__min calculate-slider__info">Min</div>
                                <div class="calculate-slider__max calculate-slider__info">Max</div>
                            </div>
                        </div>
                    </div>
                    <div class="calculate-accruals">
                        <div class="calculate-accruals__item">
                            <div class="calculate-label">Выплаты в месяц</div>
                            <div class="calculate-input__container">
                                <input type="text" placeholder="0" >
                                USD
                            </div>
                        </div>
                        <div class="calculate-accruals__info">
                            <b>Внимание!</b> <br>
                            <p>Выплаты осуществляются ежедневно равными долями.
                                Период дейсвия - бессрочно.</p>
                        </div>
                    </div>
                    <input type="submit" class="btn btn_green btn-from__invest" value="Купить акции с основного баланса">
                </form>
                <div class="calculate-load">
                    <div class="calculate-load__title">Акци компании</div>
                    <div class="calculate-load__container">
                        <div class="calculate-load__number calculate-load__max">100%</div>
                        <div class="calculate-load__number calculate-load__average">50%</div>
                        <div class="calculate-load__number calculate-load__min">0%</div>
                        <div class="calculate-load__element">
                            <div class="calculate-load__element-absolute"></div>
                            <div class="calculate-load__element-text">Доступно к покупке</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block">
            <div class="title">
                Ваши акции компании Bet.pro
            </div>
            <div class="investment-items">
                <div class="investment-item investment-item_red">
                    <div class="investment-pic">
                        <img src="{{asset('images/lk/action.png')}}" alt="">
                    </div>
                    <div class="investment-title">
                        Пакет акций
                    </div>
                    <div class="investment-profit">
                        <span>3% ежедневно</span>
                    </div>
                    <div class="investment-line">
                        <img src="{{asset('images/lk/action-hous.png')}}" alt="">
                        <span>Количество: 20</span>
                    </div>
                    <div class="investment-line">
                        <img src="{{asset('images/lk/action-pay.png')}}" alt="">
                        <span>Сумма: min 10$ - max 1000$</span>
                    </div>
                    <div class="investment-line">
                        <img src="{{asset('images/lk/action-hour.png')}}" alt="">
                        <span>Период: бессрочно</span>
                    </div>
                    <div class="investment-info">Дата покупки: 12.12.2019</div>
                    <div class="investment-info">Следущая выплата: 11.01.2020</div>
                </div>
            </div>

        </div>
@endsection