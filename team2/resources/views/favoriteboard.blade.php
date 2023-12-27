@extends('layout.layout')

@section('title','Favoriteboard')

@section('main')

<main class="last_main">
    <a href="" class="community_a"><img class="community_icon" src="../img/top.png" alt=""></a>
    <a href="{{route('board.create')}}" class="community_aplus"><img class="community_icon" src="../img/plusicon.png" alt=""></a>
    <div class="last_headline">
        <h2>"관심 태그"</h2>
    </div>
    @forelse ($tag as $item)
        <span>{{ $item->hashtag_name }}</span>
    @empty
        
    @endforelse
    @forelse ($data as $item)
    <a href="{{ route('board.show',['board'=>$item->board_id]) }}">
    <div class="last_container">
        <div class="last_user">
        <img class="community_icon" src="{{ asset('user_img/'.optional($item->user)->user_img) }}" class="board_nic_img" alt="User Image">                               
            <div class="board_nic_text">
                {{-- {{dd(asset('user_img/' . optional($item->user)->user_img))}} --}}
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
        <a href="{{ route('board.show',['board'=>$item->board_id]) }}" class="community_content">
            <div class="last_content">
                {{$item->board_content}}
                <div style="margin-top: 20px; text-align: right;">
                @forelse ($item->board_tag as $value)
                    {{$value->hashtag_name}}
                @empty
                    
                @endforelse
                </div>
            </div> 
        </a> 
    </div>
    </a>
    @empty
        게시글이 없습니다.
    @endforelse
</main>
@endsection