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
                        

                    },
                    error: function(xhr) {
                        console.error('خطا:', xhr.responseText);
                    }
                });



            });
        });
    </script>
@endpush
