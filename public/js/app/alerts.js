$(function() {  
    const $counts = $('.alerts-count');
    const $dropdown = $('#alerts-dropdown');
    const $alertsList = $('#alerts-list');
    let alerts = [];
    
    $dropdown
        .on('show.bs.dropdown', function() {
            setAlerts()
        })
        .on('hide.bs.dropdown', function() {
            
            if(alerts[0]['viewed'] === 0) {
                updateCount(alerts.length)
            } else {
                updateCount('')
            }

            updateList(alerts)
        });

    function updateCount(count) {
        $counts.each(function(index) {
            $(this).text(count).addClass('d-none')
        });
    }

    function setAlerts() {
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: `/home/alerts-viewed/${user_id}`,
                success: function (response) {
                    if(response.error === false) {
                        alerts = response.alerts;
                    }
                },
                error: function (jqXHR) {
                    console.log(jqXHR.responseText);
                },
            });
    }

    function updateList(alerts) {
        let result = '';
        
        alerts.forEach((alert, index) => {
            const isLast = index === alerts.length - 1;
            result += getListItem(alert, isLast);
        });

        $alertsList.html(result);
    }

    function getListItem(alert, isLast) {
        
        for(let key in alert) {
            alert[key] = alert[key] || '';
        }

        return `
            <li class="list-group-item ${isLast ? 'border-bottom-0' : '\b'}">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div>
                            <small>${alert.human_date}</small>
                        </div>
                        <div class="text-sm text-wrap mr-3" style="max-width: 350px">
                            ${alert.volume}
                            ${alert.payment_system}
                            ${alert.type_name}
                            ${alert.add_info}
                        </div>
                    </div>
                    <div>
                        ${alert.icon}
                    </div>
                </div>
            </li>
        `;
    }
});