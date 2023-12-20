@extends('layout.layout')

@section('title','Categoryboard')

@section('main')
<main class="last_main">
<a href="" class="community_a"><img class="community_icon" src="../img/top.png" alt=""></a>
        <a href="{{route('board.create')}}" class="community_aplus"><img class="community_icon" src="../img/plusicon.png" alt=""></a>
    <div class="last_headline">
        <h2>자유게시판</h2>
        <div class="dropdown">
            <button class="cate_btn" onclick="toggleDropdown()">정렬</button>
            <div class="dropdown-content" id="myDropdown">
                
                <a href="#">자유 게시판</a>
                <a href="#">정보 게시판</a>
                <a href="#">질문 게시판</a>
                <a href="#">친목 게시판</a>
            </div>
        </div>
    </div>

    
    <!-- @foreach ($data as $item)
    <div class="last_container">
        <div class="last_user">
             <img class="community_icon"  src="{{ $item->user->user_img }}" alt="" class="board_nic_img">   
            <img class="community_icon" src="{{ asset('public/user_img/' . optional($item->user)->user_img) }}" class="board_nic_img" alt="User Image">
            <div>Debug: {{ $item->user->user_img }}</div>
            <div class="board_nic_text">
                <div>
                {{ optional($item->user)->user_name }}
                </div>
                <div>
                {{ $item->created_at }}
                </div>
            </div>
        </div> 
        <div style="width: 300px; margin-left: 10px;">
            {{ $item->board_title }}
        </div> 
        <div class="last_content">
            <a href="{{ route('board.show',['board'=>$item->board_id]) }}" class="community_content">
                {{ $item->board_content }}
            </a>                   
        </div>  
    </div>
   
    @endforeach -->           
    @foreach ($data as $item)
    <div class="last_container">
        <div class="last_user">
            <img class="community_icon" src="{{ asset('user_img/' . $item->user->user_img) }}" alt="User Image">                               
            <div class="board_nic_text">
                <div>
                    {{ optional($item->user)->user_name }}
                </div>
                <div>
                    {{ $item->created_at }}
                </div>
            </div>
        </div> 
        <div style="width: 300px; margin-left: 10px;">
            {{ $item->board_title }}
        </div> 
        <div class="last_content">
            <a href="{{ route('board.show',['board'=>$item->board_id]) }}" class="community_content">
                {{ $item->board_content }}
            </a>                   
        </div>  
    </div>
@endforeach
    
</main>


@endsection
<script src="/js/categoryboard.js"></script> 
