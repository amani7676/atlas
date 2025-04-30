@push('scripts')
    <script>
        $(document).ready(function() {
            $('a[data-bs-target="#modalDesc"]').on('click', function(e) {
                e.preventDefault();
                // پیدا کردن سطر والد
                const $row = $(this).closest('tr');
                let residentId = $row.data('resident-id');
                // استخراج داده‌ها از سطر
                let data_desc = {
                    residentId: residentId,
                    _token: '{{ csrf_token() }}'
                }

                // console.log(residentId);

                $.ajax({
                    url: `/resident/getDasc/${residentId}`,
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data_desc,
                    success: function(response) {
                        // پاک کردن محتوای قبلی

                        $('.show_list_desc').html('');
                        $('#full_name_desc').text(response.full_name); // برای h4
                        $('#id_resident_modal_desc').val(response.id);

                        // بررسی اینکه آیا ریسپانس یک آرایه است
                        if (Array.isArray(response.descriptions)) {
                            response.descriptions.forEach(function(item) {
                                // می‌تونی بسته به ساختار داده، اینجا نمایش بدی\

                                let listItem = `
                            <button type="button" class="btn btn-secondary position-relative m-3">
                                ${item['desc']}
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger " id="delete_desc" data-idfordeletedesc="${item['id']}">
                                     ×
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </button>
                        `;
                                $('.show_list_desc').append(listItem);
                            });
                        } else {
                            // در صورتی که ریسپانس به صورت تک داده باشه
                            let listItem = `<p>${response.descriptions}</p>`;
                            $('.show_list_desc').append(listItem);
                            
                        }

                    },
                    error: function(xhr) {
                        console.error('خطا:', xhr.responseText);
                    }
                });



            });


            $(document).on('click', '#delete_desc', function() {

                // گرفتن مقدار data-idfordeletedesc
                var descId = $(this).data('idfordeletedesc');
                // ارسال درخواست به کنترلر
                $.ajax({
                    url: `/resident/deleteDesc/${descId}`, // روت حذف توضیحات
                    method: 'POST',
                    data: {
                        id: descId, // ارسال شناسه
                        _token: $('meta[name="csrf-token"]').attr('content') // ارسال توکن CSRF
                    },
                    success: function(response) {
                        const notyf = new Notyf({
                            duration: 5000,
                            dismissible: true,
                            position: {
                                x: 'right',
                                y: 'top',
                            },
                        });


                        notyf.open({
                            type: response.type,
                            message: response.message
                        });
                    },
                    error: function(xhr) {
                        console.error('خطا:', xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
