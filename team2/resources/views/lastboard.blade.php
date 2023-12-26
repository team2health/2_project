@extends('layout.layout')

@section('title','Lastboard')

@section('main')

<main class="last_main">
    <a href="" class="community_a"><img class="community_icon" src="../img/top.png" alt=""></a>
    <a href="" class="community_aplus"><img class="community_icon" src="../img/plusicon.png" alt=""></a>
    <div class="last_headline">
        <h2>자유게시판</h2>
    </div>
    @forelse ($data as $item)
    <div class="last_container">
        <div class="last_user">
            <img class="community_icon"  src="{{ route('board.show',['board'=>$item->board_id]) }}" alt="" class="board_nic_img">                               
            <div class="board_nic_text">
                <div>
                    {{ optional($item->user)->user_name }}
                </div>
                <div>
                    {{$item->created_at}}
                </div>
            </div>
        </div> 
        <div class="last_title">
            {{$item->board_title}}
        </div> 
        <div class="last_content">
            {{$item->board_content}}
        </div>  
    </div>
    @empty
        게시글이 없습니다.
    @endforelse
</main>

@endsection