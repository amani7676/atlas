<div class="text-center offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="modalDesc" aria-labelledby="staticBackdropLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="full_name_desc"></h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div>
      <form action="{{route('resident.addDesc')}}" method="post">
        @csrf
        <input type="hidden" name="id_resident_modal_desc" id="id_resident_modal_desc" value="">
        <div class="form-group">
          <label for="text_desc" class="mb-2">اضافه کردن توضیحات</label>
          <input type="text" name="text_desc_modal_desc" id="text_desc" class="form-control">
        </div>
        <div class="form-group">
          <label for="option_desc" class="mb-2">نوع توضیحات</label>
          <select name="select_desc_modal_desc" id="" class="form-control">
            <option value="sarrsed">سررسید</option>
            <option value="bedhey">بدهی</option>
            <option value="khoroj">خروج</option>
            <option value="other">سایر</option>
          </select>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success mt-3">اضافه کن</button>
        </div>
      </form>
    </div>
    <div class="show_list_desc mt-3">
       
    </div>
  </div>
</div>