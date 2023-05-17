$(function() {
    $('.button-responsible').click(function() {
        let ticketId = Number(this.id.substr(12, this.id.length));

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: '/tt-admin/ticket-support/responsible',
            data: {'ticket_id': ticketId },
            success: function( response ) {
                if (response.error === false) {
                    $('#responsible-id').text(response.responsible_id);
                    $('#responsible-email').text(response.responsible_email);
                    $('#responsible-phone').text(response.responsible_phone);
                    $('#responsible-country').text(response.responsible_country);
                    $('#responsible-city').text(response.responsible_city);

                    $('#modalResponible').modal('show');
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
            },
        });

    });
});
