;$(function () {
    $('#button-paste-answer').on('click', function () {
        let template = $("input:checked").val();
        $('#input_answer').val(template);
    });
});
