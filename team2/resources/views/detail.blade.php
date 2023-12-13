@extends('layout.layout')

@section('title','Detail')

@section('main')

<main class="last_main">
    
	
	<div class="detail_container">		
        <div class="detail_hidden_container">
            <div>           
                <p>제모기다</p>
            </div>         
            <div class="last_user">
                <img src="../img/f-img.png" alt="" class="board_nic_img">                               
                <div class="board_nic_text">
                    <div>
                        내가누군지물어보신다면대답해주는것이인지상정
                    </div>
                    <div>
                        2023-12-12 15:59:59
                    </div>
                </div>
            </div> 
            <div class="detail_content">
                <img src="../img/필요한거 있나.jpg" alt="">
                <div>
                내용
                </div>                
            </div>
            <div>
                
                <div>
                    #기침 #두통
                </div>
            </div>
        </div>
    </div>
    <div class="detail_bottom_button">
        <form action="" method = "POST">
            @csrf
            @method('DELETE')
            <button class="d_btn"><a class="a_cancel" href="{{url()->previous()}}">목록</a></button>	
            <button class="d_btn"><a href="" class="a-update ">수정</a></button>
            <button type="submit" class="d_btn">삭제</button>
        </form>
    </div>
    <div class="detail_comment">
        <div class="comment_bottom">
            <p>댓글2개</p>
        </div>
        <ul>
            <li>
                <div class="last_user">
                    <img src="../img/f-img.png" alt="" class="board_nic_img">                               
                    <div class="board_nic_text">
                        <div>
                            세모
                        </div>
                        <div>
                            2023-12-12
                        </div>
                    </div>
                </div>
                <div>
                    <p>ㅋㅋㅋㅎㅎㅎㅋㅋㅋㅎㅎㅎㅋㅋㅋㅎㅎㅎㅋㅋㅋㅎㅎㅎㅋㅋㅋㅎㅎㅎㅋㅋㅋㅎㅎㅎㅋㅋㅋㅎㅎㅎㅋㅋㅋㅎㅎㅎ</p>
                    
                </div> 
            </li>
            <li>
                <div class="last_user">
                    <img src="../img/f-img.png" alt="" class="board_nic_img">                               
                    <div class="board_nic_text">
                        <div>
                            네모
                        </div>
                        <div>
                        2023-12-12
                        </div>
                    </div>
                </div> 
                <p>ㅋㅋㅋㅎㅎㅎ</p> 
            </li>
        </ul>
    </div>
    <div class="detail_comment_insert">
        <textarea name="comment" id="comment"></textarea>
        <button type="submit"class="detail_comment_insert_complete">입력</button>
    </div>
</main>

@endsection