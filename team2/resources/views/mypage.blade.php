@extends('layout.layout')

@section('title','mypage')
    

@section('main')

<div class="mypage-main">
    <div class="mypage-main-grid" id="mypageMainGrid">
        {{-- 나의 프로필과 아이디 띄우는 곳 --}}
        <div class="mypage-myProfile" id="mypageProfile">
            <div class="mypage-myProfile-btn">
                <img src="/img/default_f.png" alt="">
                <div class="mypage-myProfile-btn-name">닉네임</div>
            </div>
        </div>
        {{-- 정보수정 --}}
        <div class="mypage-myInfo" id="mypageMyInfo">
            {{-- 비밀번호 변경--}}
            <div class="mypage-myInfo-first">
                <div class="mypage-main-btn">
                    <img src="/img/password.png" alt="">
                    <div class="mypage-main-btn-name">비밀번호 변경</div>
                </div>

            </div>
            {{-- 나의 정보 --}}
            <div class="mypage-myInfo-second">
                <div class="mypage-main-btn">
                    <img src="/img/userinfo.png" alt="">
                    <div class="mypage-main-btn-name">나의 정보</div>
                </div>

            </div>
            {{-- 나의 게시글 목록 --}}
            <div class="mypage-myInfo-third">
                <div class="mypage-main-btn" onclick="goToMyBoard(); return false;">
                    <img src="/img/myboard.png" alt="">
                    <div class="mypage-main-btn-name">게시글 목록</div>
                </div>
                    <div class="mypage-myInfo-third" id="mypageMyInfoThird">
                        <div class="tab">
                            <ul class="tab_list">
                                <li class="mypage-board-show-btn active" data-list="1">
                                    내가 쓴 게시글
                                </li>
                                <li class="mypage-board-show-btn" data-list="2">
                                    내가 쓴 댓글
                                </li>
                            </ul>
                        <div class="tab-contents tab-show" data-order="1">
                            <div class="community_tag bordergo-hover">
                                @forelse ($data as $value => $item)
                                <a href="{{ route('board.show',['board'=>$item["board_id"]]) }}">
                                    <div class="community-fav-board-tag mypage-board-tag">
                                        <div class="mypage-board-first-line">
                                            @forelse ($item["board_tag"] as $value)
                                                <span>{{$value->hashtag_name}}</span>
                                            @empty
                                            
                                            @endforelse
                                        </div>
                                            <div class="mypage-myboard-date">{{$item["created_at"]}}</div>
                                    </div>
                                    <span class="spantag-span-display-block">
                                        <span class="community-home-title">{{Str::limit($item["board_title"], 30, '...')}}</span>
                                        <span class="community-home-content">{!! Str::limit($item["board_content"], 40, '...') !!}</span>
                                    </span>
                                    <span class="community-home-board-img-span">
                                        <img class="mypage-board-img" src="/img/default_f.png" alt="">
                                    </span>
                                </a>
                                @if($loop->last)
                                <input type="hidden" name="favorite_num" value="{{ $item["board_id"] }}" id="favorite_num">
                                @endif
                                @empty
                                <div> 작성한 게시글이 없습니다.</div>
                            @endforelse
                            </div>
                        </div>
                        <div class="tab-contents2" data-order="2">
                            <div class="community_tag bordergo-hover">
                                @forelse ($comments as $index => $item)
                                    <a href="{{route('board.show', ['board' => $item->board_id])}}">
                                        <div>
                                            <span>{{$item->board_title}}</span>
                                            <span>카테고리</span>
                                        </div>
                                        <div>{!! Str::limit($item->board_title, 40, '...') !!}</div>
                                        <div>{{Str::limit($item->comment_content, 75, '...')}}</div>
                                    </a>
                                @empty
                                    <div> 작성한 댓글이 없습니다. </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mypage-gap" id="mypageGap"></div>

        {{-- 관심태그 --}}
        <div class="mypage-favoriteTag" id="mypageFavoriteTag">
            {{-- 관심태그 버튼 --}}
            <div class="mypage-main-btn" id="mypageMainBtn">
                <input type="hidden" value="0" id="favoriteFlg">
                <img src="/img/favoritetag.png" alt="">
                <div class="mypage-main-btn-name" onclick="canDeleteHashLoad(); return false;">관심태그 목록</div>
            </div>

            <div class="mypage-hashtag-display mypage-display-none" id="mypageHashtagAll">
                <div class="mypage-myHashtag">
                    <div class="mypage-myHashtag-div" onclick="hashtagNoneDisplay(); return false;">
                        <input type="hidden" value="0" id="showMyHashtagAll">
                        <div>나의 관심태그 목록</div>
                        <img src="/img/close.png" alt="">
                    </div>
                </div>
                    <div class="mypage-hashtag" id="mypageHashtag" style="display: none;">
                        @forelse ($user_hashtag as $item)
                            <div class="mypage-hashtag-click" id="favoriteHashtagId{{$item->favorite_tag_id}}" onclick="favoritehashdelete({{$item->favorite_tag_id}}); return false;">
                                <span id="favoritehashtext{{$item->favorite_tag_id}}" value="{{$item->favorite_tag_id}}">{{$item->hashtag_name}}</span>
                            </div>
                        @empty
                            <span id="noticeThatFavoriteNone" class="notice-that-favorite-none"> 관심태그로 등록한 해시태그가 없습니다.</span>
                        @endforelse
                    </div>

                    <form action="/hashtagsearch" method="post" class="mypage-hashtag-search-form" id="mypageHastagSearchForm">
                        @csrf
                        <div class="mypage-hashtag-search-div">
                            <input type="text" placeholder="해시태그 검색" name="hashsearch">
                            <button type="submit" class="mypage-hashtag-search">
                                <img src="/img/search.png">
                            </button>
                        </div>
                        <div id="searchHashtag" class="mypage-seach-hashtag">

                        </div>
                    </form>
                    <div id="mypageCanGetAllTag" class="mypage-can-get-all-tag">
                        <div class="mypage-can-get-all-tag-msg">
                            <img src="/img/favoritetag.png" alt="">
                            <span>관심태그 추가하기</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mypage-logout" id="mypageLogout">로그아웃</div>




</div>


<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="/js/mypage.js"></script>
@endsection