@push('scripts')
    <script>
        $(document).ready(function() {
            $('a[data-bs-target="#staticBackdrop"]').on('click', function(e) {
                e.preventDefault();
                // پیدا کردن سطر والد
                const $row = $(this).closest('tr');
                let residentId = $row.data('resident-id');
                let takht_name = $row.find('td:first').text().trim();
                // استخراج داده‌ها از سطر
                let data = {
                    residentId: $row.data('resident-id'),
                    fullName: $row.find('input[name="full_name"]').val(),
                    phone: $row.find('input[name="phone"]').val(),
                    endDate: $row.find('input[name="end_date"]').val(),
                    bedNumber: $row.find('td:first').text().trim(),
                    _token: '{{ csrf_token() }}'
                }


                $.ajax({
                    url: `/residents/update-all/${residentId}`,
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function(response) {

                        $('#full_name-collapse').text(response.data[0].full_name); // برای h4
                        $('#takht_name_collapse').val(takht_name); // شماره تخت
                        $('#job_collapse').val(response.data[0].job); // شغل
                        $('#age_collapse').val(response.data[0].age); // سن

                        // // برای چک‌باکس‌ها:
                        $('#madrak_collapse').prop('checked', response.data[0].madrak); // مدرک
                        $('#form_collapse').prop('checked', response.data[0].form); // فرم
                        $('#vadeh_collapse').prop('checked', response.data[0].vadeh); // فرم
                        $('#ajareh_collapse').prop('checked', response.data[0].ejareh); // فرم
                        $('input[name="id"]').val(response.data[0]
                            .resident_id); // 123 مثال از یک ID
                        $('select[name="state_collapse"]').val(response.data[0].state);

                        //مقدار دهی برای دکمه های حذف

                        $('#etmamgharardad').data('resident-id', response.data[0]
                            .resident_id);
                        $('#delete_col_az_database').data('resident-id', response.data[0]
                            .resident_id);
                    },
                    error: function(xhr) {
                        console.error('خطا:', xhr.responseText);
                    }
                });
            });

            $('#etmamgharardad').click(function(e) {
                e.preventDefault(); // جلوگیری از رفتار پیشفرض لینک

                // دریافت resident_id از data attribute
                var residentId = $(this).data('resident-id');

                // ساخت URL با استفاده از route Laravel
                var deleteUrl = "{{ route('resident.softdelete', ['id' => ':id']) }}".replace(':id',
                    residentId);

                // هدایت کاربر به مسیر حذف (GET)
                window.location.href = deleteUrl;
            });
            $('#delete_col_az_database').click(function(e) {
                e.preventDefault(); // جلوگیری از رفتار پیشفرض لینک

                // دریافت resident_id از data attribute
                var residentId = $(this).data('resident-id');

                // ساخت URL با استفاده از route Laravel
                var deleteUrl = "{{ route('resident.forcedelete', ['id' => ':id']) }}".replace(':id',
                    residentId);

                // هدایت کاربر به مسیر حذف (GET)
                window.location.href = deleteUrl;
            });
        });
    </script>
@endpush
