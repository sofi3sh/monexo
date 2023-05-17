(function () {
    // Loader
    const PAGE_LOADER = $("#page_loader");

    $('document').ready(function () {
        // Loading completed
        if ($('document').ready()) {
            setTimeout(() => {
                PAGE_LOADER.addClass("completed");
            }, 600)
        }
        // Loader end

        // Language
        const PAGE_LANG = $(".language");
        
        if (PAGE_LANG) {
            PAGE_LANG.each(function() {
                // This
                let ths = $(this);
                // Control
                let link = ths.find("a");

                link.each(function() {
                    // This
                    let ths = $(this);
                    // Attribute
                    let attr_lang = ths.attr("data-lang");

                    ths.on("click", () => {
                        if (!ths.hasClass("active")) {
                            link.removeClass("active");
                            ths.addClass("active");
                        }
                    });
                });
            });
        }
        // Language end

        // Header menu
        const HEADER = $("#header");

        if (HEADER) {
            // Скролл и меню
            let scrollWindow = 0,
                screenWidth = screen.width,
                screenHeight = screen.height;

            $(window).scroll(function() {
                scrollWindow = $(this).scrollTop();
                if (screenWidth > 920) {
                    if (screenHeight > scrollWindow) {
                        HEADER.removeClass("fixed");
                    }
                    else {
                        HEADER.addClass("fixed");
                    }
                }
                else {
                    if (!HEADER.hasClass("fixed")) {
                        HEADER.addClass("fixed");
                    }
                }
            });

            // Мобильное меню
            let menuBtn = $(".mobile_nav_menu");

            menuBtn.on("click", () => {
                if (HEADER.hasClass("active")) {
                    HEADER.removeClass("active");
                }
                else {
                    HEADER.addClass("active");
                }
            });
        }
        // Header menu end

        // Подсчет суммы до конечной по таймингу
        let calcBlocks = $(".calcNumWithSec");

        if (calcBlocks) {
            calcBlocks.each(function() {
                // This
                let ths = $(this);
                // Значения блока
                let counter  = Number(ths.attr("data-counter")),
                    duration = Number(ths.attr("data-duration")),
                    type     = Number(ths.attr("data-type"));
                // Редактируемые элементы
                let edit = ths.find("h4.num");
                // Переменная для подсчета
                let count = 0,
                    ending = '',
                    sum = counter,
                    dif, time;

                if (counter >= 100000 && counter <= 999999) {
                    counter = parseInt(counter / 1000);
                    sum = counter;
                    ending = "K"
                }
                else if (counter >= 1000000) {
                    counter = parseInt(counter / 10000);
                    sum = counter;
                    ending = "M"
                }

                if (duration > counter) {
                    dif  = parseInt(duration / counter),
                    time = parseInt(duration / dif);
                }
                else if (duration < counter) {
                    dif  = parseInt(counter / duration),
                    time = parseInt(duration / dif);
                    dif  = parseInt(counter / time);
                }
                
                if (time > 100) {
                    time = time / 10;
                }

                let thsCounter = setInterval(function() {
                    count += dif;
                    edit.text(`${count}${ending}`);

                    if (counter <= count) {
                        clearInterval(thsCounter);
                        if (count > counter) {
                            edit.text(`${sum}${ending}`);
                            // edit.text(counter);
                        }
                    }
                }, time);
            });
        }
        // Подсчет end

        // График в рост
        let upGraph = $(".upGraphic");
        
        if (upGraph) {
            upGraph.each(function() {
                // This
                let ths = $(this);
                // Данные
                let percent = Number(ths.attr("data-percent"));
                // Редактируемые элементы
                let line = ths.find(".progress"),
                    num  = line.find(".num");

                line.css("height", `${percent}%`);
                num.text(`${percent}%`);
            });
        }
        // График end

        // FAQ
        let faq_blocks = $(".faq_block");
        
        if (faq_blocks) {
            faq_blocks.each(function () {
                // This
                let ths = $(this);
                // Управление
                let control = ths.find(".head");
                // Редакт. элементы
                let edit = ths.find(".text");

                control.on("click", () => {
                    // Параметры
                    let height = ths.find(".text p").outerHeight(true);

                    if (!ths.hasClass("active")) {
                        faq_blocks.removeClass("active");
                        faq_blocks.find(".text").css("height", `0px`);

                        ths.addClass("active");
                        edit.css("height", `${height}px`);
                    }
                    else {
                        ths.removeClass("active");
                        edit.css("height", `0px`);
                    }
                });
            });
        }
        // FAQ end

        // Slider
        let MainDotSlider = $(".MainDotSlider");

        if (MainDotSlider) {
            MainDotSlider.each(function() {
                let ths = $(this);
                // Слайды
                let slides = ths.find(".slide");
                // Контроль
                let control = ths.find(".control .dot");

                control.each(function() {
                    let ths = $(this);
                    
                    ths.on("click", () => {
                        if (!ths.hasClass("active")) {
                            control.removeClass("active");
                            slides.removeClass("active");

                            ths.addClass("active");
                            slides.eq(ths.index()).addClass("active");
                        }
                    });
                });
            });
        }
        // Slider end

        // Calculator
        let MainPlanCalculator = $(".MainPlanCalculator");

        if (MainPlanCalculator) {
            MainPlanCalculator.each(function() {
                // This
                let ths = $(this);
                // Управления
                let select_plan  = ths.find(".data_inputs #calculator__active_plan"),
                    invest_input = ths.find(".data_inputs #calculator__invested_sum");
                // Параметры
                let chooses_plan,
                    sum_value;
                // ---- Редактируеммые данные ----
                // Лента
                let calc_tape = ths.find(".data_tape #calculator__day_tape"),
                    first_day = ths.find(".data_tape .first_day"),
                    last_day  = ths.find(".data_tape .last_day");
                // Итог
                let data_days   = ths.find(".data_user_get .days h4"),
                    data_income = ths.find(".data_user_get .income h4");

                let get_data = () => {
                    // Обновлаем данные
                    let plan_active       = Number(select_plan.val()),
                        plan_days         = Number(select_plan.find("option").eq(plan_active - 1).attr("data-lastDay")),
                        tape_days         = Number(calc_tape.val()),
                        plan_low_percent  = Number(select_plan.find("option").eq(plan_active - 1).attr("data-firstPercent")),
                        plan_high_percent = Number(select_plan.find("option").eq(plan_active - 1).attr("data-lastPercent")),
                        plan_different    = ((plan_low_percent + plan_high_percent) / 2) / 100,
                        plan_max_sum      = Number(select_plan.find("option").eq(plan_active - 1).attr("data-maxSum")),
                        sum_value         = Number(invest_input.val()),
                        income_sum;

                    invest_input.attr("max", plan_max_sum);

                    // Если введеная сумма больше чем доступная по плану - уменьшить до доступной
                    if (sum_value > plan_max_sum) {
                        invest_input.val(plan_max_sum);
                        sum_value = plan_max_sum;
                    }
                    // Если кол-во дней работы плана в ленте выбранно больше чем доступно по плану - уменьшить до доступной
                    if (tape_days > plan_days) {
                        calc_tape.val(plan_days);
                        tape_days = plan_days;
                    }
                    // Подсчет дохода
                    income_sum = Number((sum_value * plan_different) * tape_days).toFixed(2);

                    // Параметр max для ленты
                    calc_tape.attr("max", plan_days);
                    // Выставляем первый и последний день для ленты
                    first_day.text(`${1} ${first_day.attr("data-word")}`);
                    last_day.text(`${plan_days} ${last_day.attr("data-word")}`);
                    // Выставляем данные для дней и дохода
                    data_days.text(tape_days);
                    data_income.text(income_sum);
                }
                // Запуск функции
                get_data();
                
                calc_tape.on("input", () => {
                    get_data();
                });
                invest_input.on("keyup", () => {
                    get_data();
                });
                select_plan.on("change", () => {
                    get_data();
                });
            });
        }
        // Calculator end

        // Vacancies
        let careers_vacancies = $(".group_content_view");

        if (careers_vacancies) {
            careers_vacancies.each(function() {
                // This
                let ths = $(this);
                // Control
                let buttons = ths.find(".group_header .group_btn");
                // Edit
                let content = ths.find(".group_content");
                
                buttons.on("click", function() {
                    // This
                    let b_this = $(this);
                    // Data
                    let type = b_this.attr("data-type");

                    buttons.removeClass("active");
                    b_this.addClass("active");

                    if (type == 0) {
                        content.find(`.block`).removeClass("hidden");
                    }
                    else {
                        content.find(`.block`).addClass("hidden");
                        content.find(`.block.type_${type}`).removeClass("hidden");
                    }
                });
            });
        }
        // Vacancies end

        // Hide & Unhide legend
        let legend = $(".main_legend");

        if (legend) {
            legend.each(function() {
                // This
                let ths = $(this);
                // Control
                let button = ths.find("button.hide");
                // Edit object
                let info = ths.find(".info"),
                    text = info.find(".text"),
                    text_p = text.find("p");
                // Variavles
                let all_height = 0;

                button.on("click", () => {
                    all_height = 0;

                    if (!info.hasClass("active")) {
                        for (let i = 0; i < text_p.length; i++) {
                            all_height += text_p.eq(i).outerHeight(true);
                        }

                        info.addClass("active");
                        text.height(all_height);
                    }
                    else {
                        info.removeClass("active");
                        text.height(180);
                    }

                });
            });
        }
        // Hide & Unhide legend end

        // Video language select
        let video_wrapper = $(".video_wrapper");

        if (video_wrapper) {
            video_wrapper.each(function() {
                // This
                let ths = $(this);
                // Active video
                let active_video = ths.find("video.active");
                // Control
                let btn_en = ths.find(".control button.en"),
                    btn_ru = ths.find(".control button.ru");

                btn_en.on("click", () => {
                    active_video = ths.find("video.active");

                    if (!btn_en.hasClass("active")) {
                        btn_ru.removeClass("active");
                        btn_en.addClass("active");

                        ths.find("video").trigger('pause');

                        active_video.removeClass("active");
                        ths.find("video.en").addClass("active");
                    }
                });
                btn_ru.on("click", () => {
                    active_video = ths.find("video.active");

                    if (!btn_ru.hasClass("active")) {
                        btn_en.removeClass("active");
                        btn_ru.addClass("active");

                        ths.find("video").trigger('pause');

                        active_video.removeClass("active");
                        ths.find("video.ru").addClass("active");
                    }
                });
            });
        }
        // Video language select end

        // Scroll to target
        let targetScroll = $("button.scroll-to-target");

        if (targetScroll) {
            // Статус скролла
            let status = true;

            targetScroll.each(function() {
                // This
                let ths = $(this);

                ths.on("click", () => {
                    if (status == true) {
                        status = false;
                        // Target
                        let target = ths.attr("data-target");
                        // Текущее положение экрана
                        let active_window = $(window).scrollTop();
                        // Точка для скролла
                        let find_obj = $(String(target)).offset().top;
                        // Высота панели меню
                        let header_height = $("#header").height();

                        // Время для скролла
                        let time = 1500;
                        if (active_window < find_obj) {
                            time = find_obj - active_window;
                        }
                        else if (active_window > find_obj) {
                            time = active_window - find_obj;
                        }
                        
                        if (time > 3000) {
                            time = 3000;
                        }
                        else if (time < 500) {
                            time = 500;
                        }

                        $("html").animate({scrollTop: (find_obj == 0 ? find_obj : find_obj - header_height + 1)}, time);
                    
                        setTimeout(() => {
                            status = true;
                        }, (time + 250));
                    }

                    return false;
                });
            });
        }
        // Scroll to target end

        // Present slider
        let present_slider = $(".present_slider");

        if (present_slider) {
            // Таймер для слайдера
            let active_time   = 0,
                slide_time    = 6,
                slider_status = false;
            let slideActiveTimer,
                sliderStatusTimer;
            // Slides
            let active_slide   = $(".control .dot.active").index();
            // Слайды
            let slides         = present_slider.find(".slide_wrapper .slide"),
                length_slide   = slides.length;
            // Контроль
            let control = present_slider.find(".control .dot");

            control.each(function() {
                let ths = $(this);
                
                ths.on("click", () => {
                    if (!ths.hasClass("active")) {
                        control.removeClass("active");
                        slides.removeClass("active");

                        ths.addClass("active");
                        slides.eq(ths.index()).addClass("active");
                    }
                });
            });

            // Switch function
            function slide_switch(eq) {
                slides.removeClass("active");
                control.removeClass("active");

                // Условия для следующего слайда
                if ((eq) >= length_slide) {
                    slides.eq(0).addClass("active");
                    control.eq(0).addClass("active");
                }
                else if ((eq) < 0) {
                    slides.eq(length_slide - 1).addClass("active");
                    control.eq(length_slide - 1).addClass("active");
                }
                else {
                    slides.eq(eq).addClass("active");
                    control.eq(eq).addClass("active");
                }

                slider_status = true;
                active_time   = 0;
                clearInterval(slideActiveTimer);
                // Передача статуса для авто. слайдера
                sliderStatus(slider_status);
            }

            // Функция переключения статуса слайдера
            // Если slider_status = true, то авто. переключение не работает
            function sliderStatus(status) {
                clearTimeout(sliderStatusTimer);

                if (status) {
                    slider_status = false;

                    sliderStatusTimer = setTimeout(function() {
                        slider_status = true;
                        
                        autoSlideTimer(slider_status);
                    }, 5000)
                }
            }

            // Функция автоматического переключения слайдов
            // Если slider_status = true, то авто. переключение
            function autoSlideTimer(status) {
                if (status) {
                    clearInterval(slideActiveTimer);

                    slideActiveTimer = setInterval(function() {
                        active_time += 1;

                        if (active_time >= slide_time) {
                            active_slide = $(".control .dot.active").index();

                            clearInterval(slideActiveTimer);

                            slide_switch(active_slide + 1);
                        }
                    }, 1000)
                }
            }
            autoSlideTimer(true);
        }
        // Present slider end

        // Our partners slider
        let partners_slider = $(".partners_slider");

        if (partners_slider) {
            partners_slider.each(function() {
                let ths = $(this);
                // Слайды
                let slides = ths.find(".wrapper");
                // Контроль
                let control = ths.find(".control .dot");

                control.each(function() {
                    let ths = $(this);
                    
                    ths.on("click", () => {
                        if (!ths.hasClass("active")) {
                            control.removeClass("active");
                            slides.removeClass("active");

                            ths.addClass("active");
                            slides.eq(ths.index()).addClass("active");
                        }
                    });
                });
            });
        }
        // Our partners slider

        // Vacancies slider
        let vacancies_slider = $(".main_vacancies .vacancies");

        if (vacancies_slider) {
            vacancies_slider.each(function() {
                let ths = $(this);
                // Слайды
                let slides = ths.find(".all_vacancies .wrapper");
                // Контроль
                let control = ths.find(".control .dot");

                control.each(function() {
                    let ths = $(this);
                    
                    ths.on("click", () => {
                        if (!ths.hasClass("active")) {
                            control.removeClass("active");
                            slides.removeClass("active");

                            ths.addClass("active");
                            slides.eq(ths.index()).addClass("active");
                        }
                    });
                });
            });
        }
        // Vacancies slider
    });
}());