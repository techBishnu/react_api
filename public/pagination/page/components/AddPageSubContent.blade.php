<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title">Page Sub Content Add for {{ $pagecontent->title }}</h5>
    <button type="button" class="btn btn-danger btn-sm" aria-label="Close" data-dismiss="modal">
      <span aria-hidden="true">X</span>
    </button>
  </div>
  <div class="modal-body">
    <form action="{{ route('page_subcontent.store') }}" id="page_sub_content_store_form" method="POST"
      enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-md-12">
          <label class="col-form-label">Title <sup style="color:red">*</sup></label>
          <div class="">
            <input type="text" class="form-control" name="title" id="title" required>
          </div>
        </div>
        <div class="col-md-12 ">
          <label class="col-form-label">Description</label>
          <div class="">
            <textarea name="description" class="ckeditor form-control" id="descriptionsubPageAdd{{$pagecontent->id  }}" cols="30"
              col-md-12s="10"></textarea>
          </div>
        </div>
        <div class="col-md-12 ">
          <label class="col-form-label">Icon Class</label>
          <div class="">
            <input type="text" name="icon_class" class="form-control" placeholder="Enter the icon class Eg: fa-book ">
            <p class="">
              <strong> <a href="https://fontawesome.com/search?q=edit&o=r" target="_blank">Click here for Icon
                  class sample</a></strong>
            </p>
          </div>
        </div>
        <div class="col-md-12">
          <input type="hidden" name="page_content_id" value="{{ $pagecontent->id }}">
          <label class="col-form-label">Page Content <sup style="color:red">*</sup></label>
          <div class="">
            <select name="page_content_id" class="form-control" disabled>
              <option value="{{ $pagecontent->id }}">{{ $pagecontent->title }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-12">
          <label class="col-form-label">Image</label>
          <div class="">
            <small style="font-size:11px"><strong>[ Only accepts jpg, jpeg
                and png; file size less then 4MB ]</strong></small>
            <input type="file" name="img[]" class="form-control" multiple>
          </div>
        </div>
      </div>
      <div class="col-md-12 mt-2">
        <a onclick="validationSubContentPageForm({{ $pagecontent->id }})" class="btn btn-primary float-right text-white">Submit</a>
      </div>
    </form>
  </div>
</div>