@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="p ">{{isset($category) ? 'Edit Category' : 'Add category'}}</div>
    </div>

    <div class="card-body">

        <form action="{{isset($category) ? route('category.update', $category->id) : route('category.store')}}" method="post">

            @csrf
            @if(isset($category))
            @method('Patch')
            @endif

            <div class="form-group">
                @if(session()->has('msg'))
                <div class="alert alert-success">{{session()->get('msg')}}</div>
                @endif
                <label for="title">Enter Category name</label>
                <input class="form-control" type="text" value=" {{isset($category) ? $category->name : ''}}" name="name"></input>
                @if($errors->any())
                <div class="alert alert-danger mt-1">{{ $errors->first('name')}}</div>
                @endif
            </div>

            <div class="form-group">
                <button class="btn btn-primary my-2" type="submit">submit</button>
            </div>

        </form>



    </div>
</div>

@endsection