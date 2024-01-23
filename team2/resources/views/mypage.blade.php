@extends('layout.layout')

@section('title','mypage')
    

@section('main')

<div class="mypage-main">
    <div class="mypage-main-grid" id="mypageMainGrid">
        {{-- 나의 프로필과 아이디 띄우는 곳 --}}
        <div class="mypage-myProfile">
            <div class="mypage-myProfile-btn" id="mypageProfile" onclick="myprofileChange(); return false;">
                <div class="mypage-myProfile-img" style="background-image: url(/user_img/{{$user_info[0]->user_img}});"></div>
                <div class="mypage-myProfile-btn-name">{{$user_info[0]->user_name}}</div>
            </div>

            <div id="mypageProfileChange" class="mypage-display-none">
                <div id="mypageContent2">
                    <form action="/userinfoupdate" class="user-info-modify" method="POST" id="userinfo_form" enctype="multipart/form-data">
                        @csrf
                        <div id="UserInfoModify" class="User-info-modify">
                            <div class="mypage-profile-div">
                                <label for="profilephoto" class="user-info-modify-1">
                                    <div id="profilephotoview" class="profile-photo-btn" style="background-image: url(/user_img/{{$user_info[0]->user_img}});"></div>
                                    <span id="user_img_name"></span>
                                </label>
                                <input type="file" accept="image/*" style="display: none;" id="profilephoto" name="user_img">
                                <label for="profilephoto" class="mypage-btn user-info-modify-2"> 사진 변경 </label>
                                <div class="mypage-btn user-info-modify-3" id="user-info-img-remove" onclick="userimgremove(); return false;"> 삭제 </div>
                                <input type="hidden" name="imgFlg" id="imgflg">
                            </div>
                            <span id="user-img-url"></span>
                            <br>
                            <div class="mypage-gap mypage-display-none" id="mypageGap3"></div>
                            <label for="usermodifyname" class="mypage-info-label">닉네임</label>
                            <span class="user-info-btn-chk" onclick="nameChange(); return false;" id="name-info-btn"> 닉네임 중복 확인 </span>
                            <input type="text" id="usermodifyname" name="user_name" value="{{$user_info[0]->user_name}}">
                            <div class="mypage-btn-line-modify">
                                <button type="button" class="mypage-btn mpb-modify" onclick="userinfoupdate(); return false;">수정완료</button>
                            </div>
                        </div>
                    </form>
                </div>
                <br><br><br><br>
            </div>
        </div>
        {{-- 정보수정 --}}
        <div class="mypage-myInfo" id="mypageMyInfo">
            {{-- 비밀번호 변경--}}
            <div class="mypage-myInfo-first">
                <a class="mypage-main-btn" href="{{ route('firstchkpassword') }}">
                    <img src="/img/password.png" alt="">
                    <div class="mypage-main-btn-name">비밀번호 변경</div>
                </a>
            </div>
            
            {{-- 나의 정보 --}}
            <div class="mypage-myInfo-second">
                <div class="mypage-main-btn" onclick="setNewInfo(); return false;">
                    <img src="/img/userinfo.png" alt="">
                    <div class="mypage-main-btn-name">나의 정보</div>
                </div>
                <div class="mypage-display-none" id="mypagemyInfoMain">
                    <div id="mypageContent2">
                        <form action="/userinfoupdate" class="user-info-modify" method="POST" enctype="multipart/form-data">
                            @csrf
                                <h2>가입 정보</h2>
                                <label class="mypage-info-label">아이디</label>
                                <div class="user-now-address">{{$user_info[0]->user_email}}</div>
                                <label class="mypage-info-label">우편번호</label>
                                <div class="user-now-address">{{$user_info[0]->user_address_num}}</div>
                                <label class="mypage-info-label">현재 주소지</label>
                                <div class="user-now-address">{{$user_info[0]->user_address}} {{$user_info[0]->user_address_detail}}</div>
                                <br>
                                <br>
                                {{-- 선 --}}
                                <div class="mypage-gap mypage-display-none" id="mypageGap2"></div>

                                <h2>주소 변경</h2>
                                <br>
                                {{-- <label class="mypage-info-label">주소 변경</label> --}}
                                <div class="adress-box">
                                    <div class="adressbox_boxa">
                                        <input class="adress-box-a" type="text" id="sample4_postcode" placeholder="우편번호" name="user_address_num" readonly>
                                        <input type="button" onclick="sample4_execDaumPostcode()" value="우편번호 찾기" class="mypage-btn">
                                    </div>
                                    <span id="guide" style="color:#999;display:none"></span>
                                    <input class="adress-box-b" type="text" id="sample4_roadAddress" name="user_address" placeholder="도로명주소" readonly>
                                    <br>
                                    <input class="adress-box-b" type="text" id="sample4_detailAddress" name="user_address_detail" placeholder="상세주소">
                                </div>
                                <div class="mypage-btn-line-modify">
                                    <button type="submit" class="mypage-btn mpb-modify">수정완료</button>
                                    {{-- <a href="{{route('mypage.get')}}"><div class="mypage-btn">취소</div></a> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mypage-gap mypage-display-none" id="mypageGap2"></div>
                <div id="UserAccountDelete" class="mypage-display-none" onclick="goToDeleteIdZone(); return false;">
                    <div class="mypage-logout" id="goToDeleteIdZone">탈퇴하기</div>
                </div>
                <div class="mypage-byebye mypage-display-none" id="passwordFirstChk">
                    <form action="/deleteacountchk" method="post">
                        @method('POST')
                        @csrf
                        <div class="password-pass-main-div">
                            <div class="mypage-account-delete">
                                한 번 탈퇴하시면 계정을 복구할 수 없습니다.</div>
                            <label class="mypage-info-label" for="password-first-chk">비밀번호 확인</label>
                            <input class="password-pass" name="user_password" type="password" placeholder="비밀번호를 입력해주세요." id="password-first-chk">
                        </div>
                    </form>
                </div>
            {{-- 나의 게시글 목록 --}}
            <div class="mypage-myInfo-third">
                <div class="mypage-main-btn" onclick="goToMyBoard(); return false;">
                    <img src="/img/myboard.png" alt="">
                    <div class="mypage-main-btn-name">게시글 목록</div>
                </div>
                    <div class="mypage-myInfo-third mypage-display-none" id="mypageMyInfoThird">
                        <div class="tab">
                            <div class="mypage-myProfile-btn" onclick="myprofileChange(); return false;">
                                <div class="mypage-myProfile-img" style="background-image: url(/user_img/{{$user_info[0]->user_img}});"></div>
                                <div class="mypage-myProfile-btn-name">{{$user_info[0]->user_name}}</div>
                            </div>
                            <ul class="tab_list" id="topBar">
                                <li class="mypage-board-show-btn timeline-active" data-list="1" id="tabBtnFirst">
                                    내가 쓴 게시글
                                </li>
                                <li class="mypage-board-show-btn" data-list="2" id="tabBtnSecond">
                                    내가 쓴 댓글
                                </li>
                            </ul>
                        <div class="tab-contents tab-show" data-order="1">
                            <div class="community_tag margin-bottom-200 bordergo-hover">
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
                                    @if(isset($item["img_address"]))
                                    <span class="community-home-board-img-span">
                                        <img class="mypage-board-img" src="/board_img/{{$item["img_address"]}}" alt="">
                                    </span>
                                    @endif
                                </a>
                                @if($loop->last)
                                <input type="hidden" name="favorite_num" value="{{ $item["board_id"] }}" id="favorite_num">
                                @endif
                                @empty
                                <div class="mypage-nodata"> 작성한 게시글이 없습니다.</div>
                            @endforelse
                            </div>
                        </div>
                        <div class="tab-contents2" data-order="2">
                            <div class="community_tag bordergo-hover">
                                @forelse ($comments as $index => $item)
                                    <a href="{{route('board.show', ['board' => $item->board_id])}}">
                                        <div class="mypage-comment-area">
                                            <div class="mypage-comment-boardTitle">{!! Str::limit($item->board_title, 40, '...') !!}</div>
                                            <span class="mypage-comment-categoryName">{{$item->category_name}}</span>
                                        </div>
                                        <div class="mypage-myComment">{{Str::limit($item->comment_content, 75, '...')}}</div>
                                        <div class="mypage-myComment-date">{{$item->created_at}}</div>
                                    </a>
                                @empty
                                    <div class="mypage-nodata"> 작성한 댓글이 없습니다. </div>
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
                    <form class="mypage-hashtag-search-form" id="mypageHastagSearchForm" onsubmit="return false">
                        @csrf
                        <div class="mypage-hashtag-search-div">
                            <input hidden='hidden'>
                            <input type="text" placeholder="해시태그 검색" name="hashsearch" id="hashsearch">
                            <button type="button" class="mypage-hashtag-search" onclick="submitSearchHash(); return false;" id="submitSearchHashBtn">
                                <img src="/img/search.png">
                            </button>
                        </div>
                        <div id="searchHashtag" class="mypage-seach-hashtag">
                        </div>
                    </form>
                    @if(isset($hashtag_search))
                        <input type="hidden" value="{{$hashtag_search}}" id="hashtagSearch">
                    @endif
                    <div id="searchHashResult" class="mypage-hashtag">
                        <div id="noSearchData" style="display: none; grid-column-start:1; grid-column-end: 4; background-color: #e0eaff; width:100%; justify-content: center; align-items: center;">검색결과가 없습니다.</div>
                    </div>
                    <div id="mypageCanGetAllTag" class="mypage-can-get-all-tag">
                        <div class="mypage-can-get-all-tag-msg">
                            <img src="/img/favoritetag.png" alt="">
                            <span>관심태그 추가하기</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="mypage-logout" id="mypageLogoutBtn">
        <a href="{{ route('logout.get') }}">로그아웃</a>
    </div>




</div>


<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="/js/mypage.js"></script>
@endsection