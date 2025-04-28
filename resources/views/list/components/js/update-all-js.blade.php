@push('scripts')
    <script>
        $(document).ready(function() {
            $('a[data-bs-target="#staticBackdrop"]').on('click', function(e) {

                e.preventDefault();

                // پیدا کردن سطر والد
                const $row = $(this).closest('tr');
                let residentId = $row.data('resident-id');
                // استخراج داده‌ها از سطر
                let data = {
                    residentId : $row.data('resident-id'),
                    fullName : $row.find('input[name="full_name"]').val(),
                    phone : $row.find('input[name="phone"]').val(),
                    endDate : $row.find('input[name="end_date"]').val(),
                    bedNumber : $row.find('td:first').text().trim(),
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
                        console.log(response);

                    },
                    error: function(xhr) {
                        console.error('خطا:', xhr.responseText);
                    }
                });



            });
        });
    </script>
@endpush
