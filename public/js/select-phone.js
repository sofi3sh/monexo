// $(function() {

//     const intlTelInputSettings = {
//         initialCountry: 'auto',
//         geoIpLookup: function(callback) {
//             $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
//             var countryCode = (resp && resp.country) ? resp.country : "ru";
//             callback(countryCode);
//             });
//         },
//         separateDialCode: true,
//         preferredCountries: ['ru', 'kz', 'ua', 'by', 'us', 'gb', 'uz', 'kg', 'ge', 'md']
//     };

//     $formPhone = $('#form-phone');

//     $formPhone.intlTelInput(intlTelInputSettings).on('input', function(e) {
//         e.target.value = e.target.value.replace(/\D/g, '');
//         const num = $formPhone.intlTelInput("getNumber");
//         $('#form-phone-hidden').val(num);
//     });

// });