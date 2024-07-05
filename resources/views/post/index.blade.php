@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div><i class="fa fa-list"></i> Post List</div>
                        <div><a href="{{route('post.create')}}" class="text-decoration-none"><i class="fa fa-plus"></i> New</a></div>
                    </div>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
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
                                <td><a href="{{url('category/'.$post->category_id)}}" class="text-decoration-none">{{$post->category->category}}</a></td>
                                <td><a href="{{route('post.show', $post->id)}}" class="text-decoration-none">{{$post->title}}</a></td>
                                <td>{{Str::of($post->small_description)->substr(0, 30)}}..</td>
                                <td><img src="{{url('images/'.$post->thumbnail)}}" alt="Post Thumbnail" width="80"></td>
                                <td>{{date('d M, Y', strtotime($post->created_at))}}</td>
                                <td>
                                    <a href="{{route('post.show', $post->id)}}"><i class="fa fa-comment"></i></a>
                                    <a href="{{route('post.edit', $post->id)}}"><i class="fa fa-edit"></i></a>
                                    <form action="{{route('post.destroy', $post->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="text-danger border-0 flex"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                    <div>{!! $postList->render('pagination::bootstrap-4') !!}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection