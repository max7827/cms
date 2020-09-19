@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-header">
        <div class="p ">{{isset($post) ? 'Edit Post' : 'Add post'}}</div>
    </div>

    <div class="card-body">
        <form action="{{isset($post) ? route('post.update', $post->id) : route('post.store')}}" method="POST" enctype="multipart/form-data">

            @csrf
            @if(isset($post))
            @method('Patch')
            @endif
            <div class="form-group">
                <label for=""> enter title</label>
                <input type="text" name="title" value="{{isset($post)? $post->title :''}}" class="form-control">
                @error('title')
                <div class="alert alert-danger mt-1"> {{$message}}</div>
                @enderror

                @if(session()->has('error'))
                <div class="alert alert-danger mt-1">{{session()->get('error')}}</div>
                @endif
            </div>

            <div class="form-group">
                <label for=""> upoad image</label>

                <input type="file" name="image" value="{{isset($post)? $post->image :''}}" class="form-control">
                @error('image')
                <div class="alert alert-danger"> {{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for=""> Published At</label>
                <input type="text" name="published_at" id="published_at" placeholder="select date" value="{{isset($post)? $post->published_at :''}}" class="form-control">
                @error('published_at')
                <div class="alert alert-danger"> {{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content"> enter content</label>
                <textarea name="content" class="ckeditor">{{isset($post)? $post->content :''}}</textarea>
                @error('content')
                <div class="alert alert-danger"> {{$message}}</div>
                @enderror
            </div>
            <div class="form-group">

                <label for="category">category </label>
                <select class="form-control" name="category_id">

                    @foreach($category as $cat)
                    <option value="{{$cat->id}}" {{isset($post->category->id) ? 'selected' :''}}> {{$cat->name}} </option>
                    @endforeach
                </select>

            </div>
            @if($tag->count()>0)
            <div class="form-group">

                <label for="tag">tag </label>
                <select class="form-control tags-select" name="tag[]" multiple>

                    @foreach($tag as $res)
                    <option value="{{$res->id}}" @if(isset($post)) @if($post->hasTag($res->id))
                        selected
                        @endif
                        @endif
                        > {{$res->name}} </option>
                    @endforeach
                </select>

            </div>
            @endif

            <div class="form-group">

                <button type="submit" class="btn btn-primary">submit</button>
            </div>

        </form>






    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#published_at", {
        enableTime: true,
        // dateFormat: "Y-m-d H:i",
        altInput: true,
        altFormat: "F j, Y , H:i",

    })


    $(".tags-select").select2({

    });
</script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection