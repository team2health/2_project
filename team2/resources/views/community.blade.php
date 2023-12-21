@extends('layout.layout')

@section('title','Community')

@section('main')
<main class="">    
    <div class="slider-container">
        <a href="" class="community_a"><img class="community_icon" src="../img/top.png" alt=""></a>
        <a href="{{route('board.create')}}" class="community_aplus"><img class="community_icon" src="../img/plusicon.png" alt=""></a>
        <div class="community_headline">
            <h2>🔥HOT 게시글</h2>
            <a href="{{route('categoryboard')}}" class="cate_btn">커뮤니티</a>            
        </div>		
	
		
        <div class="slider" id="slider">
            @forelse ($data[0] as $item)
            <a href="{{ route('board.show',['board'=>$item->board_id]) }}">
                <div class="slide board-display-flex">
                    <div>
                        <div>{{ $item->board_title }}</div>
                        <div>{{ $item->board_content }}</div>
                    </div>
                    <div class="community_bottom">
                        <div>
                            조회수 {{ $item->board_hits }}
                        </div>
                        <div>
                            댓글 {{ $item->comments->count() }}
                        </div>
                    </div>
                </div>
            </a>
            @empty
                <div>게시글 없음</div>
            @endforelse
        </div>
    </div>    
        
    <div class="favorite_slider-container">   
        <div class="favorite_slider">
            @forelse ($data[1] as $item)
            <div class="favorite_slide">
                <div class="favorite_slide-name">
                    {{ $item->pandemic_name }}
                </div> 
                <div class="community_content">
                    {{ $item->pandemic_symptoms }}
                </div>            
            </div>
            @empty
                
            @endforelse
        </div>
    </div>    
    <div class="community_tag_hidden">
        <div class="board-bc-gray">
        <div class="community_tag_container"> 
            <div class="">
                <h2>⭐관심 태그</h2>                    
            </div>
            <div style="margin-left: 30px;">
                @forelse ($data[4] as $item)
                <span>{{$item->hashtag_name}}</span>
            @empty
                등록된 관심태그가 없습니다
            @endforelse
            </div>
            <div class="community_tag">
                @forelse ($data[2] as $item)
                <div>
                    <div style="margin-bottom: 30px;">{{$item->board_title}}</div>
                    <div>{{$item->board_content}}</div>
                </div>
                @empty
            @endforelse
            </div>
            <div class="community_more_container">
                <button class="community_more">더보기</button>
            </div>
        </div>
    </div>
    <div class="community_tag_container">        
        <div class="community_headline">
            <h2>최근 게시글</h2>                     
        </div>
        <div class="community_tag border-line-color-gray">
            @forelse ($data[3] as $item)
                <div>
                    <div style="margin-bottom: 30px">{{ $item->board_title }}</div>
                    <div>{{ $item->board_content }}</div>
                </div>
            @empty
                게시글이 없습니다.
            @endforelse
        </div>
        <div class="community_more_container">
            <button class="community_more">더보기</button>
        </div>
    </div>
    
</main>
<script src="/js/community.js"></script>
@endsection
