@extends('layout.layout')

@section('title','Community')

@section('main')

<main class="community-main-container">
    <div class="slider-container">
        <a href="{{route('board.create')}}" class="community_aplus" onclick="openModal(); return false;"><img class="community_icon" src="../img/plusicon.png" alt=""></a>
        
    <div class="favorite_slider-container"> 
        <h2 class="community-trend-disease"> 유행 중인 질병 </h2>
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
        <div class="community_headline">
            <h2>🔥HOT 게시글</h2>    
        </div>
	
		
        <div class="slider" id="slider">
            @forelse ($data[0] as $item)
            <a href="{{ route('board.show',['board'=>$item->board_id]) }}">
                <div class="slide a-bordergo-hover">
                    <div>
                        <div class="hot-title">{{ $item->board_title }}</div>
                        <div class="hot-content">{!! Str::limit($item->board_content, 85, '...') !!}</div>
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
        <div class="board-bc-gray">
        <div class="community_tag_container"> 
            <div class="community-favorite-show">
                <h2>⭐관심 태그</h2>                    
            </div>
            <div style="margin: 1px 0 22px 34px;" class="community-favoritetag-list">
                @forelse ($data[4] as $item)
                <span>{{$item->hashtag_name}}</span>
            @empty
                등록된 관심태그가 없습니다
            @endforelse
            </div>
            <div class="community_tag bordergo-hover" id="favoriteboard">
                @forelse ($data[2] as $item)
                <a href="{{ route('board.show',['board'=>$item->board_id]) }}">
                    <div class="community-fav-board-tag">
                        @forelse ($item->board_tag as $value)
                            <span>{{$value->hashtag_name}}</span>
                        @empty
                                
                        @endforelse
                        </div>
                    <span class="spantag-span-display-block">
                        <span class="community-home-title">{{Str::limit($item->board_title, 30, '...')}}</span>
                        <span class="community-home-content">{!! Str::limit($item->board_content, 40, '...') !!}</span>
                    </span>
                    <span class="community-home-board-img-span"><img class="community-home-board-img" src="{{isset($item->board_img[0]->img_address) ? "/board_img/".$item->board_img[0]->img_address : ""}}" alt=""></span>
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
                <span>
                    <span class="community-home-title">{{Str::limit($item->board_title, 30, '...')}}</span>
                    <span class="community-home-content">{!! Str::limit($item->board_content, 100, '...') !!}</span>
                </span>
                <span class="community-home-board-img-span"><img class="community-home-board-img" src="{{isset($item->board_img[0]->img_address) ? "/board_img/".$item->board_img[0]->img_address : ""}}" alt=""></span>
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
    <br>
</main>
<br><br><br><br><br><br>
<script src="/js/community.js"></script>
@endsection
