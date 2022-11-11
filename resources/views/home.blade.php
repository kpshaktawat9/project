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
        @if(isset($posts))
            @foreach($posts as $post)
                
                    <div class="row justify-content-center text-center m-2  pt-2 pb-2 bg-light" >
                        <div class="col-8 p-2" style="border: 2px solid black; border-radius: 20px 10px 35px 10px; background-color: #e3f2fd;">
                            <div>
                                <h3 class="bg-light" style="border-radius: 10px;">{{$post->title}}</h3>
                                <div class="bg-light" style="max-height: 50px; min-height:50px; overflow:hidden; border-radius: 10px;">
                                    {{$post->description}}
                                </div>
                                <div class="m-2 float-start">
                                    <a href="{{url('post/view/'.$post->id)}}">
                                        <button type="button" data-id="{{$post->id}}" class="btn btn-success view">view <span>{{$post->views??0}}</span></button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
        @endif     
@endsection