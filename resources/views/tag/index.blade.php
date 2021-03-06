@extends('layouts.app')

@section('content')









@if(session()->has('msg'))
<div class="alert alert-success">{{session()->get('msg')}}</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger">{{session()->get('error')}}</div>
@endif


<div class="card">

    <div class="card-header">{{isset($tag) ? 'Tags' : 'Trashed Tags'}}</div>

    @if($tag->count()>0)
    <div class="card-body pl-2">



        <table class="table table-bordered ">
            <thead class="bg-dark text-light">


                <tr>

                    <th>
                        Sr.
                    </th>
                    <th>
                        tag
                    </th>
                    <th>
                        Post Count
                    </th>
                    @foreach($tag as $res)
                    @endforeach

                    @if(!$res->trashed())
                    <th>

                        edit
                    </th>
                    @endif




                    @foreach($tag as $res)
                    @endforeach

                    @if($res->trashed())
                    <th>
                        restore
                    </th>
                    @endif



                    <th>
                        delete
                    </th>

                </tr>
            </thead>
            @php
            $i = $tag->perPage() * ($tag->currentPage() - 1);
            @endphp
            @foreach($tag as $res)
            <tr>
                <td>{{++$i}} </td>
                <td>{{$res->name}}</td>
                <td>{{$res->post->count()}}</td>



                @if(!$res->trashed())
                <td> <a href="{{route('tag.edit',$res->id)}}" class="btn btn-info btn-sm text-light">Edit</a>
                </td>
                @endif

                @if($res->trashed())
                <td>
                    <button onclick="handleRestore({{$res->id}})" class="btn btn-sm btn-success  ">Restore</button>
                </td>
                @endif


                <td><button onclick="handleDelete({{$res->id}})" class="btn btn-sm btn-danger  ">{{$res->trashed() ?'delete' : 'Trash'}}</button></td>


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
                                    @if(!$res->trashed())
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

                <form action="" method="get" id="restoreform">




                    <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Restore tag</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    Are you sure you want to restore it

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">go back</button>
                                    <button type="submit" class="btn btn-success">restore</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </tr>
            @endforeach
        </table>

        {{$tag->links()}}

    </div>
    @else
    <div class="card-body">
        <h3> No tag found</h3>

    </div>
    @endif



</div>
@endsection

@section('scripts')

<script>
    function handleDelete(id) {

        var form = document.getElementById('deleteform')
        form.action = '/tag/' + id
        console.log(form)
        $('#deleteModal').modal('show')
    }
</script>
<script>
    function handleRestore(id) {

        var form = document.getElementById('restoreform')
        form.action = '/tagrestore/' + id
        console.log(form)
        $('#restoreModal').modal('show')
    }
</script>

@endsection