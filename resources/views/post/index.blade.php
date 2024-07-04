@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div><i class="fa fa-list"></i> Post List</div>
                        <div><a href="{{route('post.create')}}"><i class="fa fa-plus"></i> New</a></div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Thumbnail</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($postList as $key =>$post)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>Category</td>
                                <td>{{$post->title}}</td>
                                <td>Description</td>
                                <td>Thumbnail</td>
                                <td>{{date('d M, Y', strtotime($post->created_at))}}</td>
                                <td>
                                    <a href=""><i class="fa fa-comment"></i></a>
                                    <a href=""><i class="fa fa-edit"></i></a>
                                    <a href=""><i class="fa fa-trash"></i></a>
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
@endsection