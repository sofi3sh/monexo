<script type="text/javascript">
    $(document).ready(function () {
        $('#faq-questions-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            scrollX: true,
            bLengthChange: true,
            pageLength: 10,
            ajax: "{{ route('admin.faq.datatable.questions') }}",
            language: {
                url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json'
            },
            columns: [
                {data: 'id', id: 'id'},
                {data: 'name', id: 'name'},
                {data: 'category', name: 'category'},
                {data: 'created_at', name: 'created_at', type: 'date'},
                {data: 'updated_at', name: 'updated_at', type: 'date'},
                {data: 'actions', name: 'actions'}
            ]
        });

        $('#faq-categories-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            bLengthChange: true,
            pageLength: 10,
            ajax: "{{ route('admin.faq.datatable.categories') }}",
            language: {
                url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json'
            },
            columns: [
                {data: 'id', id: 'id'},
                {data: 'name', id: 'name'},
                {data: 'description', id: 'description'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'actions', name: 'actions'}
            ]
        });
    });
</script>
