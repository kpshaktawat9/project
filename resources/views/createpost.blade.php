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
                        </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <form action="{{route('save-post')}}" method="POST">
            @csrf
            <input type="hidden" name="user" value="{{$user->id}}">

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <textarea class="form-control" id="desc" name="desc"> </textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
@endsection