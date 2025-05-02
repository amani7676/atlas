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
                        if (response.data) {
                            const $row = $(`tr[data-resident-id="${residentId}"]`);
                            $row.find('input[name="full_name"]').val(response.data.full_name);
                            $row.find('input[name="phone"]').val(response.data.phone);
                            $row.find('input[name="end_date"]').val(response.data.end_date);
                            $row.find('td span#showSar').text(response.data.sarrsed);

                            const $badge = $row.find(
                                'td span#showSar') // یا انتخاب دقیق‌تر با توجه به ساختار HTML شما
                            // دریافت مقدار جدید sarrsed از response (فرض می‌کنیم در response.updatedData موجود است)
                            const newSarrsedValue = response.data.sarrsed;
                            // آپدیت کلاس و متن badge
                            $badge
                                .removeClass(function(index, className) {
                                    // حذف تمام کلاس‌های text-bg-*
                                    return (className.match(/\btext-bg-\S+/g) || []).join(
                                        ' ');
                                })
                                .addClass('text-bg-' + getSarrsedStatusClass(
                                    newSarrsedValue)) // اضافه کردن کلاس جدید
                                .text(newSarrsedValue); // آپدیت متن
                        }
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

        function getSarrsedStatusClass(sarrsedValue) {
            if (sarrsedValue < 0) {
                return 'danger';
            } else if (sarrsedValue <= 7) {
                return 'warning';
            } else {
                return 'success';
            }
        }
    </script>
@endpush
