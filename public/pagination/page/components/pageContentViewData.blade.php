@if ($pagecontent!=null)
@if (count($page_sub_contents)<1)
<a  class="btn btn-primary text-white" data-toggle="modal" data-target="#commonModal"
onclick="loadModal('{{ route('page.AddPageSubContent', $pagecontent['id']) }}')" >Add Page Sub Content
</a>
@endif
<div class="row  p-2 my-2" id="page_content_add_div{{ $pagecontent->id }}">
    <input type="text" name="pagecontent[id]" value="{{ $pagecontent->id }}" hidden>
    <div class="col-md-12">
        <a onclick="deleteFunction({{ $pagecontent->id }},'{{route('page.deletePageContent',$pagecontent['id']) }}','page content','page_content_add_div')" class="float-right btn"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
    </div>
   
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">Title <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" name="pagecontent[title]" id="title"
                value="{{ $pagecontent->title }}" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">Icon Class</label>
            <input type="text" class="form-control" name="pagecontent[icon_class]" id="icon_class"
                value="{{ $pagecontent->icon_class }}">
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
            <textarea name="pagecontent[description]" class="form-control ckeditor" id="descriptionShowPageContent{{ $pagecontent->id }}" cols="30"
               placeholder="{!!$pagecontent->description !!}"  rows="10">{!! $pagecontent->description !!}</textarea>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">Associated page<sup class="text-danger">*</sup></label>
            <select name="pagecontent[page_id]" class="form-control" required>
                @foreach ($pages as $page)
                <option value="{{ $page['id'] }}" {{ $page['id']==$pagecontent->page_id ?
                    'selected'
                    : '' }}>
                    {{ $page['title'] }}
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

            <input type="file" name="pagecontent[img]" class="form-control">

            @if ($pagecontent->hasMedia('about-img'))
            <br>
            <img src="{{ $pagecontent->getMedia('about-img')[0]->getFullUrl() }}" alt="" srcset="" height="110"
                width="150">
            @endif
        </div>
    </div>
</div>
@endif
