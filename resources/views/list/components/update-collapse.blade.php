<div class="offcanvas offcanvas-end " data-bs-backdrop="static" tabindex="-1" id="staticBackdrop"
    aria-labelledby="staticBackdropLabel" style="width: 36%">
    <div class="offcanvas-header ">
        <h4 id="full_name-collapse"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body text-center">
        <form action="{{ route('resident.update') }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="">
            <div class="container mb-5">
                <div class="d-flex flex-column gap-4">
                    <div class="card">
                        <div class="card-header header_collapse">اتاق، تخت</div>
                        <div class="card-body">
                            <div class="row m-2">
                                <div class="col">
                                    <label for="">شماره اتاق</label>
                                    <input type="text" name="otagh_name_collapse" class="form-control"
                                        id="otagh_name_collapse">
                                </div>
                                <div class="col">
                                    <label for="">َشماره تخت</label>
                                    <input type="text" name="takht_name_collapse" class="form-control"
                                        id="takht_name_collapse">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card ">
                        <div class="card-header header_collapse">شغل، سن، مدرک، فرم</div>
                        <div class="card-body">
                            <div class="row m-2">
                                <div class="col-2" style="width: 34%">
                                    <label for="job_collapse" class="form-label">شغل</label>
                                    <select name="job_collapse" id="job_collapse" class="form-control">
                                        <option value="">شغل را انتخاب کنید!</option>
                                        <option value="daneshjo_azad">دانشجو-ازاد</option>
                                        <option value="karmand_dolat">دانشجو-دولتی</option>
                                        <option value="danshjo_sair">دانشجو-سایر</option>
                                        <option value="danshjo_dolati">کارمند-دولتی</option>
                                        <option value="karmand_shkhse">کارمند-شخصی</option>
                                        <option value="sair">سایر</option>
                                    </select>

                                </div>
                                <div class="col-2">
                                    <label for="">سن</label>
                                    <input type="text" name="age_collapse" class="form-control" id="age_collapse">
                                </div>
                                <div class="col">
                                    <label for="madrak_collapse">مدرک</label>
                                    <input class="form-check-input" name="madrak_collapse" type="checkbox"
                                        id="madrak_collapse">
                                </div>
                                <div class="col">
                                    <label for="form_collapse">فرم</label>
                                    <input class="form-check-input" name="form_collapse" type="checkbox"
                                        id="form_collapse">
                                </div>
                                <div class="col">
                                    <label for="vadeh_collapse">ودیعه</label>
                                    <input class="form-check-input" name="vadeh_collapse" type="checkbox"
                                        id="vadeh_collapse">
                                </div>
                                <div class="col">
                                    <label for="ajareh_collapse">اجاره</label>
                                    <input class="form-check-input" name="ajareh_collapse" type="checkbox"
                                        id="ajareh_collapse">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card ">
                        <div class="card-header header_collapse">وضعیت</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <select name="state_collapse" id="" class="form-control">
                                        <option value="active">فعال</option>
                                        <option value="leaving">در حال خروج</option>
                                        <option value="reserve">رزرو</option>
                                        <option value="nightly">شبانه</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>

            <!-- دکمه‌ها -->
            <div class="d-flex justify-content-between w-35 ">
                <button type="submit" class="btn btn-success p-3" id="update_collapse">ویرایش</button>
            </div>
        </form>

        <div class="card " >
            <div class="card-header header_collapse_delete " >حذف کاربر</div>
            <div class="card-body m-3">
                <a href="" class="btn btn-warning" id="etmamgharardad" data-resident-id="">اتمام قرارداد</a>
            </div>
            <div class="card-body m-3">
                <a class="btn btn-danger" id="delete_col_az_database" data-resident-id="">حذف </a>
            </div>
        </div>
    </div>
</div>
