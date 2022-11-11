@extends('dashboard')
@section('content')
        <div class="row justify-content-center text-center" style="background-color: #e3f2fd;">
            <div class="col">
                <h3>{{strtoupper($user->first_name)}} {{strtoupper($user->last_name)}}</h3>
            </div>
        </div>
        <div class="row justify-content-center text-center" style="background-color: #e3f2fd;">
            <div class="col">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <div class="navbar-nav">
                            <a class="nav-link active" aria-current="page" href="{{ route('dashboard')}}">Home</a>
                            <a class="nav-link active" aria-current="page" href="{{ route('posts')}}">View Posts</a>
                            <a class="nav-link" href="{{ route('create.post')}}">Create Post</a>
                            <a class="nav-link" href="{{ route('top.posts')}}">Top view/like</a>
                        </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-11">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td>{{substr($post->description,0,90);}}{{'.....'}}</td>
                                <td>
                                    <a href="{{url('post/edit/'.$post->id)}}" data-id="{{$post->id}}">Edit</a>
                                    <a href="{{url('post/delete/'.$post->id)}}" data-id="{{$post->id}}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection