<script type="text/javascript">
    $(document).ready(function () {
        $('#saveSuggestionBtn').on('click', openConfirmationModal);
        $('.like-suggestion').on('click', likeSuggestion);
        $('.dislike-suggestion').on('click', dislikeSuggestion);
        $('#suggestionTypeFilter').on('change', filterList)
    });

    function openConfirmationModal() {
        const $_btn = $(this);
        const form = $_btn.closest('form');

        const $_modal = $('#confirmModal');

        $('body').prepend($_modal);

        $_modal.modal()

        $('#confirmModal .btn-modal-confirm').on('click', function () {
            form.submit();
            $_modal.hide();
        })

        $_modal.on('hidden.bs.modal', function (event) {
            $_modal.off('click');
            $_modal.modal('dispose');
        })
    }

    function likeSuggestion() {
        const $_likeBtn = $(this);
        const $_item = $_likeBtn.closest('.suggestion-item');
        const $_dislikeBtn = $_item.find('.dislike-suggestion');
        const id = $_item.data('id');

        let url = $_likeBtn.hasClass('liked') ?
            '{{route('home.suggestions.unlike', ':id')}}' :
            '{{route('home.suggestions.like', ':id')}}';

        url = url.replace(":id", id);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "PATCH",
            url: url,
            success: function( response ) {
                const $_currentCount = $_likeBtn.find('span.likes-count');
                let currentCount = $_currentCount.text();

                if (response.result === true) {
                    if ($_likeBtn.hasClass('liked')) {
                        $_likeBtn.removeClass('liked');
                        $_currentCount.text(--currentCount);
                    } else {
                        $_likeBtn.addClass('liked');
                        $_currentCount.text(++currentCount);
                    }
                }

                if ($_dislikeBtn.hasClass('liked')) {
                    $_dislikeBtn.removeClass('liked');
                    const $_dislikesCount = $_dislikeBtn.find('span.likes-count');
                    let dislikesCount = $_dislikesCount.text()
                    $_dislikesCount.text(--dislikesCount);
                }
            }
        });
    }

    function dislikeSuggestion() {
        const $_dislikeBtn = $(this);
        const $_item = $_dislikeBtn.closest('.suggestion-item');
        const $_likeBtn = $_item.find('.like-suggestion');
        const id = $_item.data('id');

        let url = $_dislikeBtn.hasClass('liked') ?
            '{{route('home.suggestions.unlike', ':id')}}' :
            '{{route('home.suggestions.dislike', ':id')}}';

        url = url.replace(":id", id);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "PATCH",
            url: url,
            success: function( response ) {
                const $_currentCount = $_dislikeBtn.find('span.likes-count');
                let currentCount = $_currentCount.text();

                if (response.result === true) {
                    if ($_dislikeBtn.hasClass('liked')) {
                        $_dislikeBtn.removeClass('liked');
                        $_currentCount.text(--currentCount);
                    } else {
                        $_dislikeBtn.addClass('liked');
                        $_currentCount.text(++currentCount);
                    }
                }

                if ($_likeBtn.hasClass('liked')) {
                    $_likeBtn.removeClass('liked');
                    const $_likesCount = $_likeBtn.find('span.likes-count');
                    let likesCount = $_likesCount.text()
                    $_likesCount.text(--likesCount);
                }
            }
        });
    }

    function filterList() {
        let url = '{{ route('home.suggestions.index') }}';
        let typeId = $('#suggestionTypeFilter').val();

        if (typeId) {
            url += '?type_id=' + typeId;
        }

        window.location.href = url;
    }
</script>
