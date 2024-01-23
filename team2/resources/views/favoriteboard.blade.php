@extends('layout.layout')

@section('title','Favoriteboard')

@section('main')


<main class="last_main">
    <a href="{{route('board.create')}}" class="community_aplus" onclick="openModal(); return false;"><img class="community_icon" src="../img/plusicon.png" alt=""></a>
    <div class="last_headline">
        <h2>"관심 태그"</h2>
    </div>
    <span style="font-weight: 700; font-size: 1.2rme; margin-left: 10px;"> <나의 관심태그>  
    @forelse ($tag as $item)
        </span><span class="favorite-tag-board-in">{{ $item->hashtag_name }}</span>
    @empty
        
    @endforelse
    @forelse ($data as $item)
    <a href="{{ route('board.show',['board'=>$item->board_id]) }}">
    <div class="last_container">
        <div class="last_user">
        <img class="community_icon" src="/user_img/{{$item->userinfo[0]->user_img}}" class="board_nic_img" alt="User Image">                               
            <div class="board_nic_text">
                <div class="user-nickname">
                    {{$item->userinfo[0]->user_name}}
                </div>
                <div class="board_created_at">
                    {{ substr($item->created_at, 0, 10)}}
                </div>
            </div>
        </div> 
        <div class="last_title">
            {{$item->board_title}}
        </div> 
        <div class="last_content">
            {!! $item->board_content !!}
            <br>
            @forelse ($item->board_tag as $value)
            <span class="favoriteboard-favorite-tag">{{$value->hashtag_name}}</span>
            @empty
                
            @endforelse
        </div> 
    </div>
    </a>
    @empty
        <br><br>게시글이 없습니다.
    @endforelse
</main>
<div class="pagination">    
    @if ($data->currentPage() > 1)
        <a href="{{ $data->url(1) }}">&lt;&lt;</a>
        <a class="page_pre" href="{{ $data->previousPageUrl() }}"> 이전</a>
    @endif

    @for ($i = max(1, $data->currentPage() - 2); $i <= min($data->lastPage(), $data->currentPage() + 3); $i++)
        @if ($i == $data->currentPage())
            <span class="pagination-current">{{ $i }}</span>
        @else
            <a href="{{ $data->url($i) }}" class="pagination-link">{{ $i }}</a>
        @endif
    @endfor

    @if ($data->currentPage() < $data->lastPage())
        <a class="page_pre" href="{{ $data->nextPageUrl() }}">다음 </a>
        <a href="{{ $data->url($data->lastPage()) }}">&gt;&gt;</a>
    @endif
</div>
<br><br><br><br><br><br><br><br>
@endsection