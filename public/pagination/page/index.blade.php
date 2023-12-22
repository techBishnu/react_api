@extends('backend.layouts.app')
@section('seo')
    <title>Page</title>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">Page List</h5>
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
                                        
                                            <a class="btn btn-primary float-right" href="{{ route('page.create') }}">Add
                                                Page</a>
                                    
                                        {{-- <button type="button" class="btn btn-primary">Add Page Content</button> --}}
                                    </div>
                                </div>

                                <div class="row mt-1" id="table-div">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <thead>
                                                <th>S.No</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Slug</th>
                                                <th>Image</th>
                                                <th>Actions</th>
                                            </thead>

                                            <tbody>
                                                @forelse ($pages as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $item->title }}</td>
                                                        <td>{!! Str::limit($item->description, 30, '...') !!}</td>
                                                        <td>
                                                            {{ $item->slugs != null ? $item->slugs->display_name : 'Not Added' }}
                                                        </td>
                                                        <td>
                                                            @if ($item->hasMedia('page_img'))
                                                                <img src="{{ $item->hasMedia('page_img') ? $item->getMedia('page_img')[0]->getFullUrl() : '' }}"
                                                                    alt="" srcset="" width="100">
                                                            @else
                                                                Not Added
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @can('Update|Page Setup')
                                                                <a class="text-primary"
                                                                    href="{{ route('page.edit', $item->id) }}"><i
                                                                        class="fa fa-pencil-square-o"
                                                                        aria-hidden="true"></i></a>
                                                            @endcan
                                                          
                                                            @can('Delete|Page Setup')
                                                                <a class="text-danger" data-toggle="modal"
                                                                    data-target="#deleteModal{{ $key }}"><i
                                                                        class="fa fa-trash" aria-hidden="true"></i></a>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                   
                                                    <div class="modal fade" id="deleteModal{{ $key }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="{{ route('page.delete', $item->id) }}"
                                                                    method="GET" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Delete
                                                                            Page </h5>
                                                                        <button type="button"
                                                                            class="btn btn-close btn-danger text-light"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close">X</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Are you sure about this ??</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Confirm</button>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Cancel</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <td colspan="7" class="text-center">NO DATA YET!!</td>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <div>
                                            {{ $pages->links() }}
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

@endsection
