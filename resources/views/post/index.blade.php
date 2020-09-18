@extends('layouts.app')

@section('content')









@if(session()->has('msg'))
<div class="alert alert-success">{{session()->get('msg')}}</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger">{{session()->get('error')}}</div>
@endif

<div class="card">

    <div class="card-header">{{isset($posts) ? 'Posts' : 'Trashed Posts'}}</div>

    @if($posts->count()>0)
    <div class="card-body pl-2">



        <table class="table">
            <tr>

                <th>
                    Sr.
                </th>
                <th>Title</th>
                <th>
                    image
                </th>
                <th>Category</th>
                <th>
                    @foreach($posts as $post)
                    @endforeach

                    @if(!$post->trashed())

                    edit
                    @endif

                </th>
                <th>
                    delete
                </th>

            </tr>
            @foreach($posts as $post)
            <tr>
                <td>{{$loop->iteration}} </td>

                <td><img src="storage/{{$post->image}}" width="40" class="img-thumbnail"></td>
                <td>{{$post->title}}</td>
                <td><a href="{{route('category.edit',$post->category->id)}}">{{$post->category->name}}</a></td>
                <td>
                    @if(!$post->trashed())
                    <a href="{{route('post.edit',$post->id)}}" class="btn btn-info btn-sm text-light">Edit</a>
                    @endif
                </td>


                <td><button onclick="handleDelete({{$post->id}})" class="btn btn-sm btn-danger  ">{{$post->trashed() ?'delete' : 'Trash'}}</button></td>


                <form action="" method="POST" id="deleteform">
                    @csrf
                    @method('DELETE')


                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">delete tag</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @if(!$post->trashed())
                                    Are you sure you want to trash it
                                    @else
                                    Are you sure you want to peranently delete it
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">go back</button>
                                    <button type="submit" class="btn btn-primary">delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </tr>
            @endforeach
        </table>

    </div>
    @else
    <div class="card-body">

        <h3>No posts found</h3>
    </div>
    @endif



</div>
@endsection

@section('scripts')

<script>
    function handleDelete(id) {

        var form = document.getElementById('deleteform')
        form.action = '/post/' + id
        console.log(form)
        $('#deleteModal').modal('show')
    }
</script>

@endsection