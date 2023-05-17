<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />

    <link rel="icon" type="image/svg+xml" href="{{ asset('monexo/monexo.svg') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('monexo/favicon-16x16.png') }}" />
    <meta name="msapplication-TileColor" content="#2C2C2C" />
    <meta name="theme-color" content="#2C2C2C" />
    <title>Monexo</title>
    <meta name="description" content="Your reliable partner in the world of investments" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Monexo" />
    <meta property="og:description" content="Your reliable partner in the world of investments" />
    <meta property="og:url" content="http://monexo-invest.com/" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="Monexo" />
    <meta name="twitter:description" content="Your reliable partner in the world of investments" />

    <script type="module" crossorigin src="{{ asset('monexo/assets/index-f4446379.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('monexo/assets/index-3a27ad46.css') }}">
    <script type="module">import.meta.url;import("_").catch(()=>1);async function* g(){};window.__vite_is_modern_browser=true;</script>
    <script type="module">!function(){if(window.__vite_is_modern_browser)return;console.warn("vite: loading legacy chunks, syntax error above and the same error below should be ignored");var e=document.getElementById("vite-legacy-polyfill"),n=document.createElement("script");n.src=e.src,n.onload=function(){System.import(document.getElementById('vite-legacy-entry').getAttribute('data-src'))},document.body.appendChild(n)}();</script>
    <style>
        @media (max-width: 800px){.service-check {order: 1;}} .partners-small-bg,.about-small-bg {display: none;} @media (max-width: 570px) {.partners-small-bg {margin-top: 20px;display: block;} .about-small-bg {margin-top: -40px;display: block;}}

        .presentation a {
            display: block;
            font-family: 'Everett';
            font-style: normal;
            font-weight: 500;
            font-size: 28px;
            line-height: 38px;
            color: #FFFFFF;
            text-decoration: none;
            transition: all 0.3s ease-in;

            margin-bottom: 30px;
        }

        .presentation a:hover,
        .presentation a:active,
        .presentation a:focus {
            color: #6425FE;
        }

        .footer-navigates {
            display: flex;
            justify-content: space-between;
            width: 65%;
            margin-left: 20px;
        }

        .footer-menu {
            margin: unset;
        }

        @media (max-width: 1200px) {
            .presentation a {
                font-size: 18px;
                line-height: 28px;
            }

            
            .footer-menu__item a {
                font-size: 18px;
                line-height: 28px;
            }
        }

        @media (max-width: 860px) {

            .presentation {
                margin-right: 32px;
            }

            .footer-navigates {
                width: 100%;
                justify-content: space-around;
            }
        }

        @media (max-width: 640px) {
            .footer-menu__item a {
                font-size: 18px;
                line-height: 28px;
            }
        }

        .popup {
            position: fixed;
            top: 0;
            width: 100%;
            height: 100vh;
            z-index: 1000;
            display: none;
        }

        .popup__overlay {
            background: #000000c9;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1001;
        }

        .popup__header {
            font-family: Everett;
            font-style: normal;
            font-weight: 500;
            font-size: 28px;
            line-height: 115.5%;
            color: #2c2c2c;
            margin-bottom: 34px;
        }

        .popup__body {
            position: relative;
            z-index: 1002;
            max-width: 400px;
            background: #B3EEC9;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 44px 24px 24px;
            border-radius: 10px;
        }

        .about-us__img-wrap::before {
            content: '';
            display: block;
            position: absolute;
            width: 360px;
            height: 120px;
            background: url('images/about/Screenshot.png') center center no-repeat;
            background-size: contain;
            top: -70%;
            left: -263%;
        }

        @media (max-width: 1028px) {
            .about-us__video {
                margin-right: -120px;
            }
        }

        @media (max-width: 809px) {
            .about-us__video {
                margin-right: 0;
            }
        }

        @media (max-width: 639px) {
            .about-us__img-wrap {
                display: block;
                margin-top: 60px;
                margin-left: 74px;
            }
            .about-us__img-wrap::before {
                top: -60%;
                left: -147px;
            }

            .about-us__img-wrap::after {
                right: unset;
                left: 63px;
            }
        }

        .slick-arrow {
            bottom: -40px;
        }

        .slider-paginatioin  {
            bottom: -44px;
        }
    </style>
</head>

<body>
<!-- mobile menu -->
<div class="mobile-navigatiion">
    <div class="mobile-menu-body">
        <div class="mobile-btn-block">
            <a href="{{ route('register') }}" class="btn linck-btn main-btn" style="width: 148px; text-decoration: none;">
                Registration
            </a>
            <a href="{{ route('login') }}" class="btn linck-btn secondary-btn" style="width: 148px; text-decoration: none;">
                Log in
            </a>
        </div>

        <nav>
            <ul class="mobile-menu" id="menu-mob">
                <li>
                    <a href="#home" class="mobile-menu__item active">Home</a>
                </li>
                <li>
                    <a href="#about" class="mobile-menu__item"
                    >About company</a
                    >
                </li>
                <li>
                    <a href="#offers" class="mobile-menu__item">Advantages</a>
                </li>
                <li>
                    <a href="#reviews" class="mobile-menu__item">Reviews</a>
                </li>
                <li>
                    <a href="#partners" class="mobile-menu__item">Partners</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<header class="header" id="header">
    <div class="container">
        <div class="header-container">
            <div class="logo">
                <a href="#home">
                    <img src="{{ asset('monexo/images/logo.png') }}" alt="logo"
                         class="logo__img" width="133" height="35" />
                </a>
            </div>

            <div class="burger-btn">
                <label for="burger-btn" class="checkbox__label"
                >Checkbox burger button</label
                >
                <input class="checkbox" type="checkbox" id="burger-btn" />
                <div class="hamburger-lines">
                    <span class="line line1"></span>
                    <span class="line line2"></span>
                    <span class="line line3"></span>
                </div>
            </div>

            <nav>
                <ul class="menu" id="menu">
                    <li data-menuanchor="home" class="active">
                        <a href="#home" class="menu__item">Home</a>
                    </li>
                    <li data-menuanchor="about">
                        <a class="menu__item" href="#about">About company</a>
                    </li>
                    <li data-menuanchor="offers">
                        <a class="menu__item" href="#offers">Advantages</a>
                    </li>
                    <li data-menuanchor="reviews">
                        <a class="menu__item" href="#reviews">Reviews</a>
                    </li>
                    <li data-menuanchor="partners">
                        <a class="menu__item" href="#partners">Partners</a>
                    </li>
                </ul>
            </nav>

            <div class="header-btn-grooup">
            @guest
                <a href="{{ route('register') }}" class="btn main-btn" style="text-decoration: none;">Registration</a>
                <a href="{{ route('login') }}" class="btn secondary-btn" style="margin-left: 20px;text-decoration: none;">
                    Log in
                </a>
            @else
                <a href="{{ route('home.main') }}" class="btn main-btn" style="margin-left: 20px;text-decoration: none;">
                    {{ Auth::user()->name }}
                </a>
            @endguest
            </div>
        </div>
    </div>
</header>

<main id="pagepiling" class="main">
    <div class="section">
        <section class="home-page page-container" id="home">
            <div class="container home-page-contemt">
                <div class="offer">
                    <h2 class="offer__sub-title">Turn on features</h2>
                    <h1 class="offer__title">
                        Get the most profit with Monexo
                    </h1>
                    <p class="offer__text">
                        Your capital grows by 300% due to automation in P2P
                        trading!
                    </p>

                    <button class="btn main-btn-big" id="openPopup">learn more</button>
                </div>
                <div class="top-img"></div>
                <div class="center-img"></div>
                <div class="bottom-img"></div>
            </div>
        </section>
    </div>
    <div class="section">
        <section class="about page-container" id="about">
            <div class="about__bg"></div>
            <div class="about__logo"></div>
            <div class="container about-container">
                <div class="about-us">
                    <h2 class="section-header about-us__title">
                        What is Monexo&#8209;invest?
                    </h2>
                    <p class="about-us__desc">
                        This is a convenient innovative solution for a passive
                        investor.
                    </p>
                    <p class="about-us__desc">
                        The investor gets a chance to grow his capital at the
                        expense of the most trending area - cryptocurrencies,
                        profit is generated by a farm of 4000 remote servers
                        that automatically work on P2P exchanges every day and
                        conduct hundreds of transactions in the field of crypto
                        P2P in india, china, saudi arabia.
                    </p>
                    <div class="about-us__video">
                        <span class="about-us__text">
                           Find out more by watching the video about our project
                        </span>
                        <div class="about-us__img-wrap">
                            <a href="https://youtu.be/4-CrGfX_rc8" target="_blank">
                                <img src="{{ asset('monexo/images/about/play.png') }}"
                                    class="about-us__play" alt="play image" width="57" height="57" />
                            </a>
                        </div>
                    </div>
                </div>

                <div class="about-small-bg">
                     <img
                        src="{{ asset('monexo/images/about/about_bg.webp') }}"
                        alt="background image" />
                  </div>
            </div>
        </section>
    </div>
    <div class="section">
        <section class="offers page-container" id="offers">
            <div class="container offers-container">
                <div class="row">
                    <div class="case">
                        <h2 class="section-header case__header">
                            What <br />
                            we offers?
                        </h2>
                        <p class="case__text">
                            Monexo connects ordinary investors and a farm of
                            4,000 remote machines on one platform, which
                            artificially creates excitement on P2P sites and
                            extracts the maximum spread from each transaction.
                        </p>
                        <p class="case__text">
                            We are all interested in the process - the investor
                            receives a high return, and monexo expands the
                            capabilities of its farm by connecting and
                            configuring new remote machines. Investor funds are a
                            very profitable way for us to generate excess profit
                            on P2P operations on a daily basis.
                        </p>
                    </div>

                    <div class="cards">
                        <div class="cards__btn-group">
                           <button class="btn secondary-btn active" data-target="Server1">
                              Server 1
                           </button>
                           <button class="btn secondary-btn" data-target="Server2">
                              Server 2
                           </button>
                           <button class="btn secondary-btn" data-target="Server3">
                              Server 3
                           </button>
                        </div>

                        <div class="cards__view">
                            
                        </div>

                        <div class="tab" id="Server1">
                            <div class="cards__item">
                                <h3 class="cards__header">Server 1</h3>
                                <ul class="cards__list">
                                    <li>Deposit included in payouts</li>
                                    <li>Compound interest: no</li>
                                </ul>
                                <div class="cards__content">
                                    <div class="colum cards__amount">
                                        <div class="table">
                                            <div class="table__header">
                                                <img
                                                    src="{{ asset('monexo/images/offers/amount.png') }}"
                                                    alt="amount"
                                                    width="24"
                                                    height="23" />
                                                <span>Amount</span>
                                            </div>
                                            <div class="table__body">
                                                <div class="table__ceil">
                                                    <p class="table__label">MINIMUM</p>
                                                    <p class="table__ticker">$100</p>
                                                </div>
                                                <div class="table__ceil">
                                                    <p class="table__label">MAXIMUM</p>
                                                    <p class="table__ticker">$1000</p>
                                                </div>
                                            </div>
                                            <div class="table__footer">
                                                <div
                                                    style="
                                                    display: flex;
                                                    align-items: center;
                                                ">
                                                    <img
                                                        src="{{ asset('monexo/images/offers/total.png') }}"
                                                        alt="total"
                                                        width="23"
                                                        height="20"
                                                        style="margin-right: 4px" />
                                                    <span>Period</span>
                                                </div>
                                                <span>indefinitely</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colum cards__profit">
                                        <div class="table">
                                            <div class="table__header">
                                                <img
                                                    src="{{ asset('monexo/images/offers/profit.png') }}"
                                                    alt="profit"
                                                    width="25"
                                                    height="23" />
                                                <span>Profit</span>
                                            </div>
                                            <div class="table__body">
                                                <div class="table__ceil">
                                                    <p class="table__label">MINIMUM</p>
                                                    <p class="table__ticker">0.95%</p>
                                                </div>
                                                <div class="table__ceil">
                                                    <p class="table__label">MAXIMUM</p>
                                                    <p class="table__ticker">1.1%</p>
                                                </div>
                                            </div>
                                            <div class="table__footer">
                                                <div
                                                    style="
                                                    display: flex;
                                                    align-items: center;
                                                ">
                                                    <img
                                                        src="{{ asset('monexo/images/offers/bonus.png') }}"
                                                        alt="bonus"
                                                        width="21"
                                                        height="23"
                                                        style="margin-right: 4px" />
                                                    <span>Income</span>
                                                </div>
                                                <span>every day</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab" id="Server2">
                            <div class="cards__item">
                                <h3 class="cards__header">Server 2</h3>
                                <ul class="cards__list">
                                    <li>The body of the deposit is returned at the end of the term, (or 15% commission)</li>
                                    <li>Compound interest: yes</li>
                                </ul>
                                <div class="cards__content">
                                    <div class="colum cards__amount">
                                        <div class="table">
                                            <div class="table__header">
                                                <img
                                                    src="{{ asset('monexo/images/offers/amount.png') }}"
                                                    alt="amount"
                                                    width="24"
                                                    height="23" />
                                                <span>Amount</span>
                                            </div>
                                            <div class="table__body">
                                                <div class="table__ceil">
                                                    <p class="table__label">MINIMUM</p>
                                                    <p class="table__ticker">$500</p>
                                                </div>
                                                <div class="table__ceil">
                                                    <p class="table__label">MAXIMUM</p>
                                                    <p class="table__ticker">$25 000</p>
                                                </div>
                                            </div>
                                            <div class="table__footer">
                                                <div
                                                    style="
                                                    display: flex;
                                                    align-items: center;
                                                ">
                                                    <img
                                                        src="{{ asset('monexo/images/offers/total.png') }}"
                                                        alt="total"
                                                        width="23"
                                                        height="20"
                                                        style="margin-right: 4px" />
                                                    <span>Period</span>
                                                </div>
                                                <span>endlessly</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colum cards__profit">
                                        <div class="table">
                                            <div class="table__header">
                                                <img
                                                    src="{{ asset('monexo/images/offers/profit.png') }}"
                                                    alt="profit"
                                                    width="25"
                                                    height="23" />
                                                <span>Profit</span>
                                            </div>
                                            <div class="table__body">
                                          <div class="table__ceil">
                                             <p class="table__label">in week</p>
                                             <p class="table__ticker">5 - 7%</p>
                                          </div>
                                          <div class="table__ceil">
                                             <p class="table__label">per month</p>
                                             <p class="table__ticker">20 - 28%</p>
                                          </div>
                                       </div>
                                            <div class="table__footer">
                                                <div
                                                    style="
                                                    display: flex;
                                                    align-items: center;
                                                ">
                                                    <img
                                                        src="{{ asset('monexo/images/offers/bonus.png') }}"
                                                        alt="bonus"
                                                        width="21"
                                                        height="23"
                                                        style="margin-right: 4px" />
                                                    <span>Income</span>
                                                </div>
                                                <span>every week</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab" id="Server3">
                            <div class="cards__item">
                                <h3 class="cards__header">Server 3</h3>
                                <ul class="cards__list">
                                    <li>Deposit included in payouts</li>
                                    <li>Compound interest: no</li>
                                </ul>
                                <div class="cards__content">
                                    <div class="colum cards__amount">
                                        <div class="table">
                                            <div class="table__header">
                                                <img
                                                    src="{{ asset('monexo/images/offers/amount.png') }}"
                                                    alt="amount"
                                                    width="24"
                                                    height="23" />
                                                <span>Amount</span>
                                            </div>
                                            <div class="table__body">
                                                <div class="table__ceil">
                                                    <p class="table__label">MINIMUM</p>
                                                    <p class="table__ticker">$20</p>
                                                </div>
                                                <div class="table__ceil">
                                                    <p class="table__label">MAXIMUM</p>
                                                    <p class="table__ticker">$10 000</p>
                                                </div>
                                            </div>
                                            <div class="table__footer">
                                                <div
                                                    style="
                                                    display: flex;
                                                    align-items: center;
                                                ">
                                                    <img
                                                        src="{{ asset('monexo/images/offers/total.png') }}"
                                                        alt="total"
                                                        width="23"
                                                        height="20"
                                                        style="margin-right: 4px" />
                                                    <span>Period</span>
                                                </div>
                                                <span>220 days</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colum cards__profit">
                                        <div class="table">
                                            <div class="table__header">
                                                <img
                                                    src="{{ asset('monexo/images/offers/profit.png') }}"
                                                    alt="profit"
                                                    width="25"
                                                    height="23" />
                                                <span>Profit</span>
                                            </div>
                                            <div class="table__body">
                                                <div class="table__ceil">
                                                    <p class="table__label">average</p>
                                                    <p class="table__ticker">0.5 - 2%</p>
                                                </div>
                                                <div class="table__ceil">
                                                    <p class="table__label">per month</p>
                                                    <p class="table__ticker">≈ 33%</p>
                                                </div>
                                            </div>
                                            <div class="table__footer">
                                                <div
                                                    style="
                                                    display: flex;
                                                    align-items: center;
                                                ">
                                                    <img
                                                        src="{{ asset('monexo/images/offers/bonus.png') }}"
                                                        alt="bonus"
                                                        width="21"
                                                        height="23"
                                                        style="margin-right: 4px" />
                                                    <span>Income</span>
                                                </div>
                                                <span>every day</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="section">
        <section class="start-investing page-container" id="investing">
            <div class="container invest-bg">
                <img
                    src="{{ asset('monexo/images/invest/mony.webp') }}"
                    alt="background image"
                    class="invest-bg__img" />
                <h2 class="section-header start-investing__header">
                    How to start investing?
                </h2>
                <p class="start-investing__text">In 4 easy steps</p>
                <div class="wallk-animation">
                    <svg
                        width="1041"
                        height="581"
                        class="shoe-marks"
                        viewBox="0 0 1041 581"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M139.768 132.841C138.463 131.552 138.042 130.328 138.515 129.194C138.988 128.06 140.349 127.027 142.785 125.976C146.375 124.427 150.223 123.933 153.618 124.586C155.618 124.971 157.316 125.729 158.529 126.779C159.568 127.678 160.454 129.205 158.778 131.373C157.729 132.73 155.855 134.058 153.635 135.015C150.956 136.171 148.49 136.533 146.096 136.121C144.194 135.794 142.4 134.982 140.757 133.708C140.399 133.429 140.069 133.14 139.768 132.841ZM131.487 137.964C130.724 137.211 130.283 136.356 130.223 135.494C130.142 134.249 130.87 133.172 132.248 132.498C133.231 132.021 134.241 131.869 135.338 132.031C137.119 132.295 138.455 133.28 139.87 134.321C140.02 134.431 140.17 134.543 140.325 134.655C140.653 134.895 141.009 135.134 141.354 135.365C142.646 136.233 143.984 137.132 144.014 138.167C144.035 138.86 143.443 139.416 142.209 139.872C140.784 140.397 139.014 140.576 137.224 140.377C135.297 140.162 133.531 139.534 132.251 138.608C131.969 138.404 131.713 138.188 131.487 137.964ZM161.374 144.718C161.075 144.42 160.805 144.114 160.568 143.802C159.477 142.378 159.207 141.148 159.768 140.147C160.471 138.886 162.437 138.031 165.787 137.537C168.561 137.126 171.721 137.071 174.454 137.387C178.818 137.891 180.744 139.135 181.594 140.092C182.578 141.201 182.827 142.354 182.312 143.429C181.433 145.264 178.468 146.642 173.963 147.309C170.92 147.759 168.531 147.764 166.449 147.321C164.366 146.878 162.679 146.007 161.374 144.718ZM148.574 145.373C148.348 145.149 148.152 144.918 147.988 144.682C147.245 143.607 147.248 142.493 148 141.547C148.698 140.666 149.984 140.008 151.621 139.693C153.043 139.42 154.256 139.481 155.344 139.883C156.966 140.483 157.633 141.564 158.276 142.61C158.449 142.889 158.626 143.177 158.819 143.454L159.09 143.838C159.94 145.034 160.744 146.164 160.153 147.079C159.79 147.642 158.976 147.989 157.666 148.141C155.818 148.351 153.7 148.054 151.773 147.314C150.436 146.797 149.334 146.124 148.574 145.373Z"
                            fill="#6425FE"
                            fill-opacity="0.38"
                            id="step-2" />

                        <path
                            d="M0.767637 159.841C-0.536744 158.552 -0.958482 157.328 -0.48504 156.194C-0.0115973 155.06 1.34945 154.027 3.78526 152.976C7.37536 151.427 11.2229 150.933 14.6184 151.586C16.618 151.971 18.3163 152.729 19.5287 153.779C20.5678 154.678 21.4536 156.205 19.7785 158.373C18.7295 159.73 16.8547 161.058 14.6353 162.015C11.9564 163.171 9.48977 163.533 7.09573 163.121C5.19434 162.794 3.39965 161.982 1.75716 160.708C1.39937 160.429 1.06863 160.14 0.767637 159.841ZM-7.51341 164.964C-8.2755 164.211 -8.71704 163.356 -8.77672 162.494C-8.85809 161.249 -8.13039 160.172 -6.75175 159.498C-5.76922 159.021 -4.75912 158.869 -3.66226 159.031C-1.88104 159.295 -0.544671 160.28 0.87043 161.321C1.01958 161.431 1.17046 161.543 1.32542 161.655C1.65346 161.895 2.00918 162.134 2.35448 162.365C3.64642 163.233 4.98356 164.132 5.01382 165.167C5.03506 165.86 4.44275 166.416 3.20932 166.872C1.78439 167.397 0.0141338 167.576 -1.77615 167.377C-3.70264 167.162 -5.469 166.534 -6.74945 165.608C-7.03092 165.404 -7.28677 165.188 -7.51341 164.964ZM22.3744 171.718C22.0745 171.42 21.8051 171.114 21.5683 170.802C20.4772 169.378 20.2073 168.148 20.768 167.147C21.4706 165.886 23.4374 165.031 26.7869 164.537C29.5613 164.126 32.7208 164.071 35.4537 164.387C39.8177 164.891 41.7442 166.135 42.5945 167.092C43.578 168.201 43.8265 169.354 43.312 170.429C42.4335 172.264 39.4677 173.642 34.9625 174.309C31.9202 174.759 29.5313 174.764 27.4489 174.321C25.3665 173.878 23.6788 173.007 22.3744 171.718ZM9.57389 172.373C9.34774 172.149 9.15169 171.918 8.98847 171.682C8.24456 170.607 8.2479 169.493 9.00039 168.547C9.69802 167.666 10.9837 167.008 12.6209 166.693C14.0432 166.42 15.256 166.481 16.3438 166.883C17.9662 167.483 18.6328 168.564 19.2762 169.61C19.4486 169.889 19.6259 170.177 19.8186 170.454L20.09 170.838C20.94 172.034 21.7444 173.164 21.1535 174.079C20.7904 174.642 19.976 174.989 18.6663 175.141C16.8177 175.351 14.6998 175.054 12.7729 174.314C11.4363 173.797 10.3337 173.124 9.57389 172.373Z"
                            fill="#6425FE"
                            fill-opacity="0.38"
                            id="step-1" />

                        <path
                            d="M308.012 107.25C306.521 104.831 306.335 102.833 307.464 101.299C308.592 99.7656 311.02 98.7108 315.073 98.0213C321.046 97.0059 327.019 97.6741 331.892 99.9026C334.761 101.215 337.04 102.979 338.48 105.005C339.715 106.739 340.488 109.363 337.171 112.012C335.094 113.671 331.785 114.982 328.092 115.609C323.636 116.366 319.789 116.007 316.336 114.509C313.593 113.319 311.189 111.438 309.184 108.918C308.747 108.367 308.355 107.81 308.012 107.25ZM293.666 111.925C292.795 110.511 292.443 109.063 292.67 107.744C293.004 105.839 294.494 104.485 296.817 103.975C298.471 103.617 300.048 103.759 301.64 104.406C304.224 105.457 305.875 107.429 307.624 109.516C307.808 109.736 307.994 109.959 308.186 110.186C308.592 110.666 309.04 111.157 309.475 111.632C311.102 113.413 312.785 115.256 312.451 116.826C312.229 117.876 311.133 118.497 309.109 118.731C306.771 118.998 304.04 118.618 301.418 117.662C298.596 116.633 296.168 115.038 294.58 113.174C294.231 112.764 293.925 112.346 293.666 111.925ZM336.185 133.055C335.843 132.497 335.549 131.937 335.307 131.382C334.187 128.837 334.232 126.886 335.443 125.584C336.963 123.945 340.238 123.379 345.462 123.863C349.789 124.262 354.566 125.338 358.564 126.817C364.95 129.176 367.394 131.755 368.323 133.508C369.397 135.538 369.348 137.365 368.179 138.795C366.184 141.235 361.213 142.222 354.186 141.574C349.441 141.136 345.843 140.266 342.87 138.836C339.897 137.406 337.676 135.475 336.185 133.055ZM316.673 129.346C316.415 128.927 316.205 128.507 316.045 128.092C315.32 126.201 315.733 124.525 317.213 123.376C318.587 122.306 320.764 121.786 323.344 121.913C325.585 122.023 327.389 122.56 328.879 123.565C331.102 125.062 331.709 126.936 332.294 128.746C332.451 129.23 332.612 129.728 332.801 130.215L333.069 130.892C333.909 133.006 334.706 135.002 333.481 136.162C332.728 136.876 331.374 137.101 329.347 136.849C326.487 136.487 323.407 135.263 320.778 133.443C318.955 132.174 317.542 130.756 316.673 129.346Z"
                            fill="#6425FE"
                            fill-opacity="0.38"
                            id="step-3" />

                        <path
                            d="M485.012 59.2504C483.521 56.8307 483.335 54.8334 484.464 53.2995C485.592 51.7656 488.02 50.7108 492.073 50.0213C498.046 49.0059 504.019 49.6741 508.892 51.9026C511.761 53.2147 514.04 54.9792 515.48 57.0051C516.715 58.7395 517.488 61.3626 514.171 64.0119C512.094 65.6709 508.785 66.9817 505.092 67.6086C500.636 68.3662 496.789 68.0066 493.336 66.5086C490.593 65.3192 488.189 63.4385 486.184 60.918C485.747 60.3673 485.355 59.8099 485.012 59.2504ZM470.666 63.9251C469.795 62.5114 469.443 61.0633 469.67 59.7435C470.004 57.8388 471.494 56.4845 473.817 55.9749C475.471 55.6174 477.048 55.7586 478.64 56.4058C481.224 57.4571 482.875 59.429 484.624 61.5157C484.808 61.7359 484.994 61.9593 485.186 62.1857C485.592 62.6664 486.04 63.1567 486.475 63.6322C488.102 65.4131 489.785 67.2556 489.451 68.8257C489.229 69.8764 488.133 70.4968 486.109 70.7309C483.771 70.9979 481.04 70.6184 478.418 69.6619C475.596 68.6327 473.168 67.038 471.58 65.1743C471.231 64.7641 470.925 64.3458 470.666 63.9251ZM513.185 85.0555C512.843 84.4965 512.549 83.9371 512.307 83.3817C511.187 80.8371 511.232 78.8865 512.443 77.5843C513.963 75.9445 517.238 75.3785 522.462 75.8633C526.789 76.2616 531.566 77.3385 535.564 78.8165C541.95 81.1762 544.394 83.7549 545.323 85.5078C546.397 87.5376 546.348 89.3652 545.179 90.7946C543.184 93.2353 538.213 94.2221 531.186 93.5742C526.441 93.1356 522.843 92.2658 519.87 90.8358C516.897 89.4058 514.676 87.4752 513.185 85.0555ZM493.673 81.3463C493.415 80.9267 493.205 80.5068 493.045 80.0923C492.32 78.2007 492.733 76.5249 494.213 75.3763C495.587 74.3058 497.764 73.7864 500.344 73.9132C502.585 74.0235 504.389 74.5601 505.879 75.5652C508.102 77.0624 508.709 78.9356 509.294 80.7462C509.451 81.2296 509.612 81.7281 509.801 82.215L510.069 82.8923C510.909 85.006 511.706 87.0023 510.481 88.1622C509.728 88.8762 508.374 89.101 506.347 88.8485C503.487 88.4871 500.407 87.2631 497.778 85.4426C495.955 84.1736 494.542 82.7557 493.673 81.3463Z"
                            fill="#6425FE"
                            fill-opacity="0.38"
                            id="step-4" />

                        <path
                            d="M642.47 35.2064C640.873 32.8552 640.599 30.868 641.659 29.2856C642.718 27.7032 645.097 26.5419 649.115 25.6735C655.037 24.3944 661.034 24.7972 666.001 26.8076C668.926 27.9913 671.28 29.6531 672.809 31.6131C674.119 33.2911 675.008 35.8773 671.812 38.6711C669.81 40.4205 666.562 41.8766 662.901 42.6666C658.482 43.621 654.624 43.4321 651.107 42.0886C648.315 41.0219 645.83 39.2496 643.714 36.8205C643.254 36.2896 642.838 35.7501 642.47 35.2064ZM628.345 40.5123C627.412 39.1385 626.997 37.7074 627.165 36.3789C627.414 34.4613 628.843 33.0423 631.141 32.4302C632.778 31.9997 634.359 32.071 635.978 32.647C638.607 33.5827 640.343 35.4795 642.183 37.4867C642.376 37.6985 642.572 37.9134 642.774 38.1311C643.201 38.5933 643.67 39.0633 644.126 39.5191C645.83 41.2262 647.593 42.9922 647.329 44.5756C647.154 45.635 646.086 46.3034 644.075 46.627C641.751 46.9974 639.006 46.7393 636.344 45.8999C633.479 44.9967 630.983 43.5112 629.313 41.7197C628.947 41.3254 628.622 40.921 628.345 40.5123ZM671.759 59.7377C671.392 59.1944 671.074 58.6485 670.808 58.1044C669.576 55.6119 669.534 53.6613 670.687 52.3068C672.132 50.6012 675.379 49.8906 680.619 50.1435C684.96 50.3495 689.78 51.2137 693.84 52.5132C700.323 54.5875 702.879 57.0554 703.885 58.7654C705.048 60.7456 705.08 62.5736 703.976 64.0534C702.09 66.5802 697.169 67.7863 690.12 67.4504C685.36 67.2225 681.726 66.5129 678.693 65.2161C675.66 63.9192 673.355 62.0889 671.759 59.7377ZM652.102 56.8968C651.825 56.4891 651.596 56.0788 651.419 55.6718C650.61 53.8142 650.949 52.1218 652.377 50.9087C653.701 49.7785 655.853 49.163 658.437 49.1754C660.681 49.1862 662.506 49.6424 664.039 50.5805C666.326 51.9777 667.016 53.8221 667.68 55.6051C667.859 56.081 668.042 56.5719 668.252 57.0499L668.55 57.7147C669.483 59.7891 670.367 61.7481 669.195 62.9611C668.474 63.7079 667.132 63.9925 665.095 63.83C662.222 63.5957 659.091 62.5093 656.384 60.8072C654.507 59.6202 653.032 58.2663 652.102 56.8968Z"
                            fill="#6425FE"
                            fill-opacity="0.38"
                            id="step-5" />

                        <path
                            d="M825.952 62.3601C828.391 63.8191 829.478 65.5054 829.184 67.387C828.89 69.2687 827.223 71.3245 823.945 73.806C819.114 77.4625 813.506 79.6255 808.155 79.8962C805.004 80.056 802.168 79.5417 799.956 78.4087C798.06 77.4396 796.164 75.4692 797.884 71.5883C798.962 69.1581 801.293 66.4684 804.28 64.2087C807.885 61.4803 811.463 60.0249 815.218 59.7608C818.2 59.5507 821.201 60.1102 824.143 61.4212C824.784 61.7085 825.389 62.0223 825.952 62.3601ZM836.523 51.5941C837.948 52.4465 838.928 53.5692 839.336 54.8446C839.919 56.6887 839.221 58.5779 837.395 60.1017C836.092 61.182 834.629 61.784 832.918 61.9441C830.14 62.2039 827.765 61.216 825.251 60.1713C824.986 60.0609 824.718 59.9487 824.443 59.8363C823.861 59.5972 823.237 59.3688 822.632 59.1476C820.367 58.3179 818.024 57.46 817.596 55.9128C817.308 54.8781 817.994 53.8222 819.682 52.6806C821.633 51.3652 824.231 50.442 826.999 50.0809C829.977 49.6922 832.867 49.9867 835.136 50.9075C835.635 51.1104 836.1 51.3403 836.523 51.5941ZM789.051 52.4629C789.613 52.801 790.131 53.162 790.602 53.543C792.77 55.2838 793.63 57.035 793.156 58.7492C792.564 60.9053 789.92 62.9183 785.061 64.8981C781.038 66.5414 776.303 67.7897 772.074 68.323C765.32 69.1753 761.962 68.015 760.329 66.8884C758.44 65.5831 757.64 63.939 758.017 62.1315C758.662 59.0454 762.617 55.8768 769.15 53.2096C773.563 51.4095 777.156 50.5213 780.454 50.4186C783.751 50.3158 786.612 51.0039 789.051 52.4629ZM808.073 46.7522C808.496 47.0052 808.877 47.2808 809.209 47.575C810.726 48.9185 811.132 50.5961 810.349 52.298C809.624 53.8813 807.932 55.3465 805.584 56.4244C803.545 57.3607 801.697 57.7166 799.911 57.5123C797.249 57.2094 795.846 55.8275 794.492 54.4909C794.129 54.1345 793.756 53.7667 793.364 53.4218L792.814 52.9444C791.093 51.4569 789.465 50.0533 790.017 48.4591C790.356 47.4781 791.453 46.6542 793.368 45.9429C796.072 44.9441 799.369 44.6093 802.542 45.0113C804.745 45.2963 806.653 45.9023 808.073 46.7522Z"
                            fill="#6425FE"
                            fill-opacity="0.38"
                            id="step-6" />

                        <path
                            d="M864.26 129.519C862.165 127.599 861.439 125.729 862.106 123.945C862.772 122.161 864.819 120.482 868.528 118.711C873.996 116.1 879.924 115.109 885.221 115.92C888.34 116.398 891.014 117.472 892.953 119.027C894.615 120.357 896.077 122.669 893.611 126.124C892.066 128.288 889.242 130.454 885.861 132.067C881.782 134.014 877.983 134.72 874.252 134.224C871.289 133.83 868.462 132.678 865.844 130.802C865.273 130.392 864.744 129.963 864.26 129.519ZM851.74 137.939C850.515 136.817 849.781 135.52 849.638 134.189C849.439 132.266 850.502 130.555 852.597 129.43C854.09 128.634 855.645 128.338 857.353 128.525C860.127 128.83 862.254 130.275 864.507 131.804C864.744 131.965 864.984 132.129 865.231 132.295C865.753 132.646 866.318 132.995 866.866 133.333C868.918 134.602 871.041 135.913 871.149 137.515C871.223 138.586 870.339 139.483 868.456 140.262C866.28 141.158 863.549 141.54 860.766 141.337C857.77 141.118 854.998 140.249 852.961 138.89C852.513 138.591 852.104 138.273 851.74 137.939ZM898.417 146.635C897.935 146.191 897.5 145.733 897.115 145.265C895.341 143.124 894.851 141.236 895.66 139.652C896.674 137.659 899.669 136.219 904.826 135.257C909.098 134.456 913.987 134.185 918.237 134.514C925.024 135.037 928.08 136.849 929.453 138.281C931.042 139.94 931.494 141.711 930.761 143.406C929.509 146.299 924.998 148.608 918.061 149.906C913.377 150.782 909.678 150.929 906.428 150.367C903.177 149.805 900.512 148.555 898.417 146.635ZM878.635 148.404C878.271 148.071 877.954 147.724 877.688 147.369C876.472 145.748 876.412 144.023 877.521 142.514C878.55 141.108 880.501 140.013 883.018 139.43C885.204 138.923 887.086 138.946 888.794 139.505C891.341 140.337 892.437 141.973 893.495 143.555C893.779 143.976 894.07 144.412 894.385 144.829L894.828 145.407C896.214 147.21 897.526 148.912 896.665 150.363C896.136 151.256 894.896 151.842 892.877 152.154C890.027 152.588 886.73 152.253 883.703 151.221C881.602 150.499 879.855 149.522 878.635 148.404Z"
                            fill="#6425FE"
                            fill-opacity="0.38"
                            id="step-7" />

                        <path
                            d="M875.932 204.631C878.134 206.428 878.965 208.254 878.401 210.073C877.838 211.892 875.89 213.685 872.288 215.665C866.978 218.583 861.115 219.91 855.782 219.402C852.641 219.104 849.909 218.184 847.885 216.742C846.149 215.508 844.558 213.284 846.823 209.693C848.242 207.445 850.938 205.122 854.221 203.319C858.183 201.142 861.935 200.22 865.688 200.503C868.669 200.727 871.557 201.716 874.278 203.439C874.871 203.817 875.424 204.215 875.932 204.631ZM887.952 195.51C889.239 196.56 890.046 197.813 890.265 199.134C890.573 201.043 889.609 202.811 887.582 204.054C886.136 204.935 884.601 205.318 882.885 205.229C880.098 205.083 877.892 203.761 875.556 202.363C875.31 202.216 875.061 202.066 874.805 201.915C874.264 201.594 873.68 201.277 873.113 200.971C870.993 199.822 868.798 198.633 868.599 197.04C868.464 195.975 869.296 195.029 871.131 194.145C873.252 193.126 875.957 192.589 878.747 192.633C881.751 192.68 884.568 193.39 886.679 194.63C887.143 194.903 887.57 195.198 887.952 195.51ZM840.855 189.49C841.362 189.906 841.823 190.338 842.234 190.783C844.126 192.82 844.723 194.677 844.006 196.305C843.108 198.352 840.2 199.961 835.106 201.216C830.886 202.258 826.021 202.807 821.759 202.722C814.953 202.586 811.798 200.952 810.346 199.6C808.665 198.035 808.112 196.292 808.748 194.559C809.833 191.599 814.205 189.037 821.056 187.344C825.683 186.203 829.368 185.845 832.645 186.221C835.922 186.597 838.654 187.693 840.855 189.49ZM860.504 186.596C860.886 186.908 861.223 187.236 861.509 187.575C862.815 189.124 862.974 190.843 861.952 192.413C861.005 193.875 859.119 195.079 856.64 195.806C854.486 196.436 852.606 196.521 850.869 196.06C848.278 195.374 847.091 193.804 845.945 192.285C845.638 191.88 845.322 191.462 844.984 191.064L844.509 190.512C843.022 188.79 841.614 187.166 842.391 185.668C842.869 184.747 844.074 184.091 846.072 183.664C848.892 183.068 852.203 183.215 855.284 184.072C857.422 184.673 859.222 185.55 860.504 186.596Z"
                            fill="#6425FE"
                            fill-opacity="0.38"
                            id="step-8" />

                        <path
                            d="M736.932 217.631C739.134 219.428 739.965 221.254 739.401 223.073C738.838 224.892 736.89 226.685 733.288 228.665C727.978 231.583 722.115 232.91 716.782 232.402C713.641 232.104 710.909 231.184 708.885 229.742C707.149 228.508 705.558 226.284 707.823 222.693C709.242 220.445 711.938 218.122 715.221 216.319C719.183 214.142 722.935 213.22 726.688 213.503C729.669 213.727 732.557 214.716 735.278 216.439C735.871 216.817 736.424 217.215 736.932 217.631ZM748.952 208.51C750.239 209.56 751.046 210.813 751.265 212.134C751.573 214.043 750.609 215.811 748.582 217.054C747.136 217.935 745.601 218.318 743.885 218.229C741.098 218.083 738.892 216.761 736.556 215.363C736.31 215.216 736.061 215.066 735.805 214.915C735.264 214.594 734.68 214.277 734.113 213.971C731.993 212.822 729.798 211.633 729.599 210.04C729.464 208.975 730.296 208.029 732.131 207.145C734.252 206.126 736.957 205.589 739.747 205.633C742.751 205.68 745.568 206.39 747.679 207.63C748.143 207.903 748.57 208.198 748.952 208.51ZM701.855 202.49C702.362 202.906 702.823 203.338 703.234 203.783C705.126 205.82 705.723 207.677 705.006 209.305C704.108 211.352 701.2 212.961 696.106 214.216C691.886 215.258 687.021 215.807 682.759 215.722C675.953 215.586 672.798 213.952 671.346 212.6C669.665 211.035 669.112 209.292 669.748 207.559C670.833 204.599 675.205 202.037 682.056 200.344C686.683 199.203 690.368 198.845 693.645 199.221C696.922 199.597 699.654 200.693 701.855 202.49ZM721.504 199.596C721.886 199.908 722.223 200.236 722.509 200.575C723.815 202.124 723.974 203.843 722.952 205.413C722.005 206.875 720.119 208.079 717.64 208.806C715.486 209.436 713.606 209.521 711.869 209.06C709.278 208.374 708.091 206.804 706.945 205.285C706.638 204.88 706.322 204.462 705.984 204.064L705.509 203.512C704.022 201.79 702.614 200.166 703.391 198.668C703.869 197.747 705.074 197.091 707.072 196.664C709.892 196.068 713.203 196.215 716.284 197.072C718.422 197.673 720.222 198.55 721.504 199.596Z"
                            fill="#6425FE"
                            fill-opacity="0.38"
                            id="step-9" />

                        <path
                            d="M600.621 266.498C598.02 268.095 596.875 269.919 597.213 271.935C597.552 273.952 599.367 276.139 602.917 278.762C608.149 282.629 614.197 284.882 619.945 285.106C623.331 285.239 626.369 284.652 628.73 283.408C630.753 282.344 632.765 280.205 630.87 276.06C629.683 273.464 627.147 270.605 623.912 268.215C620.008 265.331 616.148 263.812 612.113 263.575C608.909 263.386 605.694 264.024 602.552 265.468C601.867 265.784 601.221 266.129 600.621 266.498ZM589.138 255.07C587.619 256.003 586.58 257.22 586.158 258.594C585.556 260.581 586.328 262.601 588.307 264.215C589.719 265.359 591.298 265.987 593.137 266.138C596.123 266.382 598.66 265.292 601.346 264.14C601.63 264.018 601.916 263.894 602.21 263.77C602.832 263.506 603.499 263.253 604.146 263.008C606.567 262.089 609.073 261.139 609.513 259.473C609.809 258.358 609.06 257.233 607.233 256.028C605.123 254.64 602.322 253.681 599.346 253.327C596.143 252.947 593.044 253.299 590.619 254.315C590.086 254.539 589.59 254.792 589.138 255.07ZM640.118 255.417C639.519 255.787 638.967 256.18 638.466 256.595C636.16 258.491 635.258 260.382 635.788 262.217C636.45 264.524 639.314 266.653 644.555 268.718C648.895 270.433 653.994 271.715 658.541 272.235C665.803 273.067 669.394 271.78 671.134 270.55C673.146 269.125 673.984 267.35 673.557 265.414C672.826 262.109 668.541 258.756 661.494 255.973C656.734 254.094 652.865 253.185 649.323 253.116C645.782 253.046 642.718 253.82 640.118 255.417ZM619.624 249.52C619.173 249.797 618.768 250.097 618.415 250.417C616.803 251.879 616.388 253.685 617.249 255.502C618.047 257.193 619.882 258.746 622.416 259.874C624.617 260.854 626.605 261.213 628.52 260.972C631.375 260.614 632.864 259.113 634.301 257.661C634.686 257.274 635.082 256.874 635.499 256.499L636.084 255.98C637.913 254.362 639.643 252.835 639.031 251.13C638.656 250.081 637.467 249.21 635.402 248.47C632.486 247.431 628.942 247.112 625.541 247.583C623.18 247.916 621.139 248.59 619.624 249.52Z"
                            fill="#6425FE"
                            fill-opacity="0.38"
                            id="step-10" />

                        <path
                            d="M760.621 340.498C758.02 342.095 756.875 343.919 757.213 345.935C757.552 347.952 759.367 350.139 762.917 352.762C768.149 356.629 774.197 358.882 779.945 359.106C783.331 359.239 786.369 358.652 788.73 357.408C790.753 356.344 792.765 354.205 790.87 350.06C789.683 347.464 787.147 344.605 783.912 342.215C780.008 339.331 776.148 337.812 772.113 337.575C768.909 337.386 765.694 338.024 762.552 339.468C761.867 339.784 761.221 340.129 760.621 340.498ZM749.138 329.07C747.619 330.003 746.58 331.22 746.158 332.594C745.556 334.581 746.328 336.601 748.307 338.215C749.719 339.359 751.298 339.987 753.137 340.138C756.123 340.382 758.66 339.292 761.346 338.14C761.63 338.018 761.916 337.894 762.21 337.77C762.832 337.506 763.499 337.253 764.146 337.008C766.567 336.089 769.073 335.139 769.513 333.473C769.809 332.358 769.06 331.233 767.233 330.028C765.123 328.64 762.322 327.681 759.346 327.327C756.143 326.947 753.044 327.299 750.619 328.315C750.086 328.539 749.59 328.792 749.138 329.07ZM800.118 329.417C799.519 329.787 798.967 330.18 798.466 330.595C796.16 332.491 795.258 334.382 795.788 336.217C796.45 338.524 799.314 340.653 804.555 342.718C808.895 344.433 813.994 345.715 818.541 346.235C825.803 347.067 829.394 345.78 831.134 344.55C833.146 343.125 833.984 341.35 833.557 339.414C832.826 336.109 828.541 332.756 821.494 329.973C816.734 328.094 812.865 327.185 809.323 327.116C805.782 327.046 802.718 327.82 800.118 329.417ZM779.624 323.52C779.173 323.797 778.768 324.097 778.415 324.417C776.803 325.879 776.388 327.685 777.249 329.502C778.047 331.193 779.882 332.746 782.416 333.874C784.617 334.854 786.605 335.213 788.52 334.972C791.375 334.614 792.864 333.113 794.301 331.661C794.686 331.274 795.082 330.874 795.499 330.499L796.084 329.98C797.913 328.362 799.643 326.835 799.031 325.13C798.656 324.081 797.467 323.21 795.402 322.47C792.486 321.431 788.942 321.112 785.541 321.583C783.18 321.916 781.139 322.59 779.624 323.52Z"
                            fill="#6425FE"
                            fill-opacity="0.38"
                            id="step-11" />

                        <path
                            d="M864.674 444.341C861.775 446.12 860.498 448.154 860.876 450.401C861.253 452.649 863.277 455.087 867.234 458.012C873.066 462.321 879.807 464.833 886.215 465.083C889.988 465.231 893.375 464.577 896.007 463.19C898.263 462.004 900.505 459.62 898.393 454.999C897.07 452.105 894.242 448.918 890.637 446.255C886.285 443.039 881.982 441.347 877.485 441.082C873.913 440.872 870.329 441.583 866.826 443.192C866.063 443.545 865.343 443.929 864.674 444.341ZM851.874 431.601C850.18 432.641 849.023 433.998 848.552 435.53C847.881 437.745 848.742 439.997 850.948 441.795C852.522 443.07 854.282 443.771 856.332 443.939C859.66 444.211 862.488 442.996 865.483 441.712C865.799 441.576 866.118 441.438 866.445 441.3C867.139 441.005 867.882 440.723 868.603 440.45C871.302 439.426 874.095 438.367 874.586 436.51C874.916 435.267 874.081 434.013 872.045 432.67C869.692 431.123 866.57 430.054 863.253 429.659C859.683 429.235 856.228 429.627 853.525 430.761C852.931 431.01 852.378 431.292 851.874 431.601ZM908.701 431.988C908.034 432.4 907.418 432.84 906.86 433.302C904.289 435.415 903.284 437.523 903.875 439.568C904.613 442.14 907.805 444.513 913.647 446.816C918.485 448.727 924.169 450.156 929.238 450.736C937.332 451.663 941.335 450.228 943.274 448.857C945.517 447.269 946.452 445.291 945.975 443.133C945.161 439.448 940.385 435.71 932.529 432.608C927.223 430.514 922.91 429.501 918.963 429.423C915.015 429.346 911.6 430.208 908.701 431.988ZM885.857 425.415C885.354 425.724 884.903 426.059 884.509 426.416C882.712 428.044 882.249 430.058 883.21 432.084C884.099 433.969 886.144 435.699 888.968 436.957C891.422 438.049 893.639 438.45 895.773 438.181C898.955 437.782 900.615 436.108 902.218 434.49C902.646 434.059 903.088 433.613 903.552 433.195L904.204 432.616C906.243 430.812 908.172 429.11 907.49 427.21C907.071 426.04 905.747 425.069 903.445 424.244C900.194 423.086 896.244 422.731 892.452 423.256C889.82 423.627 887.545 424.379 885.857 425.415Z"
                            fill="#6425FE"
                            fill-opacity="0.38"
                            id="step-12" />

                        <path
                            d="M932.018 540.45C928.479 542.622 926.921 545.103 927.381 547.847C927.842 550.591 930.312 553.566 935.142 557.136C942.26 562.396 950.488 565.461 958.309 565.767C962.915 565.947 967.049 565.148 970.261 563.456C973.014 562.009 975.751 559.099 973.172 553.458C971.558 549.927 968.107 546.037 963.706 542.786C958.395 538.861 953.143 536.795 947.654 536.473C943.294 536.216 938.92 537.084 934.644 539.048C933.713 539.478 932.835 539.947 932.018 540.45ZM916.395 524.901C914.328 526.17 912.915 527.826 912.34 529.696C911.521 532.4 912.572 535.148 915.264 537.343C917.185 538.899 919.334 539.754 921.835 539.959C925.898 540.292 929.35 538.809 933.005 537.241C933.39 537.075 933.78 536.907 934.18 536.738C935.026 536.379 935.933 536.035 936.813 535.701C940.107 534.451 943.517 533.159 944.116 530.892C944.518 529.375 943.499 527.844 941.014 526.205C938.142 524.317 934.332 523.012 930.283 522.531C925.926 522.013 921.708 522.492 918.41 523.875C917.684 524.18 917.01 524.523 916.395 524.901ZM985.754 525.373C984.94 525.876 984.188 526.412 983.507 526.977C980.369 529.556 979.142 532.128 979.863 534.625C980.764 537.764 984.661 540.66 991.791 543.471C997.696 545.803 1004.63 547.547 1010.82 548.255C1020.7 549.387 1025.59 547.636 1027.95 545.963C1030.69 544.024 1031.83 541.609 1031.25 538.975C1030.26 534.478 1024.43 529.916 1014.84 526.129C1008.36 523.574 1003.1 522.337 998.279 522.242C993.461 522.148 989.292 523.201 985.754 525.373ZM957.872 517.35C957.258 517.727 956.707 518.136 956.226 518.571C954.034 520.559 953.469 523.017 954.641 525.49C955.726 527.79 958.222 529.902 961.67 531.437C964.665 532.771 967.37 533.26 969.975 532.931C973.859 532.444 975.885 530.402 977.841 528.427C978.364 527.9 978.903 527.356 979.47 526.846L980.266 526.139C982.755 523.938 985.109 521.86 984.276 519.541C983.765 518.113 982.148 516.928 979.339 515.921C975.372 514.508 970.55 514.074 965.922 514.715C962.709 515.168 959.933 516.085 957.872 517.35Z"
                            fill="#6425FE"
                            fill-opacity="0.38"
                            id="step-13" />
                    </svg>
                </div>
                <div class="row steps">
                    <div class="step">
                        <div class="step__number">01</div>
                        <p class="step__desc">Register</p>
                    </div>
                    <div class="step">
                        <div class="step__number">02</div>
                        <p class="step__desc">Replenishment of the balance</p>
                    </div>
                    <div class="step">
                        <div class="step__number">03</div>
                        <p class="step__desc">Choice of conditions</p>
                    </div>
                    <div class="step">
                        <div class="step__number">04</div>
                        <p class="step__desc">Pleasure and profit</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="section">
        <section class="provide page-container" id="provide">
            <div class="container provide-bg">
                <h2 class="section-header">
                    We <br />
                    provide you:
                </h2>

                <div class="row services">
                    <div class="service">
                        <h3 class="service__name">Full concentration</h3>
                        <p class="service__desc">
                            Execution of a notification about each accrual you
                            have transparent statistics know what tomorrow is
                            thanks to Monexo
                        </p>
                    </div>

                    <div class="service service-check">
                        <h3 class="service__name">Relationship security</h3>
                        <p class="service__desc">
                            Profit generation from a farm of 4,000 remote
                            machines Your amount is diversified into a network of
                            accounts and P2P sites We own an authorized capital
                            in the Indian Bank for 10,000,000
                        </p>
                    </div>

                    <div class="service">
                        <h3 class="service__name">
                            The best conditions for the investor
                        </h3>
                        <div class="service__desc">
                            <ul class="service__list">
                                <li>
                                    Increase your savings by over 22% per month
                                </li>
                                <li>
                                    Quick (instant) withdrawal of capital (up to 15
                                    minutes)
                                </li>
                                <li>Customer focus at a high level</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="screan-shot-wrap">
                     <div class="screan-shot">
                        <div class="screan-shot__viewport">
                           <img
                              src="{{ asset('monexo/images/provide/ind.jpg') }}"
                              alt="screan shot"
                              class="screan-shot__img" />
                        </div>
                     </div>
                  </div>
            </div>
        </section>
    </div>
    <div class="section">
        <section class="reviews page-container" id="reviews">
            <div class="container reviews-container">
                <h2 class="section-header" style="margin-bottom: 30px;">Monexo reviews</h2>

                <div class="slider-wrap">
                    <div class="reviews-slider" id="reviews-slider">
                        <!-- <div class="slide">
                            <p class="slide__text">
                                Execution of a notification about each accrual you
                                have transparent statistics know what tomorrow is
                                thanks to Monexo
                            </p>
                            <p class="slide__user">Amit Grover</p>
                        </div> -->
                        <!-- <div class="slide">
                            <p class="slide__text">
                                Profit generation from a farm of 4,000 remote
                                machines Your amount is diversified into a network
                                of accounts and P2P sites We own an authorized
                                capital in the Indian Bank for 10,000,000
                            </p>
                            <p class="slide__user">Alba Lodz</p>
                        </div> -->
                        <!-- <div class="slide">
                            <p class="slide__text">
                                Profit generation from a farm of 4,000 remote
                                machines Your amount is diversified into a network
                                of accounts and P2P sites We own an authorized
                                capital in the Indian Bank for 10,000,000
                            </p>
                            <p class="slide__user">Victor Pushko</p>
                        </div> -->
                        <div class="slide">
                            <button class="btn main-btn slide__btn">
                                <svg
                                    width="20"
                                    height="20"
                                    viewBox="0 0 17 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="slide__btn_img">
                                    <path d="M1 1.5L16 12L1 22.5" fill="white" />
                                    <path
                                        d="M1 1.5L16 12L1 22.5V1.5Z"
                                        stroke="white"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Watch The Video
                            </button>
                            <video
                                poster="{{ asset('monexo/images/reviews/rw_1.jpg') }}"
                                
                                class="slide__video"
                                id="player">
                                <source
                                    src="{{ asset('monexo/video/rew_1.mp4') }}"
                                    type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
                            </video>
                            <p class="slide__user">Amit Grover</p>
                        </div>
                        <div class="slide">
                            <button class="btn main-btn slide__btn">
                                <svg
                                    width="20"
                                    height="20"
                                    viewBox="0 0 17 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="slide__btn_img">
                                    <path d="M1 1.5L16 12L1 22.5" fill="white" />
                                    <path
                                        d="M1 1.5L16 12L1 22.5V1.5Z"
                                        stroke="white"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Watch The Video
                            </button>
                            <video
                                poster="{{ asset('monexo/images/reviews/rw_2.jpg') }}"
                                
                                class="slide__video"
                                id="player">
                                <source
                                    src="{{ asset('monexo/video/rew_2.mp4') }}"
                                    type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
                            </video>
                            <p class="slide__user">Alba Lodz</p>
                        </div>
                        <div class="slide">
                            <button class="btn main-btn slide__btn">
                                <svg
                                    width="20"
                                    height="20"
                                    viewBox="0 0 17 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="slide__btn_img">
                                    <path d="M1 1.5L16 12L1 22.5" fill="white" />
                                    <path
                                        d="M1 1.5L16 12L1 22.5V1.5Z"
                                        stroke="white"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Watch The Video
                            </button>
                            <video
                                poster="{{ asset('monexo/images/reviews/rw_3.jpg') }}"
                                
                                class="slide__video"
                                id="player">
                                <source
                                    src="{{ asset('monexo/video/rew_3.mp4') }}"
                                    type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
                            </video>
                            <p class="slide__text" style="padding-top: 12px;">
                                Execution of a notification about each accrual you
                                have transparent statistics know what tomorrow is
                                thanks to Monexo
                            </p>
                            <p class="slide__user">Malika Huawera</p>
                        </div>
                        <div class="slide">
                            <button class="btn main-btn slide__btn">
                                <svg
                                    width="20"
                                    height="20"
                                    viewBox="0 0 17 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="slide__btn_img">
                                    <path d="M1 1.5L16 12L1 22.5" fill="white" />
                                    <path
                                        d="M1 1.5L16 12L1 22.5V1.5Z"
                                        stroke="white"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Watch The Video
                            </button>
                            <video
                                poster="{{ asset('monexo/images/reviews/rw_4.jpg') }}"
                                
                                class="slide__video"
                                id="player">
                                <source
                                    src="{{ asset('monexo/video/rew_4.mp4') }}"
                                    type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
                            </video>
                            <p class="slide__user">Bernard Frone</p>
                        </div>
                    </div>
                    <div class="slider-paginatioin">
                        <span class="slider-paginatioin__curent">1</span>/<span
                            class="slider-paginatioin__total"
                        >0</span
                        >
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="section">
        <section class="partners page-container" id="partners">
            <div class="container partners-bg">
                <div class="top"></div>
                <div class="centr"></div>
                <div class="bottom"></div>
                <h2 class="section-header partners-header">
                    Our partners in the P2P sector:
                </h2>

                <div class="lists">
                    <ul class="list-exchanges">
                        <li>changelly</li>
                        <li>bitoasis</li>
                        <li>coinmama</li>
                        <li>cex</li>
                        <li>rain</li>
                        <li>kraken</li>
                        <li>paxful</li>
                        <li>coincola</li>
                        <li>coindirect</li>
                    </ul>

                    <ul class="list-exchanges">
                        <li>buycoins</li>
                        <li>wazirx</li>
                        <li>secureshift</li>
                        <li>remitano</li>
                        <li>bitfada</li>
                        <li>swapika</li>
                        <li>otcbtc</li>
                        <li>coindcx</li>
                        <li>hodlhodl</li>
                        <li>zebpay</li>
                    </ul>
                </div>

                <button class="btn main-btn-big">Start investing</button>

                <div class="partners-small-bg">
                     <img
                        src="{{ asset('monexo/images/partners/partners_bg.webp') }}"
                        alt="background image" />
                </div>
            </div>
        </section>
    </div>
    <div class="section">
        <footer class="footer page-container">
            <div class="container">
                <div class="footer-content">
                    <div class="wrapper">
                        <div class="footer-logo">
                           <a href="#about">
                                <img
                                    src="{{ asset('monexo/images/footer-logo.png') }}"
                                    alt="logo"
                                    width="308"
                                    height="81" />
                           </a>
                        </div>
                        <div class="social">
                            <p class="social__text">Stay with us!</p>
                            <a href="https://instagram.com/monexo_invest?igshid=YmMyMTA2M2Y=" target="_blank" class="social__linck">
                                <svg
                                    width="26"
                                    height="27"
                                    viewBox="0 0 26 27"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13 7.02C11.7658 7.02 10.5594 7.40005 9.53324 8.11208C8.50708 8.82411 7.70728 9.83615 7.23499 11.0202C6.7627 12.2043 6.63913 13.5072 6.8799 14.7642C7.12067 16.0212 7.71497 17.1758 8.58765 18.0821C9.46033 18.9883 10.5722 19.6055 11.7826 19.8555C12.9931 20.1055 14.2477 19.9772 15.3879 19.4867C16.5282 18.9963 17.5027 18.1657 18.1884 17.1001C18.874 16.0345 19.24 14.7816 19.24 13.5C19.24 11.7814 18.5826 10.1332 17.4123 8.91795C16.2421 7.70271 14.655 7.02 13 7.02ZM13 17.82C12.1772 17.82 11.3729 17.5666 10.6888 17.0919C10.0047 16.6173 9.47152 15.9426 9.15666 15.1532C8.8418 14.3638 8.75942 13.4952 8.91993 12.6572C9.08045 11.8192 9.47665 11.0495 10.0584 10.4453C10.6402 9.84114 11.3815 9.4297 12.1884 9.26301C12.9954 9.09632 13.8318 9.18187 14.592 9.50884C15.3521 9.83581 16.0018 10.3895 16.4589 11.0999C16.916 11.8104 17.16 12.6456 17.16 13.5C17.1566 14.6446 16.7172 15.7414 15.9378 16.5508C15.1584 17.3602 14.1022 17.8164 13 17.82ZM18.72 0H7.28C5.34922 0 3.49753 0.796498 2.13226 2.21427C0.766998 3.63205 0 5.55496 0 7.56V19.44C0 21.445 0.766998 23.368 2.13226 24.7857C3.49753 26.2035 5.34922 27 7.28 27H18.72C20.6508 27 22.5025 26.2035 23.8677 24.7857C25.233 23.368 26 21.445 26 19.44V7.56C26 5.55496 25.233 3.63205 23.8677 2.21427C22.5025 0.796498 20.6508 0 18.72 0ZM23.92 19.44C23.92 20.1491 23.7855 20.8513 23.5242 21.5065C23.2628 22.1616 22.8798 22.7569 22.397 23.2584C21.9141 23.7598 21.3408 24.1576 20.71 24.429C20.0791 24.7003 19.4029 24.84 18.72 24.84H7.28C6.59713 24.84 5.92094 24.7003 5.29005 24.429C4.65915 24.1576 4.08591 23.7598 3.60304 23.2584C3.12018 22.7569 2.73715 22.1616 2.47583 21.5065C2.2145 20.8513 2.08 20.1491 2.08 19.44V7.56C2.08 6.12783 2.62786 4.75432 3.60304 3.74162C4.57823 2.72893 5.90087 2.16 7.28 2.16H18.72C19.4029 2.16 20.0791 2.29968 20.71 2.57105C21.3408 2.84243 21.9141 3.24019 22.397 3.74162C22.8798 4.24306 23.2628 4.83835 23.5242 5.49351C23.7855 6.14867 23.92 6.85086 23.92 7.56V19.44ZM21.32 6.48C21.32 6.80041 21.2285 7.11362 21.0571 7.38002C20.8857 7.64643 20.642 7.85407 20.357 7.97669C20.0719 8.0993 19.7583 8.13138 19.4557 8.06887C19.153 8.00636 18.8751 7.85207 18.6569 7.62551C18.4387 7.39895 18.2902 7.1103 18.23 6.79605C18.1698 6.4818 18.2007 6.15607 18.3187 5.86005C18.4368 5.56404 18.6368 5.31103 18.8933 5.13302C19.1499 4.95501 19.4515 4.86 19.76 4.86C20.1737 4.86 20.5705 5.03068 20.8631 5.33449C21.1556 5.6383 21.32 6.05035 21.32 6.48Z"
                                        fill="white" />
                                </svg>
                            </a>
                            <a href="https://t.me/monexo_invest" target="_blank" class="social__linck social__linck_centr">
                                <svg
                                    width="28"
                                    height="25"
                                    viewBox="0 0 28 25"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M25.9271 0.00255973C25.5813 0.0275672 25.2419 0.108206 24.9221 0.24133H24.9178C24.6108 0.362321 23.1512 0.972632 20.9323 1.89773L12.9806 5.2266C7.27481 7.61431 1.66598 9.96561 1.66598 9.96561L1.73277 9.93991C1.73277 9.93991 1.34607 10.0663 0.942126 10.3414C0.692576 10.4993 0.477837 10.7058 0.310904 10.9485C0.112705 11.2376 -0.0467164 11.6798 0.012528 12.137C0.109473 12.9101 0.613589 13.3737 0.975518 13.6296C1.34176 13.8887 1.69076 14.0097 1.69076 14.0097H1.69938L6.9592 15.7711C7.1951 16.5238 8.56203 20.9908 8.89057 22.0198C9.08446 22.6344 9.27296 23.0188 9.50886 23.3121C9.62304 23.462 9.75661 23.5873 9.91711 23.688C10.0005 23.7362 10.0895 23.7743 10.1821 23.8015L10.1282 23.7886C10.1444 23.7929 10.1573 23.8057 10.1692 23.81C10.2123 23.8218 10.2413 23.8261 10.2963 23.8346C11.1289 24.0852 11.7979 23.5712 11.7979 23.5712L11.8356 23.5413L14.941 20.7306L20.1459 24.6998L20.2644 24.7501C21.3491 25.2234 22.4478 24.96 23.0284 24.4953C23.6133 24.0274 23.8406 23.4288 23.8406 23.4288L23.8783 23.3325L27.9005 2.85067C28.0147 2.34529 28.0437 1.87204 27.9177 1.4127C27.7877 0.947818 27.4877 0.547992 27.0764 0.291654C26.7311 0.0829867 26.3307 -0.017732 25.9271 0.00255973ZM25.8183 2.19754C25.814 2.26499 25.8269 2.2575 25.7968 2.38705V2.39883L21.8123 22.6676C21.7951 22.6965 21.766 22.7596 21.6863 22.8228C21.6023 22.8892 21.5355 22.931 21.1854 22.7928L14.8193 17.9414L10.9738 21.4255L11.7817 16.2968L22.1829 6.6603C22.6116 6.26413 22.4683 6.18061 22.4683 6.18061C22.4985 5.69451 21.8209 6.03821 21.8209 6.03821L8.70529 14.1146L8.70099 14.0932L2.41462 11.9893V11.985L2.39846 11.9818C2.40948 11.9781 2.42027 11.9738 2.43078 11.9689L2.46525 11.9518L2.49864 11.94C2.49864 11.94 8.11177 9.58871 13.8175 7.20101C16.6742 6.00501 19.5524 4.80046 21.766 3.87107C23.0788 3.32179 24.3929 2.77573 25.7084 2.23287C25.7968 2.19861 25.7548 2.19754 25.8183 2.19754Z"
                                        fill="white" />
                                </svg>
                            </a>
                            <!-- <a href="#" class="social__linck">
                                <svg
                                    width="29"
                                    height="25"
                                    viewBox="0 0 29 25"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M28.9238 3.76634C28.8426 3.57678 28.706 3.41505 28.5312 3.30153C28.3564 3.18801 28.1513 3.12777 27.9417 3.12841H23.907C23.4229 2.29979 22.7508 1.59161 21.9428 1.05872C21.1348 0.525823 20.2126 0.182515 19.2476 0.0553803C18.2826 -0.0717539 17.3007 0.0206978 16.378 0.325576C15.4553 0.630455 14.6165 1.13958 13.9266 1.81351C13.3226 2.39125 12.8424 3.08158 12.5142 3.84396C12.186 4.60633 12.0164 5.42536 12.0155 6.25293V7.04707C6.61386 5.66708 2.19435 1.39691 2.15454 1.34484C2.01571 1.21086 1.84199 1.11692 1.65239 1.07329C1.46278 1.02967 1.2646 1.03803 1.07952 1.09748C0.895025 1.15507 0.729814 1.26047 0.601331 1.40255C0.472849 1.54462 0.385865 1.71809 0.349568 1.90465C-0.80508 8.17971 1.11933 12.3848 2.93757 14.8063C3.84955 16.0307 4.9564 17.1033 6.21571 17.9829C4.18512 20.2351 1.05297 21.4068 1.02643 21.4198C0.876651 21.4743 0.741337 21.5613 0.630569 21.6742C0.519802 21.7871 0.436437 21.9231 0.386686 22.072C0.336935 22.2209 0.322081 22.3789 0.343229 22.5342C0.364377 22.6895 0.420983 22.8382 0.50883 22.9691C0.615004 23.1253 1.01316 23.633 1.982 24.1147C3.18974 24.7006 4.78235 25 6.70677 25C16.0634 25 23.8938 17.9308 24.6901 8.83065L28.6982 4.91199C28.8422 4.7614 28.9398 4.57389 28.9798 4.37115C29.0197 4.1684 29.0003 3.95871 28.9238 3.76634ZM22.9117 7.63292C22.7267 7.81286 22.6177 8.0546 22.6064 8.3099C22.0623 16.4987 15.0813 22.917 6.70677 22.917C5.29996 22.917 4.31784 22.7347 3.62771 22.5134C5.15397 21.7062 7.27746 20.3002 8.65772 18.2823C8.73785 18.1602 8.79104 18.023 8.8139 17.8795C8.83676 17.736 8.82877 17.5894 8.79044 17.4491C8.75181 17.3074 8.68346 17.1751 8.58977 17.0608C8.49607 16.9465 8.37909 16.8526 8.2463 16.7851C8.23303 16.7721 6.2688 15.7697 4.58328 13.4914C2.67214 10.9137 1.86256 7.77613 2.18108 4.1569C4.27803 5.84934 8.28611 8.60933 12.9047 9.36442C13.0572 9.38845 13.2132 9.37996 13.3621 9.33952C13.511 9.29908 13.6492 9.22764 13.7674 9.13008C13.8829 9.03091 13.9758 8.90888 14.0398 8.77201C14.1039 8.63514 14.1377 8.48653 14.139 8.33593V6.25293C14.141 5.29734 14.4778 4.37147 15.093 3.63054C15.7081 2.8896 16.5643 2.37864 17.5179 2.18332C18.4715 1.98799 19.4645 2.12018 20.3306 2.55773C21.1966 2.99527 21.883 3.71156 22.2746 4.58652C22.3593 4.77263 22.4971 4.9307 22.6714 5.0416C22.8456 5.15251 23.049 5.21149 23.2567 5.21142H25.3802L22.9117 7.63292Z"
                                        fill="white" />
                                </svg>
                            </a> -->
                        </div>
                    </div>

                    <div class="footer-navigates">
                        <div class="presentation">
                           <a href="{{ asset('monexo/presentation/monexo_eng.pdf') }}" target="_blank">Presentation EN</a>
                           <a href="{{ asset('monexo/presentation/monexo_rus.pdf') }}" target="_blank">Presentation RU</a>
                        </div>

                        <nav>
                            <ul class="footer-menu">
                                <li class="footer-menu__item">
                                    <a href="http://monexo-invest.com/agreement">Privacy policy</a>
                                </li>
                                <li class="footer-menu__item">
                                    <a href="http://monexo-invest.com/agreement">Terms and Conditions</a>
                                </li>
                            </ul>
                        </nav>

                        <nav>
                            <ul class="footer-menu">
                                <li class="footer-menu__item clasic">
                                    <a href="#about">About company</a>
                                </li>
                                <li class="footer-menu__item clasic">
                                    <a href="#offers">Advantages</a>
                                </li>
                                <li class="footer-menu__item clasic">
                                    <a href="#reviews">Reviews</a>
                                </li>
                                <li class="footer-menu__item clasic">
                                    <a href="#partners">Partners</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <p class="footer__text">
                    The Reserve Bank of India assumes no responsibility for the
                    correctness of any statements or representations or
                    opinions expressed by <a href="#">monexo-invest.com</a> and
                    makes no guarantee of the repayment of loans or investments
                    made to it.
                </p>
            </div>
        </footer>
    </div>
</main>

<div class="popup">
    <div class="popup__overlay">
    <div class="popup__body">
        <div class="popup__header">
            <p>Select presentation language</p>
        </div>
        <div class="popup__main">
            <a href="{{ asset('monexo/presentation/monexo_eng.pdf') }}" target="_blank" class="btn linck-btn main-btn">EN</a>
            <a href="{{ asset('monexo/presentation/monexo_rus.pdf') }}" target="_blank" class="btn linck-btn main-btn">RU</a>
        </div>
        <div class="popup__footer">
            <button class="btn secondary-btn" id="closePopup" style="margin-left: auto; margin-top: 20px; display: block;">Close</button>
        </div>
    </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@svgdotjs/svg.js@3.0/dist/svg.min.js"></script>

<script nomodule>!function(){var e=document,t=e.createElement("script");if(!("noModule"in t)&&"onbeforeload"in t){var n=!1;e.addEventListener("beforeload",(function(e){if(e.target===t)n=!0;else if(!e.target.hasAttribute("nomodule")||!n)return;e.preventDefault()}),!0),t.type="module",t.src=".",e.head.appendChild(t),t.remove()}}();</script>
<script nomodule crossorigin id="vite-legacy-polyfill" src="{{ asset('monexo/assets/polyfills-legacy-debe831a.js') }}"></script>
<script nomodule crossorigin id="vite-legacy-entry" data-src="{{ asset('monexo/assets/index-legacy-1df87c72.js') }}">System.import(document.getElementById('vite-legacy-entry').getAttribute('data-src'))</script>
<script>
  document.addEventListener('DOMContentLoaded', function(){

    $('.slide__btn').on('click', function(){
        let player = $(this).siblings('.slide__video').get(0);

        if( player.paused ) {
            player.play();
        }else {
            player.pause();
        }
        
    });

    $('.slide__video').on('click', function() {

    const pageWidth = document.documentElement.scrollWidth;

    var mediaVideo = $(this).get(0);

        if(pageWidth > 570) {
        if (mediaVideo.paused) {
                mediaVideo.play();
        } else {
                mediaVideo.pause();
        }
        }

    });

    $('.cards__btn-group button:first-child').trigger('click');

    $('#openPopup').on('click', function() {
        $('.popup').show();
    });

    $('.popup__overlay').on('click', function() {
        $('.popup').hide();
    });

    $('#closePopup').on('click', function() {
    $('.popup').hide();
    });
  });
</script>
</body>
</html>

