@extends('layout.layout')

@section('title','mypage')
    

@section('main')

<div class="mypage-grid" id="mypageGrid">
    <div class="mypage-content" id="mypageContent">
            <div class="mypage-board-show-btn">내가 쓴 게시글</div>
            <div class="mypage-comment-show-btn">내가 쓴 댓글</div>
        {{-- 게시글 창 --}}
            <div class="mypage-date-today">
                <span class="mypage-board-date">2023-12-12</span>
            </div>
            <div class="mypage-boards-part">
                <div class="mypage-boardbox">
                    <div class="mypage-bord-title">제목입니다.</div>
                    <div class="mypage-bord-detailbox">상세내용입니다.</div>
                </div>
                <div class="mypage-boardbox">
                    <div class="mypage-bord-title">제목입니다.</div>
                    <div class="mypage-bord-detailbox">상세내용입니다.</div>
                </div>
                <div class="mypage-boardbox">
                    <div class="mypage-bord-title">제목입니다.</div>
                    <div class="mypage-bord-detailbox">상세내용입니다.</div>
                </div>
                <div class="mypage-boardbox">
                    <div class="mypage-bord-title">제목입니다.</div>
                    <div class="mypage-bord-detailbox">상세내용입니다.</div>
                </div>
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
        <form action="" class="user-info-modify" >
            <div id="UserInfoModify">
                <label for="profilephoto">
                    <div class="profile-photo-btn" style="background-image: url(/img/camera2.png);">
                    </div>
                </label>
                <input type="file" accept="image/*" style="display: none;" id="profilephoto">
                <br>
                <label for="profilephoto" class="user-info-btn"> 사진 변경 </label>
                <div class="user-info-btn"> 삭제 </div>
                <br>
                <label for="usermodifyname">닉네임 수정</label>
                <div class="user-info-btn-chk"> 닉네임 중복 확인 </div>
                <input type="text" id="usermodifyname">
                <br>
                <label for="usermodifypassword">비밀번호 수정</label>
                <input type="password" id="usermodifypassword">
                <br>
                <label for="usermodifypasswordchk">비밀번호 확인</label>
                <input type="password" id="usermodifypasswordchk">
                <br>
                <br>
                <div class="adress-box">
                    <input class="adress-box-a" type="text" id="sample4_postcode" placeholder="우편번호">
                    <input type="button" onclick="sample4_execDaumPostcode()" value="우편번호 찾기" class="user-info-btn"><br>
                    <span id="guide" style="color:#999;display:none"></span>
                    <input class="adress-box-b" type="text" id="sample4_roadAddress" placeholder="도로명주소" name="user_adress_f">
                    <br>
                    <input class="adress-box-b" type="text" id="sample4_detailAddress" placeholder="상세주소" name="user_adress_s">
                </div>
                <div class="mypage-btn-line-modify">
                    <button type="submit" class="mypage-btn">수정완료</button>
                    <a href="{{route('mypage')}}"><div class="mypage-btn">취소</div></a>
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

        <div class="mypage-tag-title">
            <div class="mypage-hashtag-title">
                <img src="/img/star.png" alt="">
                내가 찜한 관심 태그
            </div>
            <div class="mypage-hashtag">
                <span>#자유게시판</span>
                <span>#복통</span>
                <span>#두통</span>
                <span>#꾀병</span>
                <span>#자유</span>
                <span>#퇴근</span>
            </div>
            <div class="favorite-tag-plus">
                관심태그 추가하기
            </div>
        </div>
    </div>
</div>






{{--  display 모달창 --}}
<div class="UserboardModal" id="UserboardModal">
    <div>
        <div class="mypage-content-modal" id="mypageContentModal">
        
            <div class="mypage-board-modal-btn">내가 쓴 게시글</div>
            <div class="mypage-comment-modal-btn">내가 쓴 댓글</div>

            <div onclick="mypagemodalclosebtn(); return false;" class="mypage-modal-close-btn">x</div>
        {{-- 게시글 창 --}}
            <div class="mypage-date-today">
                <span class="mypage-board-date-modal">2023-12-12</span>
            </div>
            <div class="mypage-boards-part2">
                <div class="mypage-boardbox-modal">
                    <div class="mypage-bord-title">제목입니다.</div>
                    <div class="mypage-bord-detailbox">상세내용입니다.</div>
                </div>
                <div class="mypage-boardbox-modal">
                    <div class="mypage-bord-title">제목입니다.</div>
                    <div class="mypage-bord-detailbox">상세내용입니다.</div>
                </div>
                <div class="mypage-boardbox-modal">
                    <div class="mypage-bord-title">제목입니다.</div>
                    <div class="mypage-bord-detailbox">상세내용입니다.</div>
                </div>
                <div class="mypage-boardbox-modal">
                    <div class="mypage-bord-title">제목입니다.</div>
                    <div class="mypage-bord-detailbox">상세내용입니다.</div>
                </div>
            </div>
        
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
            </div>
        
            <div class="mypage-btn-plus">더보기</div>
            {{-- 게시글 insert로 넘어감 --}}
            <a href="{{route('insert')}}">
                <img src="/img/plusbtn.png" alt="" class="mypage-insert-btn">
            </a>
        </div>
    </div>
</div>

<script src="/js/mypage.js"></script>
<script src="/js/main.js"></script>
@endsection