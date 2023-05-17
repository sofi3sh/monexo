
let $answerContainer = $('.container-answer');
let $templateContainer = $('.container-template');

let interval;

$('#modalCorrespondent').on('hide.bs.modal', function() {
        clearInterval(interval);
})

$('.row-ticket-my').on('click', function () {
    const ticketId = $($(this).children()[0]).text();
    ajaxShowMessages(ticketId);
    setViewedMessages(ticketId);
    interval = setInterval(ajaxShowMessages, 3000, ticketId);

    $('#modalCorrespondent').modal('show');

});

$('#button_answer').on('click', function () {
    let ticketId = $('#ticket_id').val();
    let answer = $('#text_answer').val();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: '/home/ticket/add-answer',
        data: { 'ticket_id': ticketId, 'answer': answer },
        success: function (response) {
            if (response.error === false) {
                const {humans_time, answer, user_name} = response;
                
                $answerContainer.append(getAnswer({
                    name:   user_name,
                    humans_time:   humans_time,
                    answer: answer,
                }));

                $('#text_answer').val('');
            }

        },
        error: function (jqXHR) {
            console.log(jqXHR.responseText);
        },
    });
});

function setViewedMessages(ticketId)
{
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: '/home/ticket/' + ticketId + '/set-viewed',
        data: { 'ticket_id': ticketId },
        success: function (count) {
            $('#ticket-table .row-ticket-my > td:first-child').each(function (index, el) {
                const $el = $(el);

                if($el.text() === ticketId) {
                    $el.closest('tr').find('#not-viewed').text(0)
                }

                $('#tickets-count').text(+count ? count : '');
            });
        },
        error: function (jqXHR, exception) {
            console.log(jqXHR);
            console.log(exception);
        },
    });
}

$('.container-template').on('change', function (e) {
    const template = $(e.target).val();

    $('#text_answer').val(template);
});

function getAnswer(props) {
    const {name, humans_time, answer} = props;

    return `
    <li class="list-group-item">
        <div class="d-flex justify-content-between"><span>${name}</span><span>${humans_time}</span></div>
        <span>Ответ: ${answer}</span>
    </li>`;
}

function getResponseTemplate(props) {

    const {response_template} = props;

    return `
        <label class="mr-3" style="cursor: pointer">
            <input name="radio-template" class="mr-1 d-none" type="radio" value="${response_template}">
            <span class="text-break">${response_template}</span>
        </label>
    `;
}

function ajaxShowMessages(ticketId) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: '/home/ticket/correspondence',
        data: { 'ticket_id': ticketId },
        success: function (response) {
            if (response.error === false) {

                $('#ticket_id').val(ticketId);

                const {
                    theme,
                    appeal_descr,
                    created_at,
                    author_name,
                    author_email,
                    author_phone,
                    question
                } = response;

                const map = {
                    '#modal-theme': theme,
                    '#modal-appeal-descr': appeal_descr,
                    '#created_at': created_at,
                    '#author_name': author_name,
                    '#author_email': author_email,
                    '#author_phone': author_phone,
                    '#question': question,
                    '.container-answer': '',
                    '.container-template': '',
                };

                for(let selector in map) {
                    $(selector).text(map[selector]);
                }

                Array.from(response.answer).forEach(ticket => {
                    $answerContainer.append(getAnswer({
                        name: ticket.user.name,
                        humans_time: ticket['humans_time'],
                        answer: ticket.answer,
                    }));
                });

                Array.from(response.response_template).forEach(ticket => {
                    $templateContainer.append(getResponseTemplate({
                        response_template: ticket.template,
                    }));
                });


                if (response.is_attachment === true) {
                    $('#button-attachment').show();
                } else {
                    $('#button-attachment').hide();
                }

                $('#modalCorrespondent').modal('show');
            }
        },
        error: function (jqXHR, exception) {
            let msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status === 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status === 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            console.log(msg);
            console.log(exception);
        },
    });
}



