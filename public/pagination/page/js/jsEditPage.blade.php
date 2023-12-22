
<script>


// edit blade js 
let editPageBladeId="{{ $page['id'] }}";
// window.addEventListener('load',function(){
//     editBladePageData(editPageBladeId);
// });

function editBladePageData(editPageBladeId){
    let url = `{{ route('page.pageBladeGet', ':id') }}`;
    url = url.replace(':id', editPageBladeId);
    $.ajax({
        type: "get",
        url:url,
        success: function (res) {
            if(res.response==true){
                $('#page_all_dataGet'+editPageBladeId).html(res.page);
            }else{
                console.log(res.message);
            }
        }
    });

   
       
}
    
function PageContentOption(pageId,pagecontentId){
    
    if(pagecontentId==null ||  pagecontentId=="" ){
        pagecontentId=event.target.value;
    }
    if(pagecontentId!=null && pagecontentId!="" && pagecontentId!=undefined){
        $.ajax({
            type: "get",
            url: "{{ route('page.pageContentGet') }}",
            data: {
                pageId:pageId,
                pagecontentId:pagecontentId,
            },
            success: function (res) {
                if(res.response==true){
                    $('#page_content'+pageId).html(res.page_content);
                    $('#tabListView'+pageId).show();
                    if(res.pagesubcontent!=null ){

                        $('#page_sub_content'+pageId).show();
                        $('#page_sub_content'+pageId).html(res.page_contents);
                        $('#pagesub'+pageId).html(res.subPage);
                        $('#tabListView_content_sub'+pageId).show();
                    }else{
                        $('#page_sub_content'+pageId).hide();
                        $('#pagesub'+pageId).html('');
                        $('#tabListView_content_sub'+pageId).hide();
                        $('#page_nav_tab_pagecontent'+pageId).click();
                        $('#page_nav_tab_pagecontent'+pageId).addClass('btnactiveClass');

                    }
                }
                @include('backend.js.ckEditorInit');

            }
        });
    }else{

        $('#page_content'+pageId).html('');
        $('#page_sub_content'+pageId).hide();
        $('#tabListView'+pageId).hide();
        $('#pagesub'+pageId).html('');
    }
   
    
}
function PageSubContentOption(pageId,pageContentId){
    let pagsubId=event.target.value;
    if(pagsubId!=null && pagsubId!="" && pagsubId!=undefined){
        $.ajax({
            type: "get",
            url: "{{ route('page.pageSubContentGet') }}",
            data: {
                pagsubId:pagsubId,
                pageContentId:pageContentId,
            },
            success: function (res) {
                if(res.response==true){
                    $('#pagesub'+pageId).html(res.page);
                    @include('backend.js.ckEditorInit');

                }
            }
        });
    }else{
        $.ajax({
            type: "get",
            url: "{{ route('page.pageSubContentGet') }}",
            data: {
                pagsubId:null,
                pageContentId:pageContentId,
            },
            success: function (res) {
                    if(res.response==true){
                    $('#pagesub'+pageId).html(res.page);
                    @include('backend.js.ckEditorInit');

                }
            }
        });
    }
   
}
function addColor(){
    let element=event.target;
    $('.role_and_user').removeClass('btnactiveClass');
    $(element).toggleClass('btnactiveClass');
}

function validationContentPageForm(pageId){
    let a_tag=event.target;
    let allField=$('#page_content_new_add').find('input,select');
   
    let error=0;
    let validateExt=['jpg','png','jpeg'];
    
    $.each(allField, function (indexInArray, element) { 
        $(element).removeClass('border border-danger');
        let nextEl=$(element).next();
        if($(nextEl).prop('tagName')=="SMALL"){
            $(nextEl).remove();
        }

            let name=element.name;
            let type=element.type;
            let val=element.value;

            if((type=="text" && name=="title")||(type=="select-one" && name=="page_id")){
                if(val=="" || val==null || val==undefined){
                    $(element).addClass('border border-danger');
                    $(`<small class='text-danger' >This field is required</small>`).insertAfter($(element));

                    error++;
                }
            }
            if(type=="file" && element.files.length>0){
                let file=element.files[0];
                let file_ext=file.name.split('.').pop().toLowerCase();
                let file_size=file.size;
                if(file_size>4*1024*1024 || !validateExt.includes(file_ext)){
                    $(`<small class="text-danger" style="font-size:11px"><strong>[ Only accepts jpg,jpeg and png; file size less then 4MB ]</strong></small>`).insertAfter($(element));
                    error++;
                }
            }
    });
    if(error==0){
        let form=document.getElementById('page_content_new_add');
        let formData = new FormData(form);
        let ckId='descriptionAddPage'+pageId;
        var editor = CKEDITOR.instances['descriptionAddPage'+pageId];
        let description =editor.getData();
        formData.append('description', description);
        a_tag.textContent = "Submitting...";
        $(a_tag).addClass('disable-aTag');
        $.ajax({
            type: "POST",
            url: "{{  route('page_content.storeAjax')  }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {

                $('#commonModal').modal('hide');
                $(a_tag).removeClass('disable-aTag');

                if(res.response==true){
                    PageContentOption(res.pageId,res.pageContent.id);
                    $('#page_content_id').append(` <option id="page_content_page_blade${res.pageContent.id}" value="${res.pageContent.id}">${res.pageContent.title}</option>`);
                    document.getElementById('page_content_id').value=res.pageContent.id;
                    Swal.fire({
                        title:'Added',
                        text: res.message,
                        icon: 'success',
                    });
                }else{
                    Swal.fire({
                        title:'Oops..',
                        text: res.message,
                        icon: 'error',
                    });
                }
            }
        });
    }
}
    
function validationSubContentPageForm(pageconId){
        let a_tag=event.target;
        let allField=$('#page_sub_content_store_form').find('input,select');
        
        let error=0;
        let file_err=0;

        let validateExt=['jpg','png','jpeg'];
        
        $.each(allField, function (indexInArray, element) { 
            $(element).removeClass('border border-danger');
            let nextEl=$(element).next();
            if($(nextEl).prop('tagName')=="SMALL"){
                $(nextEl).remove();
            }

                let name=element.name;
                let type=element.type;
                let val=element.value;

                if((type=="text" && name=="title")||(type=="select-one" && name=="page_content_id")){
                    if(val=="" || val==null || val==undefined){
                        $(element).addClass('border border-danger');
                        $(`<small class='text-danger' >This field is required</small>`).insertAfter($(element));

                        error++;
                    }
                }
                if(type=="file" && element.files.length>0 && name=="img[]"){
                    for (let i = 0; i < element.files.length; i++) {
                        const file = element.files[i];
                        
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
        if(error==0){
            
            let subform=document.getElementById('page_sub_content_store_form');
            let subformData = new FormData(subform);
            let ckId='descriptionsubPageAdd'+pageconId;
            var editor = CKEDITOR.instances['descriptionsubPageAdd'+pageconId];
            let description =editor.getData();
            subformData.append('description', description);
            a_tag.textContent = "Submitting...";
            $(a_tag).addClass('disable-aTag');
            $.ajax({
            type: "POST",
            url: "{{  route('page_subcontent.storeAjax')  }}",
            data: subformData,
            processData: false,
            contentType: false,
            success: function (res) {
                $('#commonModal').modal('hide');
                $(a_tag).removeClass('disable-aTag');
                if(res.response==true){
                    document.getElementById('page_content_id').value=res.pageContent;
                    PageContentOption(res.pageId,res.pageContent);
                    Swal.fire({
                        title:'Added',
                        text: res.message,
                        icon: 'success',
                    });
                }else{
                    Swal.fire({
                        title:'Oops..',
                        text: res.message,
                        icon: 'error',
                    });
                }
            }
        });
        }
    }
function validationUpdateForm(id) {
    let allField = $('#update_page_form' + id).find('input');
    let error = 0;
    let file_err = 0;
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

        if ((type == "text" && name.includes('title') )|| (type == "text" && name == "slug")) {
            if (val == "" || val == null || val == undefined) {
                $(element).addClass('border border-danger');
                $(`<small class='text-danger'>This field is required</small>`).insertAfter($(element));

                error++;
            }
        }
        if (type == "file" && element.files.length> 0 && name.includes('img') ) {
            for (let i = 0; i < element.files.length; i++) {
                let file= element.files[i];
                let file_ext=file.name.split('.').pop().toLowerCase();
                let file_size=file.size;
                if(file_size>4*1024*1024 || !validateExt.includes(file_ext)){
                    file_err++;
                    error++;
                }
            }
            if(file_err!=0){
                $(`<small class="text-danger" style="font-size:11px"><strong>[ Only accepts jpg,jpeg and png; file size less then 4MB]</strong></small>`).insertAfter($(element));
            }
        }
    });
    if (error == 0) {
        $('#update_page_form' + id).submit();
    }
}
function imageDelete(key, imageId,modelId) {
    let el = event.target;
    let url = "{{ route('page_subcontent.delete_img') }}";
    $.ajax({
        type: "get",
        url: url,
        data: {
            id: imageId,
            m_id: modelId
        },
        success: function(response) {
            if (response.status == true) {
                el.parentElement.remove();
                $.notify(response.message,'success');
                if (response.count == 0) {
                    location.reload();
                }
            }else{
                $.notify(response.message,'error');
            }
        }
    });
}
           
</script>