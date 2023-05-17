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

        // Панель навигации и её управления
        const HEADER = $("#header");

        if (HEADER) {
            // Панель управления
            let control_panel = $(".control_panel");
            // Language
            let language      = control_panel.find(".language"),
                lang_btn      = language.find(".active_lang"),
                lang_elems_wr = language.find(".lang_list"),
                lang_elems    = lang_elems_wr.find(".lang");
            // User
            let user_panel    = control_panel.find(".user_account"),
                user_btn      = user_panel.find(".header"),
                user_elems_wr = user_panel.find(".menu");
                user_elems    = user_elems_wr.find(".line");
            // Help window
            let help_button   = control_panel.find(".help_window"),
                help_window   = $(".base_modal.help_window"),
                help_close    = help_window.find(".tabs_header button.close");
            // Меню навигации
            let left_menu = $(".left_menu"),
                left_menu_btn = $(".left_menu_control");
            let top_menu = $(".top_menu"),
                top_menu_btn = $(".top_menu_control");
            
            let control_panel_state = {
                langIsOpen : false,
                userIsOpen : false,
                leftMenuIsOpen : false,
                topMenuIsOpen : false,
                helpWindowIsOpen : false,
            }

            // Language
            // lang_btn.on("click", () => {
            //     let count = lang_elems.length,
            //         height = lang_elems.height();

            //     if(!control_panel_state.langIsOpen) {
            //         control_panel_state.langIsOpen = !control_panel_state.langIsOpen;
            //         lang_elems_wr.css("height", (height * count));
            //         language.addClass("active");
            //     }
            //     else {
            //         control_panel_state.langIsOpen = !control_panel_state.langIsOpen;
            //         lang_elems_wr.css("height", "0px");
            //         language.removeClass("active");
            //     }
            // });

            // User panel
            // user_btn.on("click", () => {
            //     let count = user_elems.length,
            //         height = user_elems.height();
                
            //     if(!control_panel_state.userIsOpen) {
            //         control_panel_state.userIsOpen = !control_panel_state.userIsOpen;
            //         user_elems_wr.css("height", (height * count));
            //         user_panel.addClass("active");
            //     }
            //     else {
            //         control_panel_state.userIsOpen = !control_panel_state.userIsOpen;
            //         user_elems_wr.css("height", "0px");
            //         user_panel.removeClass("active");
            //     }
            // });

            // Left menu
            left_menu_btn.on("click", () => {
                if(!control_panel_state.leftMenuIsOpen) {
                    control_panel_state.leftMenuIsOpen = !control_panel_state.leftMenuIsOpen;

                    left_menu.addClass("active");
                    left_menu_btn.addClass("active");
                    
                    if (control_panel_state.topMenuIsOpen == true) {
                        control_panel_state.topMenuIsOpen = !control_panel_state.topMenuIsOpen;
                        top_menu.removeClass("active");
                        top_menu_btn.removeClass("active");
                    }
                }
                else {
                    control_panel_state.leftMenuIsOpen = !control_panel_state.leftMenuIsOpen;
                    left_menu.removeClass("active");
                    left_menu_btn.removeClass("active");
                }
            });

            // Top menu
            top_menu_btn.on("click", () => {
                if(!control_panel_state.topMenuIsOpen) {
                    control_panel_state.topMenuIsOpen = !control_panel_state.topMenuIsOpen;
                    top_menu.addClass("active");
                    top_menu_btn.addClass("active");
                    
                    if (control_panel_state.leftMenuIsOpen == true) {
                        control_panel_state.leftMenuIsOpen = !control_panel_state.leftMenuIsOpen;
                        left_menu.removeClass("active");
                        left_menu_btn.removeClass("active");
                    }
                }
                else {
                    control_panel_state.topMenuIsOpen = !control_panel_state.topMenuIsOpen;
                    top_menu.removeClass("active");
                    top_menu_btn.removeClass("active");
                }
            });

            // Help window
            help_button.on("click", () => {
                if(!control_panel_state.helpWindowIsOpen) {
                    control_panel_state.helpWindowIsOpen = !control_panel_state.helpWindowIsOpen;
                    help_window.addClass("active");
                }
                else {
                    control_panel_state.helpWindowIsOpen = !control_panel_state.helpWindowIsOpen;
                    help_window.removeClass("active");
                }
            });
            help_close.on("click", () => {
                if(control_panel_state.helpWindowIsOpen) {
                    control_panel_state.helpWindowIsOpen = !control_panel_state.helpWindowIsOpen;
                    help_window.removeClass("active");
                }
            });
        }
        // Header end

        // Base alert
        let base_alert = $(".base_alert");

        if (base_alert) {
            // Control
            let close_alert = base_alert.find("button.close");

            close_alert.on("click", () => {
                base_alert.addClass("hidden");
            });
        }
        // Base alert end

        // Base tabs wrapper
        let tabsWrapper = $(".main_tabs_content");

        if (tabsWrapper) {
            tabsWrapper.each(function(){
                // This
                let ths = $(this);
                // Навигация
                let header  = ths.find(".tabs_header"),
                    buttons = header.find(".tabs_btn");
                // Контент
                let contents = ths.find(".tabs_content");

                buttons.each(function(){
                    let ths = $(this),
                        find = ths.attr("data-content");

                    ths.on("click", () => {
                        if (!ths.hasClass("active")) {
                            buttons.removeClass("active");
                            ths.addClass("active");
                            
                            contents.find(".content").removeClass("active");
                            contents.find(`.content.${find}`).addClass("active");
                        }
                    });
                });
            });
        }
        // Base tabs end

        // Base select list
        let selectLists = $(".base_select");

        if (selectLists) {
            selectLists.each(function() {
                // This
                let ths = $(this);
                // Element's
                let selected = ths.find(".elements_selected"),
                    arrow    = ths.find(".arrow"),
                    list     = ths.find(".elements_list");
                // Selected edit block
                let selected_img  = selected.find(".block .logo img"),
                    selected_text = selected.find(".block .text");
                // List element's
                let list_elem = list.find(".block");

                // Onclick function from open select list
                function openListMenu() {
                    if (!ths.hasClass("active")) {
                        ths.addClass("active");
                    }
                    else {
                        ths.removeClass("active");
                    }
                }
                selected.on("click", () => {
                    openListMenu();
                });
                arrow.on("click", () => {
                    openListMenu();
                });

                // List element's each
                list_elem.each(function() {
                    // This
                    let ths_elem = $(this);
                    
                    ths_elem.on("click", () => {
                        if (ths.hasClass("active")) {
                            ths.removeClass("active");

                            selected_img.attr("src", ths_elem.find(".logo img").attr("src"));
                            selected_text.text(ths_elem.find(".text").text());
                        }
                    });
                });
            });
        }
        // Base select list end

        // Base form
        let baseForm = $(".base_form");

        if (baseForm) {
            baseForm.each(function() {
                // This
                let ths = $(this);
                // Form types - Invest
                let forms_type = ths.find(".base_select .elements_list .block");

                forms_type.each(function() {
                    // This
                    let ths_forms_type = $(this);
                    // Type
                    let type = ths_forms_type.attr("data-type");

                    ths_forms_type.on("click", () => {
                        if (type == "crypto_currency") {
                            $(`form.base_form.invest_form.${type}_system`).find("input.address").val(ths_forms_type.attr("data-address"));
                            $(`form.base_form.invest_form.${type}_system`).find("input.add_address").val(ths_forms_type.attr("data-add-address"));
                        }
                        else if (type == "eps") {
                            $(`form.base_form.invest_form.${type}_system`).find("input.address").val(ths_forms_type.attr("data-address"));
                        }

                        $(`form.base_form.invest_form`).removeClass("active");
                        $(`form.base_form.invest_form.${type}_system`).addClass("active");
                    });
                });
                // Blocks
                let blocks = ths.find(".block");

                blocks.each(function() {
                    // This
                    let ths_block = $(this);
                    // Copy button
                    let copy_btn = ths_block.find("button.copy");
                    // Selected base
                    let select_list   = ths_block.find(".base_select .elements_list .block"),
                        selected_area = ths_block.find("select.selected_area");

                    select_list.each(function() {
                        let ths_list = $(this);

                        ths_list.on("click", () => {
                            selected_area.find(`option[value="${ths_list.index() + 1}"]`).prop('selected', true);
                        });
                    });

                    copy_btn.on("click", () => {
                        ths_block.find("input").select();
                        document.execCommand("Copy");
                    });
                });

                // Confirm button
                let conf_btn       = ths.find("button.confirm_btn_window"),
                    confirm_window = ths.find(".confirm_window");
                    // Confirm button
                    let conf_submit_btn = confirm_window.find(".control button.submit"),
                        conf_close_btn  = confirm_window.find(".control button.close");

                conf_btn.on("click", () => {
                    if (!confirm_window.hasClass("active")) {
                        confirm_window.addClass("active");
                    }
                });
                conf_close_btn.on("click", () => {
                    if (confirm_window.hasClass("active")) {
                        confirm_window.removeClass("active");
                    }
                });
                conf_submit_btn.on("click", () => {
                    if (confirm_window.hasClass("active")) {
                        confirm_window.removeClass("active");
                        ths.submit();
                    }
                });
            });
        }
        // Base form end

        // Help window
        let help_window = $(".help_window");

        if (help_window) {
            help_window.each(function() {
                // This
                let ths = $(this);
                // Content blocks
                let blocks = ths.find(".content_wrapper .tabs_content .block");
                
                blocks.each(function() {
                    // This
                    let blocks_ths = $(this);
                    // Control
                    let header = blocks_ths.find(".header");

                    header.on("click", () => {
                        // Data
                        let block_height  = blocks_ths.find(".wrapper").outerHeight(true);

                        // Условия для активации выбранного пункта
                        if (!blocks_ths.hasClass("active")) {
                            // Сокрытие остальныx пунктов
                            blocks.removeClass("active");
                            // Скрываем остальные блоки
                            blocks.find(".content").height('0px');
                            blocks.find(".content").css('min-height', '0px');

                            // Активируем выбранный элемент
                            blocks_ths.addClass("active");
                            // Открываем блок
                            blocks_ths.find(".content").height(`${block_height}px`);
                            blocks_ths.find(".content").css('min-height', `${block_height}px`);
                        } else {
                            // Сокрытие выбранный элемент
                            blocks_ths.removeClass("active");
                            // Скрываем выбранный блок
                            blocks_ths.find(".content").height('0px');
                            blocks_ths.find(".content").css('min-height', '0px');
                        }
                    });
                });
            });
        }
        // Help window end

        // Base modal window
        let base_modal = $(".base_modal");

        if (base_modal) {
            base_modal.each(function() {
                // This
                let ths = $(this);
                // Content blocks
                let btn_close = ths.find("button.close");
                
                btn_close.on("click", () => {
                    ths.removeClass("active");
                });
            });
        }
        // Base modal window end

        // Base modal button
        let modal_button = $("button.base_modal_button");

        if (modal_button) {
            modal_button.each(function() {
                // This
                let ths = $(this);

                ths.on("click", () => {
                    // Attr
                    let find_obj = ths.attr("data-find-modal");

                    if (!$(`.${find_obj}`).hasClass("active")) {
                        $(`.${find_obj}`).addClass("active");
                    }
                });
            });
        }
        // Base modal button end

        // Main Plans Buy Form
        let main_buy_plan = $(".main_buy_plan");

        if(main_buy_plan) {
            main_buy_plan.each(function() {
                // This
                let ths = $(this);
                // Data
                let invest_sum = ths.find("input#user_card"),
                    min_sum_info = ths.find(".min_sum_info .num"),
                    max_sum_info = ths.find(".max_sum_info .num");
                // Plans select list
                let select_plan = ths.find("#plans__select_plan");
                // Header & Arrow
                let header = ths.find(".base_select .elements_selected"),
                    arrow  = ths.find(".base_select .arrow");
                // Blocks
                let blocks = ths.find(".base_select .elements_list .block");

                // Select first item in select list
                function selectFirstObject() {
                    let ths_block = ths.find(".base_select .elements_list .block").eq(0);

                    // Attribute
                    let min  = Number(ths_block.attr("data-max-sum")),
                        max  = Number(ths_block.attr("data-min-sum")),
                        user = Number(ths_block.attr("data-user-sum"));

                    select_plan.find(`option[value="${ths_block.attr("data-id")}"]`).prop('selected', true);

                    // Условия если max или min ничему не равны\не найдены
                    if (!max) {
                        max = 0;
                    }
                    if (!min) {
                        min = 0;
                    }

                    // Аттрибуты мин. и макс. значения для поля суммы
                    if (min == 0) {
                        invest_sum.attr("min", 1);
                    } else {
                        invest_sum.attr("min", (min - user));
                    }
                    invest_sum.attr("max", (max - user));
                    // Строки с текстом мин. и макс. суммы
                    if ((min - user) <= 0) {
                        min_sum_info.text(0);
                    } else {
                        min_sum_info.text((min - user));
                    }
                    max_sum_info.text((max - user));

                    header.find(".block.active p.text").text(ths_block.text());
                    select_plan.find(`option[value="${ths_block.attr("data-id")}"]`).prop('selected', true);
                }
                selectFirstObject();

                // Обработка для расчета высоты списка элементов
                function swipeList() {
                    if (ths.find(".base_select").hasClass("active")) {
                        ths.find(".base_select .elements_list").css("height", (blocks.outerHeight(true) * blocks.length));
                    }
                    else {
                        ths.find(".base_select .elements_list").css("height", "0");
                    }
                }

                header.on("click", () => {
                    swipeList();
                });
                arrow.on("click", () => {
                    swipeList();
                });

                blocks.each(function() {
                    let blocks_ths = $(this);

                    blocks_ths.on("click", () => {
                        // Функция
                        swipeList();

                        // Attribute
                        let min  = Number(blocks_ths.attr("data-max-sum")),
                            max  = Number(blocks_ths.attr("data-min-sum")),
                            user = Number(blocks_ths.attr("data-user-sum"));

                        select_plan.find(`option[value="${blocks_ths.attr("data-id")}"]`).prop('selected', true);

                        // Условия если max или min ничему не равны\не найдены
                        if (!max) {
                            max = 0;
                        }
                        if (!min) {
                            min = 0;
                        }

                        // Аттрибуты мин. и макс. значения для поля суммы
                        if (min == 0) {
                            invest_sum.attr("min", 1);
                        } else {
                            invest_sum.attr("min", (min - user));
                        }
                        invest_sum.attr("max", (max - user));
                        // Строки с текстом мин. и макс. суммы
                        if ((min - user) <= 0) {
                            min_sum_info.text(0);
                        } else {
                            min_sum_info.text((min - user));
                        }
                        max_sum_info.text((max - user));
                    });
                });
            });
        }
        // Main Plans Buy Form End

        // Main Invest Merchant Form
        let merchant_form = $(".merchant_form");

        if(merchant_form) {
            merchant_form.each(function() {
                // This
                let ths = $(this);
                // Blocks in select list
                let blocks = ths.find(".base_select .elements_list .block");
                // Find object wrapper
                let merchant_system = ths.find(".list_merchant_system")

                blocks.each(function() {
                    let blocks_ths = $(this);

                    blocks_ths.on("click", () => {
                        // Attribute
                        let find_elem = blocks_ths.attr("data-find-box");

                        merchant_system.find(`input#payed_paysys_${find_elem}`).prop("checked", true);
                    });
                });
            });
        }
        // Main Invest Merchant Form End

        // Main Referrals Tabs
        let main_referrals_tabs = $(".main_referrals_tabs");

        if (main_referrals_tabs) {
            main_referrals_tabs.each(function() {
                // This
                let ths = $(this);
                // Select list
                let select_list = ths.find(".base_select .elements_list .block");
                // Tab content
                let tabs_content = ths.find(".tabs_content");
                // Referral counter
                let tables = ths.find(".my_referrals"),
                    counter = 0;

                // Select list
                select_list.each(function() {
                    let block_ths = $(this);

                    block_ths.on("click", () => {
                        tabs_content.find(`.my_referrals`).removeClass("active");
                        tabs_content.find(`.my_referrals.my_ref_${(block_ths.index() + 1)}`).addClass("active");
                    });
                });

                tables.each(function() {
                    // This
                    let ths = $(this);
                    // Table tr
                    let tr_length = ths.find("tbody tr").length;

                    counter += tr_length;
                });

                $(".main_ref_statistic").find(".block .data .ref-num").text(counter);
            });
        }
        // Main Referrals Tabs End

        // Referral link
        let main_referral_link = $(".main_referral_link");

        if (main_referral_link) {
            main_referral_link.each(function() {
                // This
                let ths = $(this);
                // Copy button
                let copy_btn = ths.find(".link button.copy");
                // Data
                let data_copy = ths.find(".link input");

                copy_btn.on("click", () => {
                    data_copy.select();
                    document.execCommand("Copy");
                });
            });
        }
        // Referral link end

        // Slider on home page
        let slider_on_home = $(".main_plan_and_statistic .main_plan");

        if (slider_on_home) {
            slider_on_home.each(function() {
                let ths = $(this);
                // Slides
                let all_slide    = ths.find(".all_slides .slide"),
                    active_slide = ths.find(".all_slides .slide.active").index(),
                    length_slide = all_slide.length;
                // Control
                let prev = ths.find(".control_slide .prev"),
                    next = ths.find(".control_slide .next");

                // Switch function
                function slide_switch(eq) {
                    // Скрываем предыдущий слайд
                    all_slide.eq(active_slide).removeClass("active");

                    // Условия для следующего слайда
                    if ((eq) >= length_slide) {
                        all_slide.eq(0).addClass("active");
                        slide_color_switch(0);
                    }
                    else if ((eq) < 0) {
                        all_slide.eq(length_slide - 1).addClass("active");
                        slide_color_switch(length_slide);
                    }
                    else {
                        all_slide.eq(eq).addClass("active");
                        slide_color_switch(eq);
                    }
                }
                // Switch color in slider button
                function slide_color_switch(eq) {
                    active_slide = ths.find(".all_slides .slide.active").index();

                    // Удаляем старые цвета
                    ths.removeClass("yellow");
                    ths.removeClass("purple");
                    ths.removeClass("green");
                    ths.removeClass("blue");

                    if (active_slide == 0) {
                        ths.addClass("yellow");
                    }
                    else if (active_slide == 1) {
                        ths.addClass("purple");
                    }
                    else if (active_slide == 2) {
                        ths.addClass("green");
                    }
                    else if (active_slide == 3) {
                        ths.addClass("blue");
                    }
                }

                prev.on("click", () => {
                    active_slide = ths.find(".all_slides .slide.active").index();

                    slide_switch(active_slide - 1);
                });
                next.on("click", () => {
                    active_slide = ths.find(".all_slides .slide.active").index();

                    slide_switch(active_slide + 1);
                });
            });
        }
        // Slider on home end

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
                let data_days    = ths.find(".data_user_get .days h4"),
                    data_income  = ths.find(".data_user_get .income h4"),
                    data_min_sum = ths.find(".data_sum .invest_sum .min_sum"),
                    data_max_sum = ths.find(".data_sum .invest_sum .max_sum");

                let get_data = () => {
                    // Обновлаем данные
                    let plan_active       = Number(select_plan.val()),
                        tape_days         = Number(calc_tape.val()),
                        sum_value         = Number(invest_input.val());
                    // Plans attribute
                    let plan_days         = Number(select_plan.find("option").eq(plan_active - 1).attr("data-lastDay")),
                        plan_low_percent  = Number(select_plan.find("option").eq(plan_active - 1).attr("data-firstPercent")),
                        plan_high_percent = Number(select_plan.find("option").eq(plan_active - 1).attr("data-lastPercent")),
                        plan_min_sum      = Number(select_plan.find("option").eq(plan_active - 1).attr("data-minSum")),
                        plan_max_sum      = Number(select_plan.find("option").eq(plan_active - 1).attr("data-maxSum"));
                    // Variables
                    let income_sum,
                        plan_different    = ((plan_low_percent + plan_high_percent) / 2) / 100;

                    invest_input.attr("max", plan_max_sum);

                    // Если введеная сумма больше чем доступная по плану - уменьшить до доступной
                    if (sum_value > plan_max_sum && sum_value != '') {
                        invest_input.addClass("error");
                    }
                    else if (sum_value < plan_min_sum && sum_value != '') {
                        invest_input.addClass("error");
                    }
                    else {
                        invest_input.removeClass("error");
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
                    // Выставляем данные для дней и дохода
                    data_min_sum.text(plan_min_sum);
                    data_max_sum.text(plan_max_sum);
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
    });
}());