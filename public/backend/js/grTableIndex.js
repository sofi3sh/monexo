$(document).ready(function () {
    // Распределения данных
    $('.transactions-ns-model').each(function() {
        var thsiTable = $(this);
            tableData = thsiTable.find('.tnsm-body tr');

        tableData.each(function() {
            var thisTape = $(this),
                thisTime = thisTape.find('td.tnsm--time'),
                thisCrypto = thisTape.find('td.tnsm--сrypto'),
                thisUSD = thisTape.find('td.tnsm--usd'),
                thisRate = thisTape.find('td.tnsm--rate'),
                thisEmail = thisTape.find('td.tnsm--email'),
                thisUser = thisTape.find('td.tnsm--user'),
                thisType = thisTape.find('td.tnsm--type');
            
            var timeEdit = thisTime.attr('data-tnsm--time'),
                userLetter = thisUser.attr('data-tnsm--user');

            thisTime.find('h2').text(timeEdit.substr(-8, 5));
            thisTime.find('small').text(timeEdit.substr(0, 10));
            thisUser.find('.logo span').text(String(userLetter).charAt(0));

            thisCrypto.find('.logo img').attr('src', ('../backend/img/gr-table-icons/gr-' + thisCrypto.attr('data-tnsm--crypto') + '.png'));
            thisCrypto.find('.content h2').text(thisCrypto.attr('data-tnsm--crypto'));
            thisCrypto.find('.content small').text(thisCrypto.attr('data-tnsm--crypto-sum'));

            thisUSD.find('.content small').text(thisUSD.attr('data-tnsm--usd-sum'));

            thisRate.find('.content small').text(thisRate.attr('data-tnsm--rate-sum'));

            thisEmail.find('.content small').text(thisEmail.attr('data-tnsm--email'));

            thisUser.find('.content h2').text(thisUser.attr('data-tnsm--user'));
            thisUser.find('.content small').text(thisUser.attr('data-tnsm--user-type'));

            thisType.find('.content h2').text(thisType.attr('data-tnsm--type'));
        });
    });

    // Сортировка по таблицам
    $('.transactions-ns-model').each(function() {
        var thsiTable = $(this);

        function sortTable(f, n) {
            var rows = thsiTable.find('tbody tr').get();

            rows.sort(function (a, b) {

                var A = getVal(a);
                var B = getVal(b);

                if (A < B) {
                    return -1 * f;
                }
                if (A > B) {
                    return 1 * f;
                }
                return 0;
            });

            function getVal(elm) {
                var v = $(elm).children('td').eq(n).attr('data-tnsm--sort');
                if ($.isNumeric(v)) {
                    v = parseFloat(v, 10);
                }
                return v;
            }

            $.each(rows, function (index, row) {
                thsiTable.children('tbody').append(row);
            });
        }

        var f_first = 1,
            f_second = 1,
            f_third = 1,
            f_fourth = 1,
            f_fifth = 1;

        thsiTable.find('.tnsm-header .first').click(function () {
            f_first *= -1;
            
            thsiTable.find('.tnsm-header tr th span').removeClass('active');

            if (f_first == 1) {
                $(this).find('span.up').addClass('active');
            }
            else {
                $(this).find('span.down').addClass('active');
            }

            var n = $(this).prevAll().length;
            sortTable(f_first, n);
        });
        thsiTable.find('.tnsm-header .second').click(function () {
            f_second *= -1;
            
            thsiTable.find('.tnsm-header tr th span').removeClass('active');

            if (f_second == 1) {
                $(this).find('span.up').addClass('active');
            }
            else {
                $(this).find('span.down').addClass('active');
            }

            var n = $(this).prevAll().length;
            sortTable(f_second, n);
        });
        thsiTable.find('.tnsm-header .third').click(function () {
            f_third *= -1;
            
            thsiTable.find('.tnsm-header tr th span').removeClass('active');

            if (f_third == 1) {
                $(this).find('span.up').addClass('active');
            }
            else {
                $(this).find('span.down').addClass('active');
            }

            var n = $(this).prevAll().length;
            sortTable(f_third, n);
        });
        thsiTable.find('.tnsm-header .fourth').click(function () {
            f_fourth *= -1;
            
            thsiTable.find('.tnsm-header tr th span').removeClass('active');

            if (f_fourth == 1) {
                $(this).find('span.up').addClass('active');
            }
            else {
                $(this).find('span.down').addClass('active');
            }

            var n = $(this).prevAll().length;
            sortTable(f_fourth, n);
        });
        thsiTable.find('.tnsm-header .fifth').click(function () {
            f_fifth *= -1;
            
            thsiTable.find('.tnsm-header tr th span').removeClass('active');

            if (f_fifth == 1) {
                $(this).find('span.up').addClass('active');
            }
            else {
                $(this).find('span.down').addClass('active');
            }

            var n = $(this).prevAll().length;
            sortTable(f_fifth, n);
        });
    });
});