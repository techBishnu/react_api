<a  class="btn btn-primary text-white my-1" data-toggle="modal" data-target="#commonModal"
onclick="loadModal('{{ route('page.AddPageSubContent', $pagecontent['id']) }}')" >Page Sub Content Add
</a>
@if ($new_page_sub_content==null && count($page_sub_contents)<1)
    <div class="row">
        <div class="col-md-12">
            <p>No Data Present Here</p>
        </div>    
    </div>
@endif
@if ($new_page_sub_content==null)
@if (count($page_sub_contents)>0)
    
@foreach ($page_sub_contents as $k=> $pagesubcontent)
<div class="row border border-secondary p-2 my-3 " id="page_sub_content{{ $pagesubcontent->id }}">
    <input type="text" name="pagesubcontent[{{ $k }}][id]" value="{{ $pagesubcontent->id }}" hidden>
    <div class="col-md-12">
        <a onclick="deleteFunction({{ $pagesubcontent->id }},'{{route('page.deleteSubPageContent',$pagesubcontent['id']) }}','page sub content','page_sub_content')" class="float-right btn"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
    </div>
    <div class="col-md-6 py-2">
        <div class="form-group">
            <label class="form-label">Title <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" name="pagesubcontent[{{ $k }}][title]" id="title"
                value="{{ $pagesubcontent->title }}" required>
        </div>
    </div>

    <div class="col-md-6 py-2">
        <div class="form-group">
            <label class="form-label">Icon Class</label>
            <input type="text" class="form-control" name="pagesubcontent[{{ $k }}][icon_class]" id="icon_class"
                value="{{ $pagesubcontent->icon_class }}">
            <p class="">
                <strong> <a href="https://fontawesome.com/search?q=edit&o=r" target="_blank">Click
                        here for Icon
                        class
                        sample</a></strong>
            </p>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="pagesubcontent[{{ $k }}][description]" class="form-control ckeditor" id="descriptionShowSubPage{{ $pagesubcontent->id }}" cols="30"
                rows="10">{{ $pagesubcontent->description }}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">Associated page</label>
            <select name="pagesubcontent[{{ $k }}][page_id]" class="form-control" required>
                @foreach ($pagecontent_all as $pagesub)
                <option value="{{ $pagesub['id'] }}" {{ $pagesub['id']==$pagesubcontent->page_content_id ?
                    'selected' : '' }}>
                    {{ $pagesub['title'] }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">Image </label>
            <small style="font-size:11px"><strong>[
                    Only accepts jpg, jpeg
                    and png; file size less
                    then 4MB
                    ]</strong></small>

            <input type="file" name="pagesubcontent[{{ $k }}][image][]" class="form-control" multiple>

            @if ($pagesubcontent->hasMedia('about-img'))

            <div class="row mb-2">
                @foreach($pagesubcontent->getMedia('about-img') as
                $key=>
                $data)
                <div class="col-lg-2 mb-4 mt-2">
                    <i onclick="imageDelete('{{ $key }}','{{ $data->id }}','{{$pagesubcontent->id }}')"
                        class="fa fa-trash" id="trash-icon" aria-hidden="true" style="color:red"></i>
                    <img class="img-fluid" style="height:80px;object-fit:contain" width="100"
                        src="{{ $data->getFullUrl() }}" alt="" srcset="">

                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

@endforeach
@endif

@else
<input type="text" name="pagesubcontent[0][id]" value="{{ $new_page_sub_content->id }}" hidden>
<div class="row border border-secondary  p-2" id="page_sub_content{{ $new_page_sub_content->id }}">
    <div class="col-md-12">
        <a onclick="deleteFunction({{$new_page_sub_content->id}},'{{ route('page.deleteSubPageContent',$new_page_sub_content['id']) }}','page sub content','page_sub_content')" class="float-right btn"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">Title <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" name="pagesubcontent[0][title]" id="title"
                value="{{ $new_page_sub_content->title }}" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">Icon Class</label>
            <input type="text" class="form-control" name="pagesubcontent[0][icon_class]" id="icon_class"
                value="{{ $new_page_sub_content->icon_class }}">
            <p class="">
                <strong> <a href="https://fontawesome.com/search?q=edit&o=r" target="_blank">Click
                        here for Icon
                        class
                        sample</a></strong>
            </p>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="pagesubcontent[0][description]" class="form-control ckeditor" id="descriptionShowSubPage{{ $new_page_sub_content->id }}" cols="30"
                rows="10">{{ $new_page_sub_content->description }}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">Associated Page Content<sup class="text-danger">*</sup></label>
            <select name="pagesubcontent[0][page_id]" class="form-control" required>
                @foreach ($pagecontent_all as $pagesub)
                <option value="{{ $pagesub['id'] }}" {{ $pagesub['id']==$new_page_sub_content->page_content_id ?
                    'selected' : '' }}>
                    {{ $pagesub['title'] }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">Image </label>
            <small style="font-size:11px"><strong>[
                    Only accepts jpg, jpeg
                    and png; file size less
                    then 4MB
                    ]</strong></small>

            <input type="file" name="pagesubcontent[0][image][]" class="form-control" multiple>

            @if ($new_page_sub_content->hasMedia('about-img'))

            <div class="row mb-2">
                @foreach($new_page_sub_content->getMedia('about-img') as
                $key=>
                $data)
                <div class="col-lg-2 mb-4 mt-2">
                    <i onclick="imageDelete('{{ $key }}','{{ $data->id }}','{{$new_page_sub_content->id }}')"
                        class="fa fa-trash" id="trash-icon" aria-hidden="true" style="color:red"></i>
                    <img class="img-fluid" style="height:80px;object-fit:contain" width="100"
                        src="{{ $data->getFullUrl() }}" alt="" srcset="">

                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endif
