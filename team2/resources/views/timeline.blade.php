@extends('layout.layout')

@section('title','timeline')
    

@section('main')

<div class="timelinemain wrapper" id="timelineMain">
    @guest
    <div class="block-mypage">로그인 후 이용가능합니다.</div>
    @endguest
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
        <div class="mypage-second-margin" id="mypageSecondMargin">

        </div>
    </div>
        
    <div class="mypage-third">
        <div class="recordsection" id="recordDeleteTest">
            <input type="hidden" value="{{$result_count}}" id="recordTurn">
            @forelse ($data as $item)
                {{-- <input type="hidden" value="{{$item->created_at}}" id="recordCreatedAt"> --}}
                <img src="/img/circle.png" class="record-circle-img" id="recordCircleImg{{$item->record_id}}">
                <div class="user-record" id="userRecord{{$item->record_id}}">
                    <span class="record-time">{{$item->created_date}}</span>
                    <div class="record-delete-btn" onclick="recorddeletemodalopen({{$item->record_id}}); return false;">X</div>
                    <br>
                    <span class="recordtext">{{$item->part_name}} - {{$item->symptom_name}} </span>
                </div>
            @empty
                {{-- <div class="none-recordtext"> 오늘은 검색기록이 없어요!</div> --}}
            @endforelse
            <div class="none-recordtext notice-no-data" id="noticeNoData"> 오늘은 검색기록이 없어요!</div>
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
<br><br><br><br><br>
<script src="/js/timeline.js" async></script>
@endsection