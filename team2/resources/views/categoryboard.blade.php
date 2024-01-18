@extends('layout.layout')

@section('title','Categoryboard')

@section('main')
<div class="last_main" id='category-board'>
    <a href="{{route('board.create')}}" class="community_aplus" onclick="openModal(); return false;"><img class="community_icon" src="../img/plusicon.png" alt=""></a>
    <div class="last_headline">
        <h2>"{{$data[2][0]->category_name}}"</h2>
    </div>

    


    @forelse ($data[0] as $item)
    <a href="{{ route('board.show',['board'=>$item->board_id]) }}">
    <div class="last_container">
        <div class="last_user">  
            <img class="community_icon" src="{{ asset('user_img/' . optional($item->user)->user_img) }}" class="board_nic_img" alt="User Image">   
            <div class="board_nic_text">
                <div class="user-nickname">
                {{ optional($item->user)->user_name }}
                </div>
                <div class="board_created_at">
                    {{ substr($item->created_at, 0, 10)}}
                </div>
            </div>
        </div> 
        <div style="margin-left: 20px;" class="community-category-title">
            {{ $item->board_title }}
        </div> 
            <div class="last_content">
                {!! $item->board_content !!}
            </div>  
        </div>
    </a>
    @empty
    게시글이 없습니다.
    @endforelse
    
</div>

{{-- <div style="display: none;" class="last_main" id="category-board-modal">
    <a href="" class="community_a"><img class="community_icon" src="../img/top.png" alt=""></a>
            <a href="{{route('board.create')}}" class="community_aplus"><img class="community_icon" src="../img/plusicon.png" alt=""></a>
        <div class="last_headline">
            <h2>정보</h2>
            <div class="dropdown">
                <button class="cate_btn" onclick="toggleDropdown2()">정렬</button>
                <div class="dropdown-content" id="myDropdown2">
                </div>
            </div>
        </div>
    
        <div class="last_container">
            <div class="last_user">
                <img class="community_icon" src="" alt="" class="board_nic_img">                               
                <div class="board_nic_text">
                    <div>{{ optional($item->user)->user_name }}</div>
                    <div>{{ $item->created_at }}</div>
                </div>
            </div> 
            <div style="width: 300px; margin-left: 10px;">{{ $item->board_title }}</div> 
            <div class="last_content">
                <a href="{{ route('board.show',['board'=>$item->board_id]) }}" class="community_content">{{ $item->board_content }}</a>                   
            </div>  
        </div>
</div> --}}

<div class="pagination">    
    @if ($data[0]->currentPage() > 1)
        <a href="{{ $data[0]->url(1) }}">&lt;&lt;</a>
        <a class="page_pre" href="{{ $data[0]->previousPageUrl() }}">이전</a>
    @endif

    @for ($i = max(1, $data[0]->currentPage() - 2); $i <= min($data[0]->lastPage(), $data[0]->currentPage() + 2); $i++)
        @if ($i == $data[0]->currentPage())
            <span class="pagination-current">{{ $i }}</span>
        @else
            <a href="{{ $data[0]->url($i) }}" class="pagination-link">{{ $i }}</a>
        @endif
    @endfor

    @if ($data[0]->currentPage() < $data[0]->lastPage())
        <a class="page_pre" href="{{ $data[0]->nextPageUrl() }}">다음</a>
        <a href="{{ $data[0]->url($data[0]->lastPage()) }}">&gt;&gt;</a>
    @endif
</div>
<br><br><br><br><br><br><br><br>
<script src="/js/categoryboard.js"></script>
@endsection
