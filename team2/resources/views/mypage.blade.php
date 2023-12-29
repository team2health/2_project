@extends('layout.layout')

@section('title','mypage')
    

@section('main')


<div class="mypage-grid" id="mypageGrid">
    <div class="mypage-content" id="mypageContent">
        
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
                        {{-- 게시글 창 --}}
            <div class="mypage-boards-part">
                @forelse ($data as $index => $item)
                    @php
                    if( $index >= 1 ) {
                        $previous_item = $index - 1;
                        $present_item = $index - 0;
                    }
                    @endphp
                    @if ( $index >= 1)
                        @if ($data[$present_item]->created_at != $data[$previous_item]->created_at)
                        <div class="mypage-date-today">
                            <span class="mypage-board-date">{{$item->created_at}}</span>
                        </div>
                        <a href="{{route('board.show', ['board' => $item->board_id])}}">
                            <div class="mypage-boardbox">
                                <div class="mypage-bord-title">{{Str::limit($item->board_title, 30, '...')}}</div>
                                <div class="mypage-bord-detailbox">{!! Str::limit($item->board_content, 75, '...') !!}</div>
                            </div>
                        </a>
                        @else
                        <a href="{{route('board.show', ['board' => $item->board_id])}}">
                            <div class="mypage-boardbox">
                                <div class="mypage-bord-title">{{Str::limit($item->board_title, 30, '...')}}</div>
                                <div class="mypage-bord-detailbox">{!! Str::limit($item->board_content, 75, '...') !!}</div>
                            </div>
                        </a>
                        @endif
                    @else
                    <div class="mypage-date-today">
                        <span class="mypage-board-date">{{$item->created_at}}</span>
                    </div>
                    <a href="{{route('board.show', ['board' => $item->board_id])}}">
                        <div class="mypage-boardbox">
                            <div class="mypage-bord-title">{{Str::limit($item->board_title, 30, '...')}}</div>
                            <div class="mypage-bord-detailbox">{!! Str::limit($item->board_content, 75, '...') !!}</div>
                        </div>
                    </a>
                    @endif
                @empty
                    <div> 작성한 게시글이 없습니다. </div>
                @endforelse
            </div>
            </div>
            <div class="tab-contents" data-order="2">
                
                {{-- <div class="mypage-date-today">
                    <span class="mypage-board-date"></span>
                </div>
                <div class="mypage-boards-part">
                    <div class="mypage-boardbox">
                        <span class="mypage-boardbox-date">2023-12-12</span>
                        <div class="mypage-bord-title"> 댓글 view 제목입니다.</div>
                        <div class="mypage-bord-detailbox">상세내용입니다.</div>
                    </div>
                </div> --}}

                <div class="mypage-boards-part">
                    @forelse ($comments as $index => $item)
                        <a href="{{route('board.show', ['board' => $item->board_id])}}">
                            <div class="mypage-boardbox">
                                <span class="mypage-boardbox-date">{{$item->created_at}}</span>
                                <div class="mypage-bord-title">{{Str::limit($item->board_title, 30, '...')}}</div>
                                <div class="mypage-bord-detailbox">{{Str::limit($item->comment_content, 75, '...')}}</div>
                            </div>
                        </a>
                    @empty
                        <div> 작성한 댓글이 없습니다. </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="mypage-btn-plus">더보기</div>
        {{-- 게시글 insert로 넘어감 --}}
        {{-- <a href="{{route('insert')}}">
            <img src="/img/plusbtn.png" alt="" class="mypage-insert-btn">
        </a> --}}
    </div>

    {{-- 정보수정창 --}}
    <div class="mypage-content2" id="mypageContent2">
        <form action="/userinfoupdate" class="user-info-modify" method="POST" id="userinfo_form" enctype="multipart/form-data">
            @csrf
            <div id="UserInfoModify" class="User-info-modify">
                <label for="profilephoto">
                    <div id="profilephotoview" class="profile-photo-btn" style="background-image: url(/user_img/{{$user_info[0]->user_img}});"></div>
                    <span id="user_img_name"></span>
                </label>
                <input type="file" accept="image/*" style="display: none;" id="profilephoto" name="user_img">
                <span id="user-img-url"></span>
                {{-- <a href="#">비밀번호 변경</a> --}}
                <br>
                <label for="profilephoto" class="user-info-btn"> 사진 변경 </label>
                <div class="user-info-btn" id="user-info-img-remove" onclick="userimgremove(); return false;"> 삭제 </div>
                <input type="hidden" name="imgFlg" id="imgflg">
                <br>
                <label for="usermodifyname">닉네임 수정</label>
                <span class="user-info-btn-chk" onclick="nameChange(); return false;" id="name-info-btn"> 닉네임 중복 확인 </span>
                <input type="text" id="usermodifyname" name="user_name" value="{{$user_info[0]->user_name}}">
                {{-- <br>
                <label for="usermodifypassword">비밀번호 수정</label>
                <input type="password" id="usermodifypassword">
                <br>
                <label for="usermodifypasswordchk">비밀번호 확인</label>
                <input type="password" id="usermodifypasswordchk"> --}}
                <label>현재 주소지</label>
                <div class="user-now-address">{{$user_info[0]->user_address}} {{$user_info[0]->user_address_detail}}</div>
                <label>주소 변경</label>
                <div class="adress-box">
                    <input class="adress-box-a" type="text" id="sample4_postcode" placeholder="우편번호" name="user_address_num" readonly>
                    <input type="button" onclick="sample4_execDaumPostcode()" value="우편번호 찾기" class="user-info-btn"><br>
                    <span id="guide" style="color:#999;display:none"></span>
                    <input class="adress-box-b" type="text" id="sample4_roadAddress" name="user_address" placeholder="도로명주소" readonly>
                    <br>
                    <input class="adress-box-b" type="text" id="sample4_detailAddress" name="user_address_detail" placeholder="상세주소">
                </div>
                <div class="mypage-btn-line-modify">
                    <button type="button" class="mypage-btn mpb-modify" onclick="userinfoupdate(); return false;">수정완료</button>
                    {{-- <a href="{{route('mypage.get')}}"><div class="mypage-btn">취소</div></a> --}}
                </div>
            </div>
        </form>
    </div>

    <div class="mypage-mainbar">
        <div class="mypage-btn-layout">
            <div class="mypage-btn-line2">
                <div class="mypage-btn" onclick="userinforupdate(); return false;">정보수정</div>
                <a href="{{route('todaytimeline.get')}}"><div class="mypage-btn">타임라인</div></a>
            </div>
            <div class="mypage-btn2" onclick="userboardshow(); return false;">나의 게시물</div>
        </div>

        <div class="mypage-tag-title" id="mypageTagTitle">
            <div class="mypage-tag-title2" id="mypageTagTitle2">
                <div class="mypage-hashtag-title">
                    <input type="hidden" value="0" id="favoriteFlg">
                    <img src="/img/star.png" alt="">
                    내가 찜한 관심 태그
                </div>
                <div class="mypage-hashtag" id="mypageHashtag">
                @forelse ($user_hashtag as $item)
                    <div id="favoriteHashtagId{{$item->favorite_tag_id}}">
                        <span id="favoritehashtext{{$item->favorite_tag_id}}" value="{{$item->favorite_tag_id}}">{{$item->hashtag_name}}</span>
                        <span onclick="favoritehashdelete({{$item->favorite_tag_id}}); return false;">x</span>
                    </div>
                @empty
                    <span id="noticeThatFavoriteNone" class="notice-that-favorite-none"> 관심태그로 등록한 해시태그가 없습니다.</span>
                @endforelse
                </div>
                <div class="favorite-tag-plus" id="addallfavoritetag">
                    {{-- 관심태그 추가하기 --}}
                </div>
            </div>
        </div>
    </div>
</div>






{{--  display 모달창 --}}
<div class="UserboardModal" id="UserboardModal">
        <div class="mypage-content-modal" id="mypageContentModal">
            <div onclick="mypagemodalclosebtn(); return false;" class="mypage-modal-close-btn">x</div>
            {{-- <div class="modal-board-show-btn">
                <div class="mypage-board-modal-btn">내가 쓴 게시글</div>
                <div class="mypage-comment-modal-btn">내가 쓴 댓글</div>
            </div> --}}
            {{-- <div class="mypage-boards-part">
                @forelse ($data as $index => $item)
                    @php
                    $previous_item = $index - 1;
                    $present_item = $index - 0;
                    @endphp
                    @if ( $index >= 1)
                        @if ($data[$present_item]->created_at != $data[$previous_item]->created_at)
                        <div class="mypage-date-today">
                            <span class="mypage-board-date">{{$item->created_at}}</span>
                        </div>
                        <a href="{{route('board.show', ['board' => $item->board_id])}}">
                            <div class="mypage-boardbox-modal">
                                <div class="mypage-bord-title">{{$item->board_title}}</div>
                                <div class="mypage-bord-detailbox">{{$item->board_content}}</div>
                            </div>
                        </a>
                        @else
                        <a href="{{route('board.show', ['board' => $item->board_id])}}">
                            <div class="mypage-boardbox-modal">
                                <div class="mypage-bord-title">{{$item->board_title}}</div>
                                <div class="mypage-bord-detailbox">{{$item->board_content}}</div>
                            </div>
                        </a>
                        @endif
                    @else
                    <div class="mypage-date-today">
                        <span class="mypage-board-date">{{$item->created_at}}</span>
                    </div>
                    <a href="{{route('board.show', ['board' => $item->board_id])}}">
                        <div class="mypage-boardbox-modal">
                            <div class="mypage-bord-title">{{$item->board_title}}</div>
                            <div class="mypage-bord-detailbox">{{$item->board_content}}</div>
                        </div>
                    </a>
                    @endif
                @empty
                    <div> 작성한 게시글이 없습니다. </div>
                @endforelse
            </div> --}}
            <div class="tab-modal">
                <ul class="tab_list">
                    <li class="mypage-board-modal-btn tab-active" data-list="3">
                        내가 쓴 게시글
                    </li>
                    <li class="mypage-board-modal-btn" data-list="4">
                        내가 쓴 댓글
                    </li>
                </ul>
                <div class="tab-contents-modal tab-show-modal" data-order="3">
                    {{-- 게시글 창 --}}
                    <div class="mypage-boards-part">
                        @forelse ($data as $index => $item)
                            @php
                            if( $index >= 1 ) {
                                $previous_item = $index - 1;
                                $present_item = $index - 0;
                            }
                            @endphp
                            @if ( $index >= 1)
                                @if ($data[$present_item]->created_at != $data[$previous_item]->created_at)
                                <div class="mypage-date-today-modal">
                                    <span class="mypage-board-date-modal">{{$item->created_at}}</span>
                                </div>
                                <a href="{{route('board.show', ['board' => $item->board_id])}}">
                                    <div class="mypage-boardbox-modal">
                                        <div class="mypage-bord-title">{{Str::limit($item->board_title, 30, '...')}}</div>
                                        <div class="mypage-bord-detailbox">{{Str::limit($item->board_content, 75, '...')}}</div>
                                    </div>
                                </a>
                                @else
                                <a href="{{route('board.show', ['board' => $item->board_id])}}">
                                    <div class="mypage-boardbox-modal">
                                        <div class="mypage-bord-title">{{Str::limit($item->board_title, 30, '...')}}</div>
                                        <div class="mypage-bord-detailbox">{{Str::limit($item->board_content, 75, '...')}}</div>
                                    </div>
                                </a>
                                @endif
                            @else
                            <div class="mypage-date-today-modal">
                                <span class="mypage-board-date">{{$item->created_at}}</span>
                            </div>
                            <a href="{{route('board.show', ['board' => $item->board_id])}}">
                                <div class="mypage-boardbox-modal">
                                    <div class="mypage-bord-title">{{Str::limit($item->board_title, 30, '...')}}</div>
                                    <div class="mypage-bord-detailbox">{{Str::limit($item->board_content, 75, '...')}}</div>
                                </div>
                            </a>
                            @endif
                        @empty
                            <div> 작성한 게시글이 없습니다. </div>
                        @endforelse
                    </div>
                </div>

                <div class="tab-contents-modal" data-order="4">
                    <div class="mypage-boards-part">
                        @forelse ($comments as $index => $item)
                            <a href="{{route('board.show', ['board' => $item->board_id])}}">
                                <div class="mypage-boardbox-modal">
                                    <span class="mypage-boardbox-date">{{$item->created_at}}</span>
                                    <div class="mypage-bord-title">{{Str::limit($item->board_title, 30, '...')}}</div>
                                    <div class="mypage-bord-detailbox">{{Str::limit($item->comment_content, 75, '...')}}</div>
                                </div>
                            </a>
                        @empty
                            <div> 작성한 댓글이 없습니다. </div>
                        @endforelse
                    </div>
                </div>
            </div>
        
            <div class="mypage-btn-plus">더보기</div>
            {{-- 게시글 insert로 넘어감 --}}
            {{-- <a href="{{route('insert')}}">
                <img src="/img/plusbtn.png" alt="" class="mypage-insert-btn">
            </a> --}}
        </div>
</div>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="/js/mypage.js"></script>
@endsection