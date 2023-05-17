<script type="text/javascript">
    $(document).ready(function () {
        $('#blog-posts-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            scrollX: true,
            bLengthChange: true,
            pageLength: 10,
            ajax: "{{ route('admin.blog.datatable.posts') }}",
            language: {
                url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json'
            },
            columns: [
                {data: 'id', id: 'id'},
                {data: 'slug', id: 'slug'},
                {data: 'name', id: 'name'},
                {data: 'image', name: 'image'},
                {data: 'category', name: 'category'},
                {data: 'author', name: 'author'},
                {data: 'views', name: 'views'},
                {data: 'meta', name: 'meta'},
                {data: 'tags', name: 'tags'},
                {data: 'published_at', name: 'published_at', type: 'date'},
                {data: 'created_at', name: 'created_at', type: 'date'},
                {data: 'updated_at', name: 'updated_at', type: 'date'},
                {data: 'actions', name: 'actions'}
            ]
        });

        $('#blog-categories-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            bLengthChange: true,
            pageLength: 10,
            ajax: "{{ route('admin.blog.datatable.categories') }}",
            language: {
                url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json'
            },
            columns: [
                {data: 'id', id: 'id'},
                {data: 'slug', id: 'slug'},
                {data: 'name', id: 'name'},
                {data: 'description', id: 'description'},
                {data: 'color', name: 'color'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'actions', name: 'actions'}
            ]
        });

        $('#blog-tags-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            bLengthChange: true,
            pageLength: 10,
            ajax: "{{ route('admin.blog.datatable.tags') }}",
            language: {
                url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json'
            },
            columns: [
                {data: 'id', id: 'id'},
                {data: 'slug', id: 'slug'},
                {data: 'name', id: 'name'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'actions', name: 'actions'}
            ]
        });
    });
</script>
