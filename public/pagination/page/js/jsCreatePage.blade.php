<script>
    let pageCount=0;
    let subPageCount=0;
    let pageConentArr=[];
    let pageSubAcCount=1;
    function addPageContent(){
        $('#pageContentAddDiv').append(`
        <div class="card">
            <div class="card-header" id="headingOne${pageCount}">
                <h5 class="mb-0">
                    <button class="btn " data-toggle="collapse" data-target="#pageContent${pageCount}" aria-expanded="true" aria-controls="pageContent">
                Page Content Item ${pageCount +1}
                    </button>
                </h5>
            </div>
            <div id="pageContent${pageCount}" class="collapse show collapseAll" aria-labelledby="headingOne" data-parent="#pageContentAddDiv">
                <div class="card-body">
                    <div class="row border border-secondary p-2 my-1" id=pagecontentMainDiv${pageCount}>
                        <div class="col-md-12">
                            <a onclick="removePageSubContent()"
                                class=" btn btn-danger btn-sm float-right my-1"> <i class="fa-solid fa-minus text-white"></i></a>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label">Title<sup
                                    class="text-danger">*</sup></label>
                            <div class="">
                                <input type="text" class="form-control"
                                    name="pagecontent[${pageCount}][title]" id="title" required>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <label class="col-form-label">Icon Class</label>
                            <div class="">
                                <input type="text" name="pagecontent[${pageCount}][icon_class]"
                                    class="form-control"
                                    placeholder="Enter the icon class Eg: fa-book ">
                                <p class="">
                                    <strong> <a
                                            href="https://fontawesome.com/search?q=edit&o=r"
                                            target="_blank">Click here for Icon
                                            class sample</a></strong>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <label class="col-form-label">Description</label>
                            <div class="">
                                <textarea name="pagecontent[${pageCount}][description]"
                                    class=" form-control ckeditor" id="description${pageCount}"
                                    cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label">Image</label>
                            <div class="">
                                <small style="font-size:11px"><strong>[ Only
                                        accepts jpg, jpeg and png; file size
                                        less then 4MB ]</strong></small>
    
                                <input type="file" name="pagecontent[${pageCount}][img]"
                                    class="form-control">
                            </div>
                        </div>
                            <div class="col-md-12 my-1">
                                <a onclick="addPageSubContent(${pageCount})"
                                    class="btn btn-primary btn-sm float-right text-white">Add Page Sub Content</a>
                            </div>



                        <ul class="nav nav-tabs" id="pageContentdDivtab${pageCount}">
                               
                        </ul>
                            
                        <div class="tab-content" id="pageContenttabDetail${pageCount}" >
                          
                        </div>
                    </div> 
                </div>
          
            </div>
        </div>`);
        $('.collapseAll').removeClass('show');
        $('#pageContent'+pageCount).addClass('show');
        $('#pageDataList').show();
        $('#pageShowCollapse').removeClass('show');

        pageCount++;
        @include('backend.js.ckEditorInit');

    }
    
    function addPageSubContent(key){
        let res=pageConentArr.find(item => item.key === key);

        if(res!=undefined){
            pageSubAcCount++;
        }else{
            pageConentArr.push({key:key,count:pageSubAcCount});
            pageSubAcCount=1;
        }

        $('#pageContentdDivtab'+key).append(`
            <li class="activeLiTab${key} m-2 border p-2" id="activeLiTab${subPageCount}"><a id="subPageContentATag${subPageCount}" class=" removeColor subPageContentATag${key}" data-toggle="tab"  onclick="pagesubcontentClick(${subPageCount},${key})" href="#pagesubcontentNew${subPageCount}">Page Sub Content Item ${pageSubAcCount}</a></li>
        `);
        $('#pageContenttabDetail'+key).append(`
        <div id="pagesubcontentNew${subPageCount}" class="tab-pane fade in subPageContentShowNow${key} ">
            <div class="row border border-dark rounded m-2  ml-5 my-3 py-2">
                <div class="col-md-12">
                    <a onclick="removePageSubContentTab(${subPageCount},${key})" class="btn btn-danger btn-sm float-right my-1"> <i class="fa-solid fa-minus text-white"></i></a>
                </div>
                <div class="col-md-6">
                    <label class="col-form-label">Title <sup
                            style="color:red">*</sup></label>
                    <div class="">
                        <input type="text" class="form-control"
                            name="pagesubcontent[${subPageCount}][title]" id="title"
                            required>
                    </div>
                </div>
                <input type="hidden" name="pagecontent[${key}][subpagefieldId]" value="${key}">
                <input type="hidden" name="pagesubcontent[${subPageCount}][subpagefieldId]" value="${key}">
            
                <div class="col-md-6 ">
                    <label class="col-form-label">Icon Class</label>
                    <div class="">
                        <input type="text"
                            name="pagesubcontent[${subPageCount}][icon_class]"
                            class="form-control"
                            placeholder="Enter the icon class Eg: fa-book ">
                        <p class="">
                            <strong> <a
                                    href="https://fontawesome.com/search?q=edit&o=r"
                                    target="_blank">Click here for Icon
                                    class sample</a></strong>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 ">
                    <label class="col-form-label">Description</label>
                    <div class="">
                        <textarea name="pagesubcontent[${subPageCount}][description]"
                            class="ckeditor form-control"
                            id="description${key}${subPageCount}" cols="30"
                            col-md-10s="10"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="col-form-label">Image</label>
                    <div class="">
                        <small style="font-size:11px"><strong>[ Only
                                accepts jpg, jpeg
                                and png; file size less then 4MB
                                ]</strong></small>
                        <input type="file" name="pagesubcontent[${subPageCount}][img][]"
                            class="form-control" multiple>
                    </div>
                </div>
            </div> 
        </div>
        `);
      
        $('.subPageContentShowNow'+key).removeClass('active');
        $('.activeLiTab'+key).removeClass('active');
        $('#pagesubcontentNew'+subPageCount).addClass('active');
        $('#activeLiTab'+subPageCount).addClass('active');
        $('#subPageContentATag'+subPageCount).click();
        $('.subPageContentATag'+key).removeClass('liTabNav');
        $('#subPageContentATag'+subPageCount).addClass('liTabNav');
        subPageCount++;
       
        @include('backend.js.ckEditorInit');
    }
    function removePageSubContent(){
        let btn=event.target.parentElement.parentElement.parentElement.parentElement.parentElement;
        btn.remove();
    }
    function removePageSubContentTab(subId ,key){
        let btn=event.target.parentElement.parentElement.parentElement;
        btn.remove();
        $('#activeLiTab'+subId).remove();
    }

    function pagesubcontentClick(subtabId,key){
        $('.subPageContentATag'+key).removeClass('liTabNav');
        $('#subPageContentATag'+subtabId).addClass('liTabNav');
        $('.subPageContentShowNow'+key).removeClass('active');
        $('#pagesubcontentNew'+subtabId).addClass('active');
    }
    
    
    
    
    window.addEventListener('load', function() {
        $('a[id^="cancel_slug"]').hide();
        $('a[id^="save_slug"]').hide();
    });


    function pageSubcontentClick() { 
        event.preventDefault();
        let btn = event.target;
       let activeElement = btn.parentElement;
       let parentDiv = activeElement.parentElement;
       parentDiv.appendChild(activeElement);


     }
    
    function validationPageForm() {
        let allField = $('#page_store_form').find('input,select');
        let error = 0;
        let file_err=0;
    
        let validateExt = ['jpg', 'png', 'jpeg'];
    
        $.each(allField, function(indexInArray, element) {
            $(element).removeClass('border border-danger');
            let nextEl = $(element).next();
            if ($(nextEl).prop('tagName') == "SMALL") {
                $(nextEl).remove();
            }
    
            let name = element.name;
            let type = element.type;
            let val = element.value;
    
            if ((type == "text" && name.includes('title'))) {
                if (val == "" || val == null || val == undefined) {
                    $(element).addClass('border border-danger');
                    $(`<small class='text-danger' >This field is required</small>`).insertAfter($(element));
    
                    error++;
                }
            }
            if (type == "select-one" && name == "slug") {
                if (val == "" || val == null || val == undefined) {
                    $(element).addClass('border border-danger');
                    $(`<small class='text-danger' >This field is required</small>`).insertAfter($(element));
    
                    error++;
                }
            }
    
    
            if (type == "file" && element.files.length > 0 ) {
                for (let i = 0; i < element.files.length; i++) {
                    let file = element.files[i];
                let file_ext=file.name.split('.').pop().toLowerCase();
                let file_size=file.size;
                if(file_size>4*1024*1024 || !validateExt.includes(file_ext)){
                    error++;
                    file_err++;
                }
            }
            if(file_err!=0){
                $(`<small class="text-danger" style="font-size:11px"><strong>[ Only accepts jpg,jpeg and png; file size less then 4MB ]</strong></small>`).insertAfter($(element));
    
            }
    
            }
        });
        if (error == 0) {
            $('#page_store_form').submit();
        }
    }
    
    // slug 
    function submitnow() {
        let form = document.getElementById('addslug');
        let display_name = document.getElementById('display_names');
        let code = document.getElementById('code');
    
    
        let validResp = slugValid([display_name, code]);
    
        if (validResp == true) {
            form.submit();
        }
    
    }
    
    function slugValid(data) {
        let err = 0;
        data.forEach(element => {
            if (element.value == '') {
                element.style.border = '1px solid red';
                element.nextElementSibling.innerHTML = `This field is required`;
                err++;
            } else {
                element.style.border = '1px solid #cacaca';
                element.nextElementSibling.innerHTML = ``;
            }
        });
        if (err == 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function enableinput(key, id) {
        $('#display_name' + key + id).attr('disabled', false);
        $('#code' + key + id).attr('disabled', true);
        $('#edit_slug' + key + id).hide();
        $('#save_slug' + key + id).show();
        $('#cancel_slug' + key + id).show();
    
    }
    
    function cancelClick(key, id) {
        $('#display_name' + key + id).attr('disabled', true);
        $('#code' + key + id).attr('disabled', true);
        $('#edit_slug' + key + id).show();
        $('#save_slug' + key + id).hide();
        $('#cancel_slug' + key + id).hide();
    }
    
    function ajaxSlugDelete(key, id) {
    
        $.ajax({
            type: "GET",
            url: "{{ route('slug.ajaxDelete') }}",
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
    
            success: function(response) {
                $.notify(response.message, 'success');
                $('#deleterow' + key + id).remove();
                window.location.reload();
    
            },
            error: function(error) {
                $.notify('Oops! Something Went Wrong.', 'error');
            }
        });
    
    }
    
    function ajaxSlugStore(key, id, value, existcode) {
    
        let displayName = $('#display_name' + key + id).val();
        let originalname = displayName;
        let code = $('#code' + key + id).val();
        let originalcode = code;
        if (displayName != '' && code != '') {
    
            $.ajax({
    
                type: 'POST',
                url: "{{ route('slug.ajaxUpdate') }}",
                data: {
                    display_name: displayName,
                    code: code,
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        $.notify(response.message, 'success');
                        $('#display_name' + key + id).attr('disabled', true);
                        $('#code' + key + id).attr('disabled', true);
                        $('#edit_slug' + key + id).show();
                        $('#save_slug' + key + id).hide();
                        $('#cancel_slug' + key + id).hide();
    
                    } else {
                        $.notify(response.message, 'error');
                    }
                },
                error: function(error) {
                    $.notify('Oops! Something Went Wrong.', 'error');
                }
    
            });
        } else {
            if (displayName == '' && code == '') {
                $('#display_name' + key + id).val(value).attr('disabled', true);
                $('#code' + key + id).val(existcode).attr('disabled', true);
                $('#edit_slug' + key + id).show();
                $('#save_slug' + key + id).hide();
                $('#cancel_slug' + key + id).hide();
                $.notify('Name and Code field are required', 'error');
    
            } else if (displayName == '' && code != '') {
                $('#display_name' + key + id).val(value).attr('disabled', true);
                $('#code' + key + id).val(existcode).attr('disabled', true);
                $('#edit_slug' + key + id).show();
                $('#save_slug' + key + id).hide();
                $('#cancel_slug' + key + id).hide();
                $.notify('Name field is required', 'error');
    
            } else {
    
                $('#display_name' + key + id).val(value).attr('disabled', true);
                $('#code' + key + id).val(existcode).attr('disabled', true);
                $('#edit_slug' + key + id).show();
                $('#save_slug' + key + id).hide();
                $('#cancel_slug' + key + id).hide();
                $.notify('Code field is required', 'error');
            }
    
        }
    }


  
</script>