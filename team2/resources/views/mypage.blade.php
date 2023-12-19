@extends('layout.layout')

@section('title','mypage')
    

@section('main')

<div class="mypage-grid" id="mypageGrid">
    <div class="mypage-content" id="mypageContent">
            <div class="mypage-board-show-btn">내가 쓴 게시글</div>
            <div class="mypage-comment-show-btn">내가 쓴 댓글</div>
        {{-- 게시글 창 --}}
            <div class="mypage-boards-part">
                @forelse ($data as $index => $item)
                    @php
                    $previous_item = $index - 1;
                    $present_item = $index - 0;
                    // $board_date = $data[$present_item]->created_at;
                    // $timestamp = strtotime($board_date);
                    // $create_date = date('y-m-d', $timestamp);
                    @endphp
                    @if ( $index >= 1)
                        @if ($data[$present_item]->created_at != $data[$previous_item]->created_at)
                        <div class="mypage-date-today">
                            <span class="mypage-board-date">{{$item->created_at}}</span>
                        </div>
                        <a href="{{route('board.show', ['board' => $item->board_id])}}">
                            <div class="mypage-boardbox">
                                <div class="mypage-bord-title">{{$item->board_title}}</div>
                                <div class="mypage-bord-detailbox">{{$item->board_content}}</div>
                            </div>
                        </a>
                        @else
                        <a href="{{route('board.show', ['board' => $item->board_id])}}">
                            <div class="mypage-boardbox">
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
                        <div class="mypage-boardbox">
                            <div class="mypage-bord-title">{{$item->board_title}}</div>
                            <div class="mypage-bord-detailbox">{{$item->board_content}}</div>
                        </div>
                    </a>
                    @endif
                @empty
                    <div> 작성한 게시글이 없습니다. </div>
                @endforelse
            </div>

            <div class="mypage-date-today">
                <span class="mypage-board-date"></span>
            </div>
            <div class="mypage-boards-part">
                <div class="mypage-boardbox">
                    <span class="mypage-boardbox-date">2023-12-12</span>
                    <div class="mypage-bord-title"> 댓글 view 제목입니다.</div>
                    <div class="mypage-bord-detailbox">상세내용입니다.</div>
                </div>
                <div class="mypage-boardbox">
                    <span class="mypage-boardbox-date">2023-12-12</span>
                    <div class="mypage-bord-title">제목입니다.</div>
                    <div class="mypage-bord-detailbox">상세내용입니다.</div>
                </div>
                <div class="mypage-boardbox">
                    <span class="mypage-boardbox-date">2023-12-12</span>
                    <div class="mypage-bord-title">제목입니다.</div>
                    <div class="mypage-bord-detailbox">상세내용입니다.</div>
                </div>
                <div class="mypage-boardbox">
                    <span class="mypage-boardbox-date">2023-12-12</span>
                    <div class="mypage-bord-title">제목입니다.</div>
                    <div class="mypage-bord-detailbox">상세내용입니다.</div>
                </div>
            </div>
        <div class="mypage-btn-plus">더보기</div>
        {{-- 게시글 insert로 넘어감 --}}
        <a href="{{route('insert')}}">
            <img src="/img/plusbtn.png" alt="" class="mypage-insert-btn">
        </a>
    </div>

    {{-- 정보수정창 --}}
    <div class="mypage-content2" id="mypageContent2">
        <form action="/userinfoupdate" class="user-info-modify" method="POST" id="userinfo_form" enctype="multipart/form-data">
            @csrf
            <div id="UserInfoModify">
                <label for="profilephoto">
                    <div class="profile-photo-btn" style="background-image: url(/img/camera2.png);">
                    </div>
                </label>
                <input type="file" accept="image/*" style="display: none;" id="profilephoto" name="user_img">
                {{-- <a href="#">비밀번호 변경</a> --}}
                <br>
                <label for="profilephoto" class="user-info-btn"> 사진 변경 </label>
                <div class="user-info-btn"> 삭제 </div>
                <br>
                <label for="usermodifyname">닉네임 수정</label>
                <div class="user-info-btn-chk" onclick="nameChange(); return false;"> 닉네임 중복 확인 </div>
                <input type="text" id="usermodifyname" name="user_name">
                {{-- <br>
                <label for="usermodifypassword">비밀번호 수정</label>
                <input type="password" id="usermodifypassword">
                <br>
                <label for="usermodifypasswordchk">비밀번호 확인</label>
                <input type="password" id="usermodifypasswordchk"> --}}
                <br>
                <br>
                <div class="adress-box">
                    <input class="adress-box-a" type="text" id="sample4_postcode" placeholder="우편번호" readonly>
                    <input type="button" onclick="sample4_execDaumPostcode()" value="우편번호 찾기" class="user-info-btn"><br>
                    <span id="guide" style="color:#999;display:none"></span>
                    <input class="adress-box-b" type="text" id="sample4_roadAddress" placeholder="도로명주소" readonly>
                    <br>
                    <input class="adress-box-b" type="text" id="sample4_detailAddress" placeholder="상세주소">
                    <input type="hidden" id="adress-fullname" name="user_address">
                </div>
                <div class="mypage-btn-line-modify">
                    <button type="button" class="mypage-btn" onclick="userinfoupdate(); return false;">수정완료</button>
                    {{-- <a href="{{route('mypage.get')}}"><div class="mypage-btn">취소</div></a> --}}
                </div>
            </div>
        </form>
    </div>

    <div class="mypage-mainbar">
        <div class="mypage-btn-layout">
            <div class="mypage-btn-line">
                <div class="mypage-btn" onclick="userinforupdate(); return false;">정보수정</div>
                <a href="{{route('timeline')}}"><div class="mypage-btn">타임라인</div></a>
            </div>
            <div class="mypage-btn2" onclick="userboardshow(); return false;">나의 게시물</div>
        </div>

        <div class="mypage-tag-title" id="mypageTagTitle">
            <div class="mypage-hashtag-title">
                <img src="/img/star.png" alt="">
                내가 찜한 관심 태그
            </div>
            <div class="mypage-hashtag" id="mypageHashtag">
            @forelse ($user_hashtag as $item)
                <div id="favoriteHashtagId{{$item->favorite_tag_id}}">
                    <span id="favoritehashtext{{$item->favorite_tag_id}}" value="{{$item->hashtag_name}}">{{$item->hashtag_name}}</span>
                    <span onclick="favoritehashdelete({{$item->favorite_tag_id}}); return false;">x</span>
                </div>
            @empty
                <div> 관심태그로 등록한 해시태그가 없습니다.</div>
            @endforelse
            </div>
            <div class="favorite-tag-plus" id="addallfavoritetag">
                관심태그 추가하기
            </div>

        </div>
    </div>
</div>






{{--  display 모달창 --}}
<div class="UserboardModal" id="UserboardModal">
    <div>
        <div class="mypage-content-modal" id="mypageContentModal">
            <div onclick="mypagemodalclosebtn(); return false;" class="mypage-modal-close-btn">x</div>
            <div class="modal-board-show-btn">
                <div class="mypage-board-modal-btn">내가 쓴 게시글</div>
                <div class="mypage-comment-modal-btn">내가 쓴 댓글</div>
            </div>
            <div class="mypage-boards-part">
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
            </div>
{{-- 
            <div class="mypage-date-today">
                <span class="mypage-board-date"></span>
            </div>
            <div class="mypage-boards-part2">
                <div class="mypage-boardbox">
                    <span class="mypage-boardbox-date">2023-12-12</span>
                    <div class="mypage-bord-title"> 댓글 view 제목입니다.</div>
                    <div class="mypage-bord-detailbox">상세내용입니다.</div>
                </div>
                <div class="mypage-boardbox">
                    <spa class="mypage-boardbox-date">2023-12-12</spa>
                    <div class="mypage-bord-title">제목입니다.</div>
                    <div class="mypage-bord-detailbox">상세내용입니다.</div>
                </div>
                <div class="mypage-boardbox">
                    <span class="mypage-boardbox-date">2023-12-12</span>
                    <div class="mypage-bord-title">제목입니다.</div>
                    <div class="mypage-bord-detailbox">상세내용입니다.</div>
                </div>
                <div class="mypage-boardbox">
                    <span class="mypage-boardbox-date">2023-12-12</span>
                    <div class="mypage-bord-title">제목입니다.</div>
                    <div class="mypage-bord-detailbox">상세내용입니다.</div>
                </div>
            </div> --}}
        
            <div class="mypage-btn-plus">더보기</div>
            {{-- 게시글 insert로 넘어감 --}}
            <a href="{{route('insert')}}">
                <img src="/img/plusbtn.png" alt="" class="mypage-insert-btn">
            </a>
        </div>
    </div>
</div>
<script src="/js/mypage.js"></script>
@endsection