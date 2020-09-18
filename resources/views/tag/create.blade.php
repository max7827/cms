@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="p ">{{isset($tag) ? 'Edit tag' : 'Add tag'}}</div>
    </div>

    <div class="card-body">

        <form action="{{isset($tag) ? route('tag.update', $tag->id) : route('tag.store')}}" method="post">

            @csrf
            @if(isset($tag))
            @method('Patch')
            @endif

            <div class="form-group">

                <label for="title">Enter tag name</label>
                <input class="form-control" type="text" value=" {{isset($tag) ? $tag->name : ''}}" name="name"></input>
                @if($errors->any())
                <div class="alert alert-danger mt-1">{{ $errors->first('name')}}</div>
                @endif


                <div class="form-group">
                    <button class="btn btn-primary my-2" type="submit">submit</button>
                </div>

                @if(session()->has('msg'))
                <div class="alert alert-success">{{session()->get('msg')}}</div>
                @endif
                @if(session()->has('error'))
                <div class="alert alert-danger">{{session()->get('error')}}</div>
                @endif
            </div>
        </form>



    </div>
</div>

@endsection