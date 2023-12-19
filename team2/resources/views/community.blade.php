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
            @forelse ($data as $item)
                <div class="slide">
                    <div>
                        {{ $item->board_title }}
                    </div>
                    <a href="{{ route('board.show',['board'=>$item->board_id]) }}" class="community_content">
                    {{ $item->board_content }}
                     </a>
                    <div class="community_bottom">
                        <div>
                            {{ $item->board_hits }}
                        </div>
                        <div>
                            댓글 {{ $item->comments->count() }}
                        </div>
                    </div>
                </div>
            @empty
                <div>게시글 없음</div>
            @endforelse
        </div>
    </div>    
        
    <div class="favorite_slider-container">   
        <div class="favorite_slider">
            
            <div class="favorite_slide">
                <div>
                    COVID-19
                </div> 
                <div class="community_content">
                    주요증상: 기침 발열 맛을 못느낌
                    걸리면 끄앙하고 아픔
                </div>            
            </div>
            <div class="favorite_slide">
                <div>
                    COVID-19
                </div> 
                <div class="community_content">
                주요증상: 기침 발열 맛을 못느낌
                    재슈 없으면 꽥하고 쥬금
                </div>            
            </div>
            <div class="favorite_slide">
                <div>
                    COVID-19
                </div> 
                <div class="community_content">
                    주요증상: 기침 발열 맛을 못느낌
                    걸리면 끄앙하고 아픔
                </div>            
            </div>
            <div class="favorite_slide">
                <div>
                    COVID-19
                </div> 
                <div class="community_content">
                주요증상: 기침 발열 맛을 못느낌
                    재슈 없으면 꽥하고 쥬금
                </div>            
            </div>
        </div>
    </div>    
    <div class="community_tag_hidden">
        <div class="community_tag_container"> 
            <div class="">
                <h2>⭐관심 태그</h2>                    
            </div>
            <div>
                #기침 # 발열
            </div> 
            <div class="community_tag">
                <div>
                    <div >
                    Covid-19
                    </div>
                    <div>
                    글자 미리보기 길이는 이정도이면 될 것 같습니다. 끝에는 말줄임표를 추...
                    </div>
                </div>
                <div>
                    <div >
                    Covid-19
                    </div>
                    <div>
                    글자 미리보기 길이는 이정도이면 될 것 같습니다. 끝에는 말줄임표를 추가 되려나?...
                    </div>
                </div>
                <div>
                    <div >
                    Covid-19
                    </div>
                    <div>
                    글자 미리보기 길이는 이정도이면 될 것 같습니다. 끝에는 말줄임표를 추...
                    </div>
                </div>
                <div>
                    <div >
                    Covid-19
                    </div>
                    <div>
                    글자 미리보기 길이는 이정도이면 될 것 같습니다. 끝에는 말줄임표를 추...
                    </div>
                </div>
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
        <div class="community_tag">
            <div>
                <div >
                Covid-19
                </div>
                <div>
                글자 미리보기 길이는 이정도이면 될 것 같습니다. 끝에는 말줄임표를 추...
                </div>
            </div>
            <div>
                <div >
                Covid-19
                </div>
                <div>
                글자 미리보기 길이는 이정도이면 될 것 같습니다. 끝에는 말줄임표를 추가 되려나?...
                </div>
            </div>
            <div>
                <div >
                Covid-19
                </div>
                <div>
                글자 미리보기 길이는 이정도이면 될 것 같습니다. 끝에는 말줄임표를 추...
                </div>
            </div>
            <div>
                <div >
                Covid-19
                </div>
                <div>
                글자 미리보기 길이는 이정도이면 될 것 같습니다. 끝에는 말줄임표를 추...
                </div>
            </div>
        </div>
        <div class="community_more_container">
            <button class="community_more">더보기</button>
        </div>
    </div>
    
</main>
<script src="/js/community.js"></script>
@endsection
