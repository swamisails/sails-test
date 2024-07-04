@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row "> 
        @foreach ($postList as $key => $post)
        <div class="col-md-5 mb-3">
            <img src="{{url('images/logo.png')}}" alt="">
        </div>
        <div class="col-md-7 mb-3">
            <h3><a href="{{url('posts/'.$post->slug)}}" class="text-decoration-none">{{$post->title}}</a></h3>
            {{$post->small_description}}
            <div class="d-flex justify-content-between pt-4">
                <div>Posted By: {{$post->postedby->name}}</div>
                <div>Published On: {{date('d M, y', strtotime($post->created_at))}} </div>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
</div>
@endsection