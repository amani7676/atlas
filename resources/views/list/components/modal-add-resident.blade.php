<!-- Modal -->
<div class="modal fade" id="addResidentTarget" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                    <span class="badge rounded-pill text-bg-primary" id="otagh_name_title_modal_add">اتاق</span>
                    <span class="badge rounded-pill text-bg-info" id="takht_name_title_modal_add">تخت</span>

                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="{{route('resident.addResident')}}" method="POST" id="for_add_resident">
                        <div class="form-group">
                            @csrf
                            <input type="hidden" name="takht_name_add">
                            <input type="hidden" name="otagh_name_add">
                        </div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="form-container">
                                            <!-- ردیف اول: نام و تلفن -->
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="name" class="form-label required-field">نام و نام
                                                        خانوادگی</label>
                                                    <input type="text" class="form-control" id="full_name_add" name="full_name_add"
                                                        placeholder="نام کامل را وارد کنید" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="phone" class="form-label required-field">تلفن</label>
                                                    <input type="tel" class="form-control" id="phone_add" name="phone_add"
                                                        placeholder="شماره تلفن را وارد کنید" >
                                                </div>
                                            </div>

                                            <!-- ردیف دوم: تاریخ سررسید و سن -->
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="end_date_add" class="form-label">تاریخ سررسید</label>
                                                    <input type="text" class="form-control" id="end_date_add" name="end_date_add" required placeholder="1404/1/1">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="state_add" class="form-label">وضعیت</label>
                                                    <select class="form-select" id="state_add" name="state_add" required>
                                                        <option selected disabled value="">انتخاب کنید...</option>
                                                        <option value="active">فعال</option>
                                                        <option value="reserve">رزرو</option>
                                                        <option value="leaving">خروج خواهد کرد</option>
                                                        <option value="exit">خروج</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <hr>
                                            <!-- ردیف سوم: شغل و وضعیت -->
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="job_add" class="form-label">شغل</label>
                                                    <input type="text" class="form-control" id="job_add" name="job_add"
                                                        placeholder="شغل را وارد کنید">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="age_add" class="form-label">سن</label>
                                                    <input type="number" class="form-control" id="age_add" name="age_add"
                                                        placeholder="سن را وارد کنید">
                                                </div>
                                            </div>
                                            <hr>
                                            <!-- چک باکس‌ها -->
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <label class="form-label"> قرارداد</label>
                                                    <div class="d-flex flex-wrap gap-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="ejareh_add" name="ejareh_add">
                                                            <label class="form-check-label"
                                                                for="ejareh_add">اجاره</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="vadeh_add" name="vadeh_add">
                                                            <label class="form-check-label"
                                                                for="vadeh_add">ودیعه</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">فرم-مدرک</label>
                                                    <div class="d-flex flex-wrap gap-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="form_add" name="form_add">
                                                            <label class="form-check-label" for="form_add">فرم</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="madrak_add" name="madrak_add">
                                                            <label class="form-check-label"
                                                                for="madrak_add">مدرک</label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <!-- توضیحات -->
                                            <div class="row mt-3">
                                                <div class=" col-7">
                                                    <label for="desc_text_add" class="form-label">توضیحات</label>
                                                    <input type="text" name="desc_text_add" id="desc_text_add"
                                                        class="form-control">
                                                </div>
                                                <div class=" col-4">
                                                    <label for="desc_type_add" class="form-label">نوع توضیح</label>
                                                    <select name="desc_type_add" id="desc_type_add" class="form-control">
                                                        <option value="sarrsed">سررسید</option>
                                                        <option value="khoroj">خروجی</option>
                                                        <option value="bedhey">بدهی</option>
                                                        <option value="other">سایر</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <hr class="hr-shadow">
                                            <!-- دکمه‌ها -->
                                            <div class="d-flex justify-content-between mt-4">
                                                <button type="reset" class="btn btn-outline-secondary">
                                                    <i class="bi bi-eraser"></i> پاک کردن
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-save"></i> ذخیره اطلاعات
                                                </button>
                                            </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
