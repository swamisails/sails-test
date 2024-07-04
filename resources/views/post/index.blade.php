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
                                <td>{{$post->category->category}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{Str::of($post->small_description)->substr(0, 30)}}..</td>
                                <td><img src="{{url('images/'.$post->thumbnail)}}" alt="Post Thumbnail" width="80"></td>
                                <td>{{date('d M, Y', strtotime($post->created_at))}}</td>
                                <td>
                                    <a href=""><i class="fa fa-comment"></i></a>
                                    <a href="{{route('post.edit', $post->id)}}"><i class="fa fa-edit"></i></a>
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