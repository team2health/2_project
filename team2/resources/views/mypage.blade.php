@extends('layout.layout')

@section('title','mypage')
    

@section('main')



<div class="mypage-grid" id="mypageGrid">
    <div class="mypage-content" id="mypageContent">

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

        <div class="mypage-btn-plus">더보기</div>

    </div>

    {{-- 정보수정창 --}}
    <div class="mypage-content2" id="mypageContent2">
        <div class="user-info-modify modify-display" id="UserInfoModify">
            <label for="profilephoto">
                <div class="profile-photo-btn" style="background-image: url(/img/camera2.png);">
                </div>
            </label>
            <input type="file" accept="image/*" style="display: none;" id="profilephoto">
            <label for="profilephoto" class="user-info-btn"> 사진 변경 </label>
            <div class="user-info-btn"> 삭제 </div>

            <label for="usermodifyname">닉네임 수정</label>
            <input type="text" id="usermodifyname">
            <label for="usermodifypassword">비밀번호 수정</label>
            <input type="password" id="usermodifypassword">
            <label for="usermodifypasswordchk">비밀번호 확인</label>
            <input type="password" id="usermodifypasswordchk">
            <label for="usermodifyaddress">주소</label>
            <input type="text" id="usermodifyaddress">
            <label for="usermodifybirth">생년월일</label>
            <input type="text" id="usermodifybirth">
            
        </div>
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


<script src="/js/mypage.js"></script>
@endsection