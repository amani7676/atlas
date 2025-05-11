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

        $(document).ready(function() {
            $('#phone_add').on('input', function() {
                // حذف تمام کاراکترهای غیر عددی
                var input = $(this).val().replace(/\D/g, '');

                // محدود کردن طول به 11 رقم (برای شماره موبایل ایران)
                if (input.length > 11) {
                    input = input.substring(0, 11);
                }

                // اعمال فرمت بندی
                var formatted = '';
                if (input.length > 0) {
                    // 4 رقم اول
                    formatted = input.substring(0, Math.min(4, input.length));

                    // 3 رقم بعدی
                    if (input.length > 4) {
                        formatted += '-' + input.substring(4, Math.min(7, input.length));
                    }

                    // 4 رقم آخر
                    if (input.length > 7) {
                        formatted += '-' + input.substring(7, 11);
                    }
                }

                // تنظیم مقدار فرمت شده در فیلد
                $(this).val(formatted);
            });
        });
    </script>
@endpush
