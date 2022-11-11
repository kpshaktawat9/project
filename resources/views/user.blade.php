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
            @php
            $arr= [];
                foreach($likes as $like){
                    array_push($arr, $like);
                }
            @endphp
                @if (in_array($posts->id, $arr))
                
                    <div class="row justify-content-center text-center m-2 pt-2 pb-2">
                        <div class="col-8 p-2" style="border: 2px solid black; border-radius: 20px 10px 35px 10px; background-color: #e3f2fd;">
                            <div>
                                <h3 class="bg-light">{{ucfirst($posts->title)}}</h3>
                                <div class="bg-light" style="min-height: 100px;">
                                    {{$posts->description}}
                                </div>
                                <div class="m-2 float-start">
                                    <button type="button" data-id="{{$posts->id}}" class="btn btn-success">Like <span class="like">{{$posts->likes??0}}</span></button>
                                    <button type="button" data-id="{{$posts->id}}" class="btn btn-primary unlike">Unlike <span>{{$posts->unlikes??0}}</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                
                @else
                    <div class="row justify-content-center text-center m-2 pt-2 pb-2">
                        <div class="col-8  p-2" style="border: 2px solid black; border-radius: 20px 10px 35px 10px; background-color: #e3f2fd;">
                            <div>
                                <h3 class="bg-light" style="border-radius: 10px;">{{ucfirst($posts->title)}}</h3>
                                <div class="bg-light" style="min-height: 100px; border-radius: 10px;">
                                    {{$posts->description}}
                                </div>
                                <div class="m-2 float-start">
                                    <button type="button" data-id="{{$posts->id}}" class="btn btn-primary like">Like <span class="like">{{$posts->likes??0}}</span></button>
                                    <button type="button" data-id="{{$posts->id}}" class="btn btn-primary unlike">Unlike <span>{{$posts->unlikes??0}}</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                @endif
        @endif
        
@endsection
@section('script')
    <script>
        $(document).on('click','.like',function(){
            var id = $(this).attr('data-id');
            var btn = $(this);
            var url="{{route('like')}}";
                    $.ajax({
                        headers:{'X-CSRF-Token':$('meta[name=csrf_token]').attr('content')},
                        type:"post",
                        url:url,
                        data:{id:id},
                        success:function(response){
                            //$('#image_url').val("<?php echo url('/storage/custom_img'); ?>"+'/'+response.valueimg);
                            // $('.k_img').after('<p class="text-danger k_img_url">'+"<?php echo url('/storage/custom_img'); ?>"+'/'+response.valueimg+'</p>');
                            
                            // element.siblings('span.like').val(response.total_like);
                            btn.children('span.like').text(response.total_like);
                            btn.removeClass('like');
                            btn.removeClass('btn-primary').addClass('btn-success');
                            // console.log(btn.children());
                            // alert(element.siblings('span.like').text(response.total_like));
                        }
                    });
        });
    </script>
@endsection