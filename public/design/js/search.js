$(document).ready(function () {

    let timeout;
    const $searchInput = $('#ajaxSearch');
    const $resultsDiv = $('#ajaxResults');

    // تابع تولید جدول
    function generateTable(residents) {
        
        let baseUrl = 'list';
        let html = `
            <table style="width:100%; border-collapse:collapse; " class="hover">
                <thead>
                    <tr style="background:#f8f9fa;">
                        <th style="padding:10px;">تخت</th>
                        <th style="padding:10px;">اتاق</th>
                        <th style="padding:10px;">نام</th>
                        <th style="padding:10px;">تلفن</th>
                        <th style="padding:10px;">لینک</th>
                    </tr>
                </thead>
                <tbody>`;
        if (!residents || residents.length === 0 ) {
            html += `
                        <tr>
                            <td colspan="5" style="padding:10px; text-align:center; color:red;">یافت نشد!</td>
                        </tr>`;
        } else {
            residents.forEach(resident => {
                let dynamicUrl = baseUrl + '#' + resident.otagh_name;
                html += `
                <tr>
                    <td style="padding:8px; border-bottom:1px solid #eee;">${resident.takht_name}</td>
                    <td style="padding:8px; border-bottom:1px solid #eee;">${resident.otagh_name}</td>
                    <td style="padding:8px; border-bottom:1px solid #eee;">${resident.full_name}</td>
                    <td style="padding:8px; border-bottom:1px solid #eee;">${resident.phone}</td>
                    <td style="padding:8px; border-bottom:1px solid #eee;">
                        <a href='${dynamicUrl}' class="text-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
  <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z"/>
</svg></a>
                    </td>
                </tr>`;
            });
        }
        html += `</tbody></table>`;
        return html;
    }

    // رویداد ورودی
    $searchInput.on('input', function (e) {

        clearTimeout(timeout);
        const searchTerm = $(this).val().trim();

        timeout = setTimeout(() => {
            if (searchTerm.length < 2) {
                $resultsDiv.hide();
                return;
            }

            $.ajax({
                url: '/search',
                method: 'GET',
                data: { search: searchTerm },
                success: function (residents) {
                  
                    if (residents.length > 0) {
                        $resultsDiv.html(generateTable(residents))
                            .show()
                            .position({
                                my: "left top",
                                at: "left bottom",
                                of: $searchInput
                            });
                    } else {
                        $resultsDiv.html(generateTable(residents))
                        .show()
                        .position({
                            my: "left top",
                            at: "left bottom",
                            of: $searchInput
                        });
                        // $resultsDiv.hide();
                    }
                },
                error: function () {
                    $resultsDiv.hide();
                }
            });
        }, 300);
    });

    // مخفی کردن نتایج هنگام کلیک خارج
    $(document).on('click', function (e) {
        if (!$searchInput.is(e.target) && !$resultsDiv.has(e.target).length) {
            $resultsDiv.hide();
        }
    });
});