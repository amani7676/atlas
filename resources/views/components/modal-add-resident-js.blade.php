@push('scripts')
    <script>
        $(document).on('click', 'a[data-bs-toggle="modal"]', function() {

            const takhtId = $(this).attr('data-takht_id');
            const otaghId = $(this).attr('data-otagh_id');

            $('#otagh_name_title_modal_add').text(otaghId + '  اتاق ');
            $('#takht_name_title_modal_add').text(takhtId + '  تخت ');


            $('input[name="takht_name_add"]').val(takhtId);
            $('input[name="otagh_name_add"]').val(otaghId);
        });

    </script>
@endpush
