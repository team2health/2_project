@extends('layout.layout')

@section('title','timeline')
    

@section('main')
<div class="timelinemain">
    <div class="mypage-first">
        <div class="calendarBtn" id="calendarBtn" onclick="calendarshow(); return false;"></div>
        <div class="maincalendar calendarNone" id="calendarOpen">
            <table class="Calendar">
                <thead>
                    <tr>
                        <td onclick="prevCalendar(); return false;" style="cursor:pointer;">&#60;</td>
                        <td colspan="5">
                            <span id="calYear"></span>년
                            <span id="calMonth"></span>월
                        </td>
                        <td onclick="nextCalendar(); return false;" style="cursor:pointer;">&#62;</td>
                    </tr>
                    <tr>
                        <td>일</td>
                        <td>월</td>
                        <td>화</td>
                        <td>수</td>
                        <td>목</td>
                        <td>금</td>
                        <td>토</td>
                    </tr>
                </thead>

                <tbody>
                </tbody>
            </table>
        </div>
        <br>
        
    </div>

    <div class="mypage-second" id="mypageSecond">
        
    </div>

    <div class="mypage-third">
        <div class="recordsection" id="recordDeleteTest">
            <img src="/img/circle.png" class="recordcircleimg" alt="">
            <div class="user-record">
                <span class="recordtime">3:10</span>
                <div class="recorddeletebtn" onclick="recorddeletemodalopen(); return false;">X</div>
                <br>
                <span class="recordtext">#인후통</span>
            </div>
        </div>
        <div class="recordsection">
            <img src="/img/circle.png" class="recordcircleimg" alt="">
            <div class="user-record">
                <span class="recordtime">3:10</span>
                <div class="recorddeletebtn" onclick="recorddeletemodalopen(); return false;">X</div>
                <br>
                <span class="recordtext">#인후통</span>
            </div>
        </div>
        <div class="recordsection">
            <img src="/img/circle.png" class="recordcircleimg" alt="">
            <div class="user-record">
                <span class="recordtime">3:10</span>
                <div class="recorddeletebtn" onclick="recorddeletemodalopen(); return false;">X</div>
                <br>
                <span class="recordtext">#인후통</span>
            </div>
        </div>
    </div>

    <div class="mypage-fourth" id="mypageFourth">
        <div id="recordDeleteModal">
            <div class="mypage-delete-modal">
                <div class="delete-message">
                삭제하시겠습니까?
                </div>
                <div>
                    <div class="record-delete-cancel" onclick="deletemodalclose(); return false;">취소</div>
                    <div class="record-delete-ok" onclick="recorddeletebtn(); return false;">확인</div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="/js/mypage.js"></script>

@endsection