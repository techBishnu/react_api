@extends('backend.layouts.app')
@section('seo')
<title>Add Page</title>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-md-8">
            <div class="page-header-title">
                <h5 class="m-b-10">Page Configuration</h5>
            </div>
        </div>
    </div>
    <style>
        .removeColor:focus{
            color: white !important;
        }
        .liTabNav{
            background-color: #007bff;
            color: white;
            padding: 8px 6px;
        }
        
       
    </style>
   <div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div>

    <div class="row">
        <div class="col-md-12">
            <div class="pcoded-inner-content">
                <!-- Main-body start -->
                <div class="main-body">
                    <div class="page-wrapper">

                        <!-- Page body start -->
                        <div class="page-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Add Page</h5>

                                            <a href="{{ route('page.index') }}"
                                                class="btn btn-primary float-right btn-sm">Back</a>
                                        </div>
                                        <div class="card-block">
                                            <form action="{{ route('page.store') }}" id="page_store_form" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div id="page">
                                                    <div class="card">
                                                      <div class="card-header" id="pageDataList" style="display: none;">
                                                        <h5 class="mb-0">
                                                          <button  class="btn btn-link" data-toggle="collapse" data-target="#pageShowCollapse" aria-expanded="true" aria-controls="pageShowCollapse">
                                                           Page
                                                          </button>
                                                        </h5>
                                                      </div>
                                                  
                                                      <div id="pageShowCollapse" class="collapse show" aria-labelledby="pageDataList" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Title <sup
                                                                        class="text-danger">*</sup></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="title" id="title"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row ">
                                                                <label class="col-sm-2 col-form-label">Description</label>
                                                                <div class="col-sm-10">
                                                                    <textarea name="description" class="ckeditor form-control"
                                                                        id="description" cols="30" rows="10"></textarea>
                                                                </div>
            
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Slug <sup
                                                                        class="text-danger">*</sup></label>
                                                                <div class="col-sm-10">
                                                                    <select name="slug" id="slug" class="form-control">
                                                                        <option value="{{ null }}">Choose Option</option>
            
                                                                        @foreach ($slugs as $slug)
                                                                        <option value="{{ $slug->id }}">
                                                                            {{ $slug->display_name }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Image </label>
                                                                <div class="col-sm-10">
                                                                    <input type="file" name="img" class="form-control">
                                                                    <small style="font-size:11px"><strong>[ Only accepts jpg, jpeg
                                                                            and png; file size less then 4MB ]</strong></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                              
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <a onclick="addPageContent()"
                                                            class="btn btn-primary float-right text-white">Add Page
                                                            Content</a>
                                                    </div>
                                                </div>
                                                
                                                <br>
                                                {{-- <a data-toggle="modal" class="btn btn-primary text-white"
                                                    data-target="#addSlugModal">Create Slug</a> --}}
                                                <br>
                                                {{-- <div class="row"> --}}
                                                    {{-- <div class="col-md-2"></div>
                                                    <div class="col-md-10"> --}}
                                                        {{-- <div id="pagecontent_div">
                                                            
                                                        </div> --}}
                                                        <div id="pageContentAddDiv" >
                                                       </div> 
                                                    {{--  </div> --}}
                                                {{-- </div> --}}
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a onclick="validationPageForm()"
                                                            class="btn btn-primary text-white">Submit</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Page body end -->
                    </div>
                </div>
                <!-- Main-body end -->
                <div id="styleSelector">

                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal for slug --}}
@include('backend.slug.index');

{{-- end slug  --}}
@include('backend.js.backendJs',['type'=>'page create']);
@include('backend.js.ckEditor',['name'=>'description']);
@endsection