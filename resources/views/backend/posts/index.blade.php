@extends('backend.app')

@section('title', 'posts')

@section('content')


<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Posts</h3>
                {{-- <p class="text-subtitle text-muted">Navbar will appear in top of the page.</p> --}}
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Posts</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="section">
            <div class="row" id="table-bordered">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h4 class="card-title">Posts</h4> --}}
                            <a class="float-end" href="{{route('posts.create')}}">
                                <button class="btn btn-success">Add Post</button>
                            </a>
                        </div>
                        <div class="card-content">
                            @component('backend.flash_message')
                            @endcomponent
                            <!-- table bordered -->
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data as $datum)
                                        <tr>
                                            <td>{{$datum->id}}</td>
                                            <td><a href="{{route('posts.edit',['id'=>$datum->id])}}">{{$datum->title}}</a></td>
                                            <td class="text-bold-500">{{$datum->category->name}}</td>
                                            <td>{{$datum->status_label}}</td>
                                            <td class="text-bold-500">{{date('d-m-Y',strtotime($datum->created_at))}}
                                            </td>
                                            <td>{{date('d-m-y',strtotime($datum->updated_at))}}</td>
                                            <td>
                                                <form onsubmit="return confirm('Are you sure want to delete?')"
                                                    action="{{route('posts.destroy',$datum->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</div>

@endsection
