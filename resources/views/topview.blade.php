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
                    <button type="button" data-id="{{$user->id}}" data-name="views" class="btn btn-success liked m-3">Top Viewed</button>
                    <button type="button" data-id="{{$user->id}}" data-name="likes" class="btn btn-success liked m-3">Top Liked</button>
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Views</th>
                            <th scope="col">likes</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td>{{substr($post->description,0,90);}}{{'.....'}}</td>
                                <td>{{$post->views}}</td>
                                <td>{{$post->likes}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection
@section('script')
    <script>
        $(document).on('click','.liked',function(){
            var id = $(this).attr('data-id');
            var type = $(this).attr('data-name');
            var btn = $(this);
            var url="{{route('liked')}}";
                    $.ajax({
                        headers:{'X-CSRF-Token':$('meta[name=csrf_token]').attr('content')},
                        type:"post",
                        url:url,
                        data:{id:id,type:type},
                        success:function(response){
                            $('.tbody').html('');
                           var data =response.posts;
                           data.forEach(function(post){
                               $('.tbody').append(`
                                    <tr>
                                        <td>${post['title']}</td>
                                        <td>${post['description'].substring(0,90)}.....</td>
                                        <td>${post['views']}</td>
                                        <td>${post['likes']}</td>
                                    </tr>
                               
                               `);
                           });
                        }
                    });
        });
    </script>
@endsection