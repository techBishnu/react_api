@extends('backend.layouts.app')
@section('seo')
<title>Edit - Page {{ $page->title }}</title>
@endsection
@section('content')
<style>
    .disable-aTag {
        pointer-events: none;
    }
</style>
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-md-8">
            <div class="page-header-title">
                <h5 class="m-b-10">Page Configuration</h5>
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
                        <div class="page-body" id="page_all_dataGet{{ $page->id }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Edit Page</h5>
                                            <a href="{{ route('page.index') }}" class="btn btn-primary float-right btn-sm">Back</a>
                                        </div>
                                        <div class="card-block">
                                            <form action="{{ route('page.update') }}" method="POST" enctype="multipart/form-data"
                                                id="update_page_form{{ $page->id }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body " id="update_page_div{{ $page->id }}">
                                                    <div class="row">
                                                        <div class="col-md-12">
                            
                                                            <div class="card-block">
                                                                <input type="text" name="id" required value="{{ $page->id }}" hidden>
                            
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label">Title
                                                                        <sup class="text-danger">*</sup></label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" name="title" id="title"
                                                                            data-name="title" required value="{{ $page->title }}">
                                                                    </div>
                                                                </div>
                            
                                                                <div class="form-group row ">
                                                                    <label class="col-sm-3 col-form-label">Description
                                                                    </label>
                                                                    <div class="col-sm-9">
                                                                        <textarea name="description" class="form-control ckeditor" id="description"
                                                                            cols="30" rows="10">{{ $page->description }}</textarea>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="form-group row ">
                                                                    <label class="col-sm-3 col-form-label">Slug<sup class="text-danger">*</sup>
                                                                    </label>
                                                                    <div class="col-sm-9">
                                                                        <select name="slug" id="slug" class="form-control">
                                                                            @foreach ($slugs as $slug)
                                                                            <option value="{{ $slug->id }}" {{ $slug->id
                                                                                == $page->slug ? 'selected' : '' }}>
                                                                                {{ $slug->display_name }}
                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                            
                                                                    </div>
                            
                                                                </div>
                            
                            
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label">Image
                                                                    </label> <br>
                            
                                                                    <div class="col-sm-9">
                                                                        <small style="font-size:11px"><strong>[
                                                                                Only accepts jpg, jpeg
                                                                                and png; file size less
                                                                                then 4MB
                                                                                ]</strong></small>
                            
                                                                        <input type="file" name="img" class="form-control">
                            
                                                                        @if ($page->hasMedia('page_img'))
                                                                        <img src="{{ $page->getMedia('page_img')[0]->getFullUrl() }}" alt=""
                                                                            srcset="" height="150" width="150">
                                                                        @endif
                                                                    </div>
                                                                </div>
                            
                                                            </div>
                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row p-3 my-2 d-flex justify-content-end">
                                                    <div class="col-md-9">
                                                        <a class="btn btn-primary text-white" data-toggle="modal" data-target="#commonModal"
                                                            onclick="loadModal('{{ route('page.showModal', $page['id']) }}')">
                                                            Add Page Content
                                                        </a>
                                                    </div>
                            
                                                </div>
                                                @if (count($page->pagecontents)>0)
                            
                                                <div class="row p-3 mb-">
                                                    <div class="col-md-3"></div>
                                                    <div class="col-md-5">
                                                        <label for="">Select Page Content For Edit</label>
                                                        <select name="page_content_id" id="page_content_id" class="form-control"
                                                            onchange="PageContentOption({{ $page->id }},'')">
                                                            <option value="{{ null }}">Choose Option</option>
                            
                                                            @foreach ($page->pagecontents as $key=>$pagecontent)
                                                            <option id="page_content_page_blade{{$pagecontent->id }}"
                                                                value="{{ $pagecontent->id }}">{{
                                                                $pagecontent->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" id="page_sub_content{{ $page->id }}" style="display: none;">
                            
                                                    </div>
                                                </div>
                                                <div class="row  ">
                                                    <div class="col-md-3"></div>
                                                    <div class="col-md-9 d-flex justify-content-start">
                                                        <ul class="nav nav-tabs nav-fill" role="tablist" id="tabListView{{ $page->id }}"
                                                            style="display:none;">
                                                            <li class="nav-item active" id="tabListView_content{{ $page->id }}">
                                                                <a class="nav-link role" data-toggle="tab" href="#page_content{{ $page->id }}"
                                                                    role="tab" aria-controls="page_content{{ $page->id }}"
                                                                    aria-selected="true"><button id="page_nav_tab_pagecontent{{ $page->id  }}"
                                                                        onclick="addColor()" type="button"
                                                                        class="btn btn btnactiveClass role_and_user"><i class="fa fa-exchange"
                                                                            aria-hidden="true"></i>
                                                                        Page Content</button></a>
                            
                                                            </li>
                                                            <li class="nav-item  " id="tabListView_content_sub{{ $page->id }}"
                                                                style="display: none;">
                                                                <a class="nav-link role " data-toggle="tab" href="#pagesub{{ $page->id }}"
                                                                    role="tab" aria-controls="chicken" aria-selected="false"><button
                                                                        onclick="addColor()" type="button" class="btn btn role_and_user"><i
                                                                            class="fa fa-exchange" aria-hidden="true"></i>
                                                                        Page Sub Content</button></a>
                                                            </li>
                            
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3"></div>
                                                    <div class="col-md-9 d-flex justify-content-start">
                                                        <div class="tab-content">
                            
                                                            <div class="tab-pane active py-3" id="page_content{{ $page->id }}" role="tabpanel"
                                                                aria-labelledby="page_content{{ $page->id }}-tab">
                            
                                                            </div>
                                                            <div class="tab-pane py-3" id="pagesub{{ $page->id }}" role="tabpanel"
                                                                aria-labelledby="chicken-tab">
                            
                                                            </div>
                            
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                <div class=" row ">
                                                    <div class="col-md-12">
                                                        <a onclick="validationUpdateForm({{ $page->id }})"
                                                            class="btn btn-primary text-white">Update</a>
                                                    </div>
                                                </div>
                            
                            
                                            </form>
                            
                            
                                        </div>
                                    </div>
                            
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div id="styleSelector">

                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.js.backendJs',['type'=>'page edit']);
@include('backend.js.ckEditor',['name'=>'description']);



@endsection
