(function () {
    $('document').ready(function () {
        $('.base-table_wrapper').each(function() {
            var thisWrapper = $(this);

            // Создание обертки для поиска и пагинации
            function createWrapperFromPag() {
                // thisWrapper.prepend('<div class="base-table_wrapper-search"><input type="text" placeholder="' + thisWrapper.attr('data-lang-search') + '"></div>');

                thisWrapper.append('<div class="paginations"></div>');
            }
            // Запуск функции
            createWrapperFromPag();

            // Данные по блокам пагинации
            var contentBlock = thisWrapper.find('table tbody tr');
            var elmenetsOnPage = 8;

            // Создание Data атрибутов для всех элементов
            function createDataNum() {
                for (i = 0; i <= contentBlock.length; i++) {
                    contentBlock.eq(i).attr('data-pag-num', (i + 1));
                }
            }
            // Запуск функции
            createDataNum();

            // Создание пагинации
            function createPaginations() {
                var elementsCount = contentBlock.length,
                    pagBtnCount = Math.ceil(elementsCount / elmenetsOnPage);
                    
                var wrapperPaginations = thisWrapper.find('.paginations');

                for (i = 1; i <= pagBtnCount; i++) {
                    if (i == 1) {
                        wrapperPaginations.append('<span class="pag_btn active" data-check-page="' + i + '">' + i + '</span>');
                    }
                    else {
                        wrapperPaginations.append('<span class="pag_btn" data-check-page="' + i + '">' + i + '</span>');
                    }
                }
            }
            // Запуск функции
            createPaginations();

            // Сокрытие элементов и вывод по активной подстранице
            function hidePagElements() {
                var activePage = thisWrapper.find('.paginations').find('span.active').attr('data-check-page');

                thisWrapper.find('table tbody tr').addClass('hide');

                for (i = (activePage * elmenetsOnPage); i > ((activePage * elmenetsOnPage) - elmenetsOnPage); i--) {
                    thisWrapper.find("[data-pag-num='" + i + "']").removeClass('hide');
                }
            }
            // Запуск функции
            hidePagElements();

            // Ограничения по отображению кнопок пагинации
            function pagBtnView() {
                var activeBtn =  parseInt(thisWrapper.find('.paginations span.active').attr('data-check-page')),
                    lastBtn = parseInt(thisWrapper.find('.paginations span').last().attr('data-check-page'));

                thisWrapper.find('.paginations span').addClass('hide');
                thisWrapper.find('.paginations span').removeClass('dot-l');
                thisWrapper.find('.paginations span').removeClass('dot-r');

                if (activeBtn == 1) {
                    thisWrapper.find('.paginations').find("[data-check-page='" + activeBtn + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (activeBtn + 1) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (activeBtn + 2) + "']").removeClass('hide');

                    thisWrapper.find('.paginations').find("[data-check-page='" + (activeBtn + 3) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (activeBtn + 3) + "']").addClass('dot-r');

                    thisWrapper.find('.paginations').find("[data-check-page='" + lastBtn + "']").removeClass('hide');
                }
                else if (activeBtn == 2) {
                    thisWrapper.find('.paginations').find("[data-check-page='" + (activeBtn - 1) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + activeBtn + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (activeBtn + 1) + "']").removeClass('hide');

                    thisWrapper.find('.paginations').find("[data-check-page='" + (activeBtn + 2) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (activeBtn + 2) + "']").addClass('dot-r');

                    thisWrapper.find('.paginations').find("[data-check-page='" + lastBtn + "']").removeClass('hide');
                }
                else if (activeBtn == 3) {
                    thisWrapper.find('.paginations').find("[data-check-page='" + (activeBtn - 2) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (activeBtn - 1) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + activeBtn + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (activeBtn + 1) + "']").removeClass('hide');

                    thisWrapper.find('.paginations').find("[data-check-page='" + (activeBtn + 2) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (activeBtn + 2) + "']").addClass('dot-r');

                    thisWrapper.find('.paginations').find("[data-check-page='" + lastBtn + "']").removeClass('hide');
                }
                else if (activeBtn == lastBtn) {
                    thisWrapper.find('.paginations').find("[data-check-page='" + 1 + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + lastBtn + "']").removeClass('hide');

                    thisWrapper.find('.paginations').find("[data-check-page='" + (lastBtn - 1) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (lastBtn - 2) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (lastBtn - 3) + "']").removeClass('hide');

                    thisWrapper.find('.paginations').find("[data-check-page='" + (lastBtn - 4) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (lastBtn - 4) + "']").addClass('dot-l');
                }
                else if (activeBtn == (lastBtn - 1)) {
                    thisWrapper.find('.paginations').find("[data-check-page='" + 1 + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + lastBtn + "']").removeClass('hide');

                    thisWrapper.find('.paginations').find("[data-check-page='" + (lastBtn - 1) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (lastBtn - 2) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (lastBtn - 3) + "']").removeClass('hide');

                    thisWrapper.find('.paginations').find("[data-check-page='" + (lastBtn - 4) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (lastBtn - 4) + "']").addClass('dot-l');
                }
                else if (activeBtn == (lastBtn - 2)) {
                    thisWrapper.find('.paginations').find("[data-check-page='" + 1 + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + lastBtn + "']").removeClass('hide');

                    thisWrapper.find('.paginations').find("[data-check-page='" + (lastBtn + 2) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (lastBtn + 1) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (lastBtn - 1) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (lastBtn - 2) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (lastBtn - 3) + "']").removeClass('hide');

                    thisWrapper.find('.paginations').find("[data-check-page='" + (lastBtn - 4) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (lastBtn - 4) + "']").addClass('dot-l');
                }
                else {
                    thisWrapper.find('.paginations').find("[data-check-page='" + 1 + "']").removeClass('hide');

                    thisWrapper.find('.paginations').find("[data-check-page='" + (activeBtn - 2) + "']").addClass('dot-l');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (activeBtn - 2) + "']").removeClass('hide');

                    thisWrapper.find('.paginations').find("[data-check-page='" + (activeBtn - 1) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + activeBtn + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (activeBtn + 1) + "']").removeClass('hide');

                    thisWrapper.find('.paginations').find("[data-check-page='" + (activeBtn + 2) + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + (activeBtn + 2) + "']").addClass('dot-r');

                    thisWrapper.find('.paginations').find("[data-check-page='" + lastBtn + "']").removeClass('hide');
                }

                if (thisWrapper.find('.paginations span').length == 4 || thisWrapper.find('.paginations span').length == 5 || thisWrapper.find('.paginations span').length == 6) {
                    thisWrapper.find('.paginations span').removeClass('dot-l');
                    thisWrapper.find('.paginations span').removeClass('dot-r');
                    
                    thisWrapper.find('.paginations').find("[data-check-page='" + 1 + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + 2 + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + 3 + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + 4 + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + 5 + "']").removeClass('hide');
                    thisWrapper.find('.paginations').find("[data-check-page='" + 6 + "']").removeClass('hide');
                }
            }
            // Запуск функции
            pagBtnView();

            // Функция переключения подстраниц на пагинации
            // Назначение функции на кнопки пагинации
            thisWrapper.find('.paginations').find('span').click(function(){
                var thisBtn = $(this),
                    thisDataNum = thisBtn.attr('data-check-page');

                thisWrapper.find('table tbody tr').addClass('hide');
                thisWrapper.find('.paginations span').removeClass('active');

                thisBtn.addClass('active');
                
                // Запуск функции на ограничения отображения кнопок пагинации
                pagBtnView();
                
                for (i = (thisDataNum * elmenetsOnPage); i > ((thisDataNum * elmenetsOnPage) - elmenetsOnPage); i--) {
                    thisWrapper.find("[data-pag-num='" + i + "']").removeClass('hide');
                }
            });

            // Функция поиска по контенту блоков/элементов
            // Назначение функции при активности фнутри поля поиска
            // thisWrapper.find('.base-table_wrapper-search input').keyup(function() {
            //     var thisText = $(this).val();

            //     thisWrapper.find('table tbody tr').addClass('hide');

            //     if (thisText == '' || thisText === '') {
            //         thisWrapper.find('.paginations').removeClass('hide');
            //     }
            //     else {
            //         thisWrapper.find('.paginations').addClass('hide');
            //     }

            //     thisWrapper.find('table tbody tr').each(function() {
            //         var thisBlock = $(this);
                    
            //         thisBlock.find('td').each(function() {
            //             var thisTD = $(this),
            //                 thisBlockText = String(thisTD.attr('data-tnsm--sort')),
            //                 thisBlockText2 = String(thisTD.attr('data-tnsm--crypto')),
            //                 thisBlockTextAll = String(thisTD.text());

            //             if (thisBlockText.indexOf(String(thisText)) + 1 || thisBlockText2.indexOf(String(thisText)) + 1 || thisBlockTextAll.indexOf(String(thisText)) + 1) {
            //                 thisBlock.removeClass('hide');
            //             }
            //         });

            //         // Если поле пустое вернуть блоки
            //         if (thisText == '' || thisText === '' || thisText == undefined || thisText === undefined) {
            //             hidePagElements();
            //             thisWrapper.find('.paginations').removeClass('hide');
            //         }
            //     });
            // });
            // thisWrapper.find( ".base-table_wrapper-search input" ).focusout(function() {
            //     var thisText = $(this).val();
                
            //     if (thisText == '' || thisText === '') {
            //         thisWrapper.find('.paginations').removeClass('hide');
            //         hidePagElements();
            //     }
            //     else {
            //         thisWrapper.find('.paginations').addClass('hide');
            //     }
            // });
        });
    });
}());