@extends('layouts.app')

@section('content')

<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#model">open form</button>

<div class="modal fade" id="model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    @csrf
                    <div class="form-group">
                        <label for=""> enter title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for=""> enter content</label>
                        <input type="text" name="content" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for=""> upoad image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group">

                        <label for="category">category </label>
                        <select class="form-control" name="category">

                        </select>

                    </div>


                    <button type="submit" class="btn btn-primary">submit</button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


@endsection