<div class="row">
    <div class="col-12">
         <div class="p-4 rounded">
            <form id="filter-form" wire:submit.prevent="ShowList">
                <div class="d-flex flex-row">
                    <!-- متن -->
                    <div class="p-2">
                        <label class="text-sm font-medium">نام کامل</label>
                        <input type="text" wire:model.lazy="full_name" class="mt-1 w-full border rounded px-2 py-1"
                            placeholder="جستجوی نام">
                    </div>

                    <div class="p-2">
                        <label class="text-sm font-medium">تلفن</label>
                        <input type="text" wire:model.lazy="phone" class="mt-1 w-full border rounded px-2 py-1"
                            placeholder="شماره تلفن">
                    </div>

                    <div class="p-2">
                        <label class="text-sm font-medium">اتاق</label>
                        <input type="text" wire:model.lazy="otagh" class="mt-1 w-full border rounded px-2 py-1"
                            placeholder="شماره اتاق">
                    </div>

                    <div class="p-2">
                        <label class="block text-sm font-medium">شروع قرارداد از</label>
                        <input type="text" wire:model.lazy="start_date"
                            class="mt-1 block w-full border rounded px-2 py-1">
                    </div>

                    <div class="p-2">
                        <label class="block text-sm font-medium">شروع قرارداد تا</label>
                        <input type="text" wire:model.lazy="start_date_ta"
                            class="mt-1 block w-full border rounded px-2 py-1">
                    </div>

                    <div class="p-2">
                        <label class="block text-sm font-medium">پایان قرارداد از</label>
                        <input type="text" wire:model.lazy="end_date"
                            class="mt-1 block w-full border rounded px-2 py-1">
                    </div>

                    <div class="p-2">
                        <label class="block text-sm font-medium">پایان قرارداد تا</label>
                        <input type="text" wire:model.lazy="end_date_ta"
                            class="mt-1 block w-full border rounded px-2 py-1">
                    </div>
                    <!-- عدد -->
                    <div class="p-2">
                        <label class="block text-sm font-medium">سن</label>
                        <input type="text" wire:model.lazy="age" class="mt-1 block w-full border rounded px-2 py-1"
                            placeholder="سن">
                    </div>

                    <!-- لیست کشویی -->
                    <div class="p-2">
                        <label class="block text-sm font-medium">شغل</label>
                        <select wire:model.lazy="job" class="mt-1 block w-full border rounded px-2 py-1">
                            <option value="">همه</option>
                            <option value="karmand_dolat">کارمند دولت</option>
                            <option value="karmand_shkhse">کارمند شخصی</option>
                            <option value="daneshjo_azad">دانشجوی آزاد</option>
                            <option value="danshjo_dolati">دانشجوی دولتی</option>
                            <option value="danshjo_sair">دانشجوی سایر</option>
                            <option value="sair">سایر</option>
                        </select>
                    </div>

                    <div class="p-2 mt-4">
                        <button type="submit" class="btn btn-info">پیدا کن</button>
                        <button type="button" wire:click="resetFilters" class="btn btn-danger mt-4">پاک کردن
                            فیلترها</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-11 text-center">
        <div id="resident-list" class="space-y-3 mt-4 container">

            @if ($residents->count())
                <table class=" table table-hover">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="">نام کامل</th>
                            <th class="">تلفن</th>
                            <th class="">اتاق</th>
                            <th class="">پایان قرارداد</th>
                            <th class="">َشروع قرارداد</th>
                            <th class="">سن</th>
                            <th class="">شغل</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($residents as $resident)
                            <tr>
                                <td class="">{{ $resident->full_name }}</td>
                                <td class="">{{ $resident->phone }}</td>
                                <td class="">{{ $resident->takht->otagh->name }}</td>
                                <td class="">{{ $resident->end_date }}</td>
                                <td class="">{{ $resident->start_date }}</td>
                                <td class="">{{ $resident->infoResident->age }}</td>
                                <td class="">{{ $resident->infoResident->job }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-4 text-gray-500">هیچ نتیجه‌ای یافت نشد</div>
            @endif
        </div>
    </div>

</div>
