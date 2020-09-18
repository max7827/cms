@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-header">
        <div class="p ">{{isset($posts) ? 'Edit Post' : 'Add post'}}</div>
    </div>

    <div class="card-body">
        <form action="{{isset($posts) ? route('post.update', $posts->id) : route('post.store')}}" method="POST" enctype="multipart/form-data">

            @csrf
            @if(isset($posts))
            @method('Patch')
            @endif
            <div class="form-group">
                <label for=""> enter title</label>
                <input type="text" name="title" value="{{isset($posts)? $posts->title :''}}" class="form-control">
                @error('title')
                <div class="alert alert-danger"> {{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for=""> upoad image</label>

                <input type="file" name="image" value="{{isset($posts)? $posts->image :''}}" class="form-control">
                @error('image')
                <div class="alert alert-danger"> {{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for=""> Published At</label>
                <input type="text" name="published_at" id="published_at" placeholder="select date" value="{{isset($posts)? $posts->published_at :''}}" class="form-control">
                @error('published_at')
                <div class="alert alert-danger"> {{$message}}</div>
                @enderror
            </div>
            <div class="form-group">

                <label for="category">category </label>
                <select class="form-control" name="category_id">

                    @foreach($category as $cat)
                    <option value="{{$cat->id}}" {{isset($posts->category->id) ? 'selected' :''}}> {{$cat->name}} </option>
                    @endforeach
                </select>

            </div>

            <div class="form-group">
                <label for="content"> enter content</label>
                <textarea name="content" class="ckeditor">{{isset($posts)? $posts->content :''}}</textarea>
                @error('content')
                <div class="alert alert-danger"> {{$message}}</div>
                @enderror
            </div>


            <div class="form-group">

                <button type="submit" class="btn btn-primary">submit</button>
            </div>

        </form>






    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#published_at", {
        enableTime: true,
        // dateFormat: "Y-m-d H:i",
        altInput: true,
        altFormat: "F j, Y , H:i",

    })
</script>
@endsection