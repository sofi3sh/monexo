<script type="text/javascript">
    $(document).ready(function () {
        $('#partners-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            scrollX: false,
            bLengthChange: true,
            pageLength: 10,
            ajax: "{{ route('admin.datatable.partners') }}",
            language: {
                url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json'
            },
            columns: [
                {data: 'id', id: 'ID'},
                {data: 'name', id: 'name'},
                {data: 'surname', id: 'surname'},
                {data: 'city', name: 'city'},
                {data: 'phone', name: 'phone'},
                {data: 'telegram', name: 'telegram'},
                {data: 'date_birthday', name: 'date_birthday', type: 'date'},
                {data: 'created_at', name: 'created_at', type: 'date'},
                {data: 'updated_at', name: 'updated_at', type: 'date'},
                {data: 'actions', name: 'actions'}
            ]
        });
    });
</script>
