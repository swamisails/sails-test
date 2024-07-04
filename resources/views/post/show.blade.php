@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center pt-4">
        <div class="col-md-8">
            <h2 class="title">{{$post->title}}</h2>
            <img src="{{url('images/logo.png')}}" alt="">
            <div class="d-flex justify-content-between pt-4">
                <div>Posted By: {{$post->postedby->name}}</div>
                <div>Published On: {{date('d M, y', strtotime($post->created_at))}} </div>
            </div>
            <div class="pt-2">
                <p>{{$post->description}}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Category</div>
                <div class="card-body">
                    <ul>
                        @foreach ($categoryList as $key => $category)
                        <li class="p-2"><a href="{{url('category/'.$category->id)}}" class="text-decoration-none">{{$category->category}}</a></li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row pt-5">
        <div>
            <h4><i>Comments</i></h4>
        </div>
        <div class="col-md-7">
            @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
            <form action="{{route('comment.store')}}" method="post">
                @csrf
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Comment</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="inputEmail3" name="comment" placeholder="Post your comment here" rows="4"></textarea>
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        @if($errors->has('comment'))
                        <div class="text-danger">{{ $errors->first('comment') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </div>
            </form>

            <ul class="pt-5">
                @foreach ($commentList as $key => $comment)
                <li class="list-style-type-none">{{$comment->comment}}
                    <div class="d-flex justify-content-between pt-4">
                        <div><i class="fa fa-user"></i> {{$comment->commentedby->name}}</div>
                        <div><i class="fa fa-calendar"></i> {{date('d M, y', strtotime($comment->created_at))}}</div>
                    </div>
                </li>
                <hr>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection