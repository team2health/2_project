@extends('layout.layout')

@section('title','Community')

@section('main')
<main class="">
    <div class="slider-container">
        <a href="" class="community_a"><img class="community_icon" src="../img/top.png" alt=""></a>
        <a href="{{route('board.create')}}" class="community_aplus"><img class="community_icon" src="../img/plusicon.png" alt=""></a>
        <div class="community_headline">
            <h2>🔥HOT 게시글</h2>
            <a href="{{route('lastboard.get')}}" class="cate_btn_go">전체보기</a>            
        </div>
	
		
        <div class="slider" id="slider">
            @forelse ($data[0] as $item)
            <a href="{{ route('board.show',['board'=>$item->board_id]) }}">
                <div class="slide a-bordergo-hover">
                    <div>
                        <div class="hot-title">{{ $item->board_title }}</div>
                        <div class="hot-content">{!! Str::limit($item->board_content, 130, '...') !!}</div>
                    </div>
                    <div class="community_bottom">
                        <div class="hot-info">
                            조회수 {{ $item->board_hits }}
                        </div>
                        <div class="hot-info">
                            댓글 {{ $item->comments->count() }}
                        </div>
                    </div>
                </div>
            </a>
            @empty
                게시글이 없습니다.
            @endforelse
        </div>
    </div>    
        
    <div class="favorite_slider-container"> 
        <h2> 유행 중인 질병 </h2>
        <div class="favorite_slider">
            @forelse ($data[1] as $item)
            <div class="favorite_slide">
                <div class="favorite_slide-name">
                    {{ $item->pandemic_name }}
                </div> 
                <div class="community_pandemic_content">
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
            <div class="community-favorite-show">
                <h2>⭐관심 태그</h2>                    
            </div>
            <div style="margin: 5px 0 5px 20px;">
                @forelse ($data[4] as $item)
                <span>{{$item->hashtag_name}}</span>
            @empty
                등록된 관심태그가 없습니다
            @endforelse
            </div>
            <div class="community_tag bordergo-hover" id="favoriteboard">
                @forelse ($data[2] as $item)
                <a href="{{ route('board.show',['board'=>$item->board_id]) }}">
                    <div>
                        <div class="community-home-title">{{Str::limit($item->board_title, 30, '...')}}</div>
                        <div class="community-home-content">{!! Str::limit($item->board_content, 100, '...') !!}</div>
                    </div>
                    <div class="community-fav-board-tag">
                    @forelse ($item->board_tag as $value)
                            <span>{{$value->hashtag_name}}</span>
                            @empty
                            
                            @endforelse
                    </div>
                </a>
                @if($loop->last)
                <input type="hidden" name="favorite_num" value="{{ $item->board_id }}" id="favorite_num">
                @endif
                @empty
            @endforelse
            </div>
            @if (count($data[2]) === 0)

            @else
            <div class="community_more_container">
                <button class="community_more" onclick="favoriteBoard(); return false;" id="favoritebtn">더보기</button>
                {{-- <p>{{count($data[2]) }}</p> --}}
            </div>
            @endif
        </div>
    </div>
    <div class="community_tag_container">        
        <div class="community_headline">
            <h2>최근 게시글</h2>                     
        </div>
        <div class="community_tag border-line-color-gray bordergo-hover" id="lastboardbox">
            @forelse ($data[3] as $item)
            <a href="{{ route('board.show',['board'=>$item->board_id]) }}">
                <div>
                    <div class="community-home-title">{{Str::limit($item->board_title, 30, '...')}}</div>
                    <div class="community-home-content">{!! Str::limit($item->board_content, 100, '...') !!}</div>
                </div>
            </a>
            @if($loop->last)
            <input type="hidden" name="last_num" value="{{ $item->board_id }}" id="last_num">
            @endif

            @empty
                게시글이 없습니다.
            @endforelse
        </div>
        @if (count($data[3]) === 0)
            
        @else
        <div class="community_more_container" id="lastboardbtn">
            <button class="community_more" onclick="lastBoard(); return false;">더보기</button>
        </div>
        @endif
    </div>
</main>
<script src="/js/community.js"></script>
@endsection
