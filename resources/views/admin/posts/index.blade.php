@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block" >
                            <button type="button" class="close" data-dismiss='alert'>x</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titolo</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Tags</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{$post["id"]}}</td>
                                <td>{{$post["title"]}}</td>
                                <td>{{$post["slug"]}}</td>
                                <td>{{$post["category"]["name"] ?? ""}}</td>
                                <td>
                                    @if (count($post['tags']) > 0)
                                        @foreach ($post['tags'] as $tag)
                                            <span class="badge rounded-pill bg-primary">{{$tag['name']}}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('admin.posts.show', $post['id'])}}">
                                        <button type="button" class="btn btn-primary">Visualizza</button>
                                    </a>
                                    <a href="{{route('admin.posts.edit', $post['id'])}}">
                                        <button type="button" class="btn btn-warning">Modifica</button>
                                    </a>
                                    <form action="{{route("admin.posts.destroy", $post["id"])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Elimina</button>
                                    </form>
                                </td>
                            </tr> 
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection