
@extends('layout.layout');

@section('title','timeline');
    

@section('main')
<div class="mypage-first">
    <div class="calendarBtn" onclick="calendarshow(); return false;">2023</div>
    <div class="maincalendar calendarNone" id="calendarOpen">
        <table class="Calendar">
            <thead>
                <tr>
                    <td onClick="prevCalendar();" style="cursor:pointer;">&#60;</td>
                    <td colspan="5">
                        <span id="calYear"></span>년
                        <span id="calMonth"></span>월
                    </td>
                    <td onClick="nextCalendar();" style="cursor:pointer;">&#62;</td>
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
    <div class="mypage-second">
        <div class="week-day1">월</div>
        <div class="week-day2">화</div>
        <div class="week-day3">수</div>
        <div class="week-day4">목</div>
        <div class="week-day5">금</div>
        <div class="week-day6">토</div>
        <div class="week-day7">일</div>
    </div>

    <script src="/js/mypage.js"></script>
    <script src="/js/mypage.js"></script>
</div>

@endsection