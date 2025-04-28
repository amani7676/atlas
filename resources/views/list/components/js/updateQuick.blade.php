@push('scripts')
    <script>
        $(document).ready(function() {
            // حذف ایونت‌های قبلی و استفاده از Event Delegation
            $(document).off('click', '.save-resident').on('click', '.save-resident', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                let $row = $(this).closest('tr');
                let residentId = $row.data('resident-id');

                let data = {
                    full_name: $row.find('input[name="full_name"]').val(),
                    phone: $row.find('input[name="phone"]').val(),
                    end_date: $row.find('input[name="end_date"]').val(),
                    _token: '{{ csrf_token() }}'
                };

                $.ajax({
                    url: `/residents/updateQuick/${residentId}`,
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
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
