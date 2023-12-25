@extends('layout.layout')

@section('title','Hotboard')

@section('main')
<main class="last_main">
    <a href="" class="community_a"><img class="community_icon" src="../img/top.png" alt=""></a>
    <a href="" class="community_aplus"><img class="community_icon" src="../img/plusicon.png" alt=""></a>
    <div class="last_headline">
        <h2>핫게시글</h2>        
    </div>
    @forelse ($data as $item)
    <a href="{{ route('board.show',['board'=>$item->board_id]) }}">
        <div class="last_container">
            <div class="last_user">
                <img class="community_icon"  src="{{ asset('user_img/' . optional($item->user)->user_img) }}" alt="" class="board_nic_img">                               
                <div class="board_nic_text">
                    <div>
                        {{ optional($item->user)->user_name }}
                    </div>
                    <div>
                        {{$item->created_at}}
                    </div>
                </div>
            </div> 
            <div>
                {{$item->board_title}}
            </div> 
            <div class="last_content">
                {{$item->board_content}}
            </div>  
        </div>
    </a>
    @empty
        게시글이 없습니다.
    @endforelse
</main>
@endsection