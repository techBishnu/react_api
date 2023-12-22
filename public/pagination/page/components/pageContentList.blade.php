<label for="">Select Sub Page Content  For Edit</label>
<select name="page_sub_content_id" id="page_sub_content_select" class="form-control"  onchange="PageSubContentOption({{ $pageId }},{{ $pagecontent->id }})">
    <option value="{{ null }}">All Sub Pages Of {{ $pagecontent->title }}</option>
    @foreach ($page_sub_contents as $item)
    <option id="page_sub_content_option{{ $item->id }}" value="{{ $item->id }}">{{ $item['title'] }}</option>
    @endforeach
</select>