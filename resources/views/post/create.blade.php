@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div><i class="fa fa-plus"></i> New Post</div>
                        <div><a href="{{route('post.index')}}"><i class="fa fa-left-arrow"></i>Back</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                                @if($errors->has('title'))
                                <div class="text-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="category" class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9">
                                <select name="category" id="category" class="form-control">
                                    @foreach ($category as $key => $cat)
                                    <option value="{{$cat->id}}">{{$cat->category}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('category'))
                                <div class="text-danger">{{ $errors->first('category') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="thumbnail" class="col-sm-3 col-form-label">Thumbnail</label>
                            <div class="col-sm-9">
                                <input type="file" name="thumbnail" id="thumbnail" class="form-control" accept="image/*">
                                @if($errors->has('thumbnail'))
                                <div class="text-danger">{{ $errors->first('thumbnail') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row pt-2">
                            <label for="small_description" class="col-sm-3 col-form-label">Small Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="small_description" name="small_description"  placeholder="Small Description" rows="3" value="{{ old('small_description') }}">{{ old('small_description') }}</textarea>
                                @if($errors->has('small_description'))
                                <div class="text-danger">{{ $errors->first('small_description') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row pt-2">
                            <label for="description" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="description" name="description" placeholder="Description" rows="5"></textarea>
                                @if($errors->has('description'))
                                <div class="text-danger">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row pt-2">
                            <label for="inputEmail3" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection