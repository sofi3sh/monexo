<script type="text/javascript">
    $(document).ready(function () {
        $('.btn-delete').on('click', openDeleteModal)
    });

    function openDeleteModal() {
        const $_btn = $(this);
        const id = $_btn.data('id');
        const form = $_btn.closest('form');

        const $_modal = $('#deleteModal');

        $('body').prepend($_modal);

        $_modal.modal()

        $('.btn-delete-confirm').on('click', function () {
            form.submit();
            $_modal.hide();
        })

        $_modal.on('hidden.bs.modal', function (event) {
            $_modal.off('click');
            $_modal.modal('dispose');
        })
    }
</script>
