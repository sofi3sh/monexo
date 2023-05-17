<script type="text/javascript">
    $(document).ready(function () {
        $('#all-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            scrollX: true,
            bLengthChange: true,
            pageLength: 10,
            ajax: "{{ route('admin.partners-map.buy.datatable.all') }}",
            language: {
                url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json'
            },
            columns: [
                {data: 'id', id: 'id'},
                {data: 'info', id: 'info'},
                {data: 'status', id: 'status'},
                {data: 'action', id: 'action'},
            ]
        });

        $('#not-done-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            bLengthChange: true,
            pageLength: 10,
            ajax: "{{ route('admin.partners-map.buy.datatable.done') }}",
            language: {
                url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json'
            },
            columns: [
                {data: 'id', id: 'id'},
                {data: 'info', id: 'info'},
                {data: 'status', id: 'status'},
                {data: 'action', id: 'action'},
            ]
        });

        $('#done-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            bLengthChange: true,
            pageLength: 10,
            ajax: "{{ route('admin.partners-map.buy.datatable.not-done') }}",
            language: {
                url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json'
            },
            columns: [
                {data: 'id', id: 'id'},
                {data: 'info', id: 'info'},
                {data: 'status', id: 'status'},
                {data: 'action', id: 'action'},
            ]
        });

        $('#end-of-sub-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            bLengthChange: true,
            pageLength: 10,
            ajax: "{{ route('admin.partners-map.buy.datatable.end-of-sub') }}",
            language: {
                url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json'
            },
            columns: [
                {data: 'id', id: 'id'},
                {data: 'info', id: 'info'},
                {data: 'status', id: 'status'},
                {data: 'action', id: 'action'},
                ]
            });

    });
    
    

</script>
