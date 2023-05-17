<script type="text/javascript">
    $(document).ready(function () {
        $('#events-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            scrollX: true,
            bLengthChange: true,
            pageLength: 10,
            ajax: "{{ route('admin.events.datatable.events') }}",
            language: {
                url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json'
            },
            columns: [
                {data: 'id', id: 'id'},
                {data: 'name', id: 'name'},
                {data: 'created_at', name: 'created_at', type: 'date'},
                {data: 'updated_at', name: 'updated_at', type: 'date'},
                {data: 'actions', name: 'actions'}
            ]
        });
    });
</script>