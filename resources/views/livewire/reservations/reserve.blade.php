<div class="d-flex align-items-center flex-column row">
    <div class="m-5 col-1">

    </div>

    <div class="col-9 text-center">
        <div class="card">
            <h5 class="card-header">رزرو شده ها</h5>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">نام</th>
                            <th scope="col">تلفن</th>
                            <th scope="col">توضیحات</th>
                            <th scope="col"></th>
                            <th scope="col">الویت</th>
                            <th scope="col">حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- رکوردهای موجود از دیتابیس --}}
                        @foreach ($savedReservations as $index => $item)
                            <tr class="table table-hover">
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['phone'] }}</td>
                                <td colspan="2">{{ $item['description'] }}</td>
                                <td>
                                    <select wire:model.live="savedReservations.{{ $index }}.olaviat"  class="form-control">
                                        <option value="high" {{ $item['olaviat'] == 'high' ? 'selected' : '' }}>1 (بالا)</option>
                                        <option value="medium" {{ $item['olaviat'] == 'medium' ? 'selected' : '' }}>2 (متوسط)</option>
                                        <option value="low" {{ $item['olaviat'] == 'low' ? 'selected' : '' }}>3 (پایین)</option>
                                    </select>
                                   
                                </td>
                                <td>
                                    <button  
                                    class="" wire:click="deleteReservation({{ $item['id'] }})".
                                    onclick="return confirm('آیا مطمئن هستید که می‌خواهید این رزرو را حذف کنید؟')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                          </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    
                        {{-- سطرهای جدید (غیر ذخیره شده) --}}
                        @foreach ($rows as $index => $row)
                            <tr>
                                <th scope="row">{{ count($savedReservations) + $index + 1 }}</th>
                                <td>
                                    <input type="text" class="form-control" wire:model="rows.{{ $index }}.name">
                                </td><td>
                                    <input type="text" class="form-control" wire:model="rows.{{ $index }}.phone">
                                </td>
                                <td colspan="2">
                                    <textarea wire:model="rows.{{ $index }}.description" class="form-control"></textarea>
                                </td>
                                <td>
                                    <select class="form-control" wire:model="rows.{{ $index }}.ovlaviat">
                                        <option value="">الویت </option>
                                        <option value="1">1 (بالا)</option>
                                        <option value="2">2 (متوسط)</option>
                                        <option value="3">3 (پایین)</option>
                                    </select>
                                </td>
                                <td class="d-flex gap-2">
                                    <button wire:click="saveRow({{ $index }})" class="btn btn-primary btn-sm">ذخیره</button>
                                    <button wire:click="removeRow({{ $index }})" class="btn btn-danger btn-sm">حذف</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                <button wire:click="addRow" class="btn btn-success">
                افزودن سطر
            </button>
            </div>
        </div>
    </div>



</div>

