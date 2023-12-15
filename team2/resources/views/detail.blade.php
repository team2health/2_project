@extends('layout.layout')

@section('title','Detail')

@section('main')

<main class="last_main">
    
	
	<div class="detail_container">		
        <div class="detail_hidden_container">
            <div>           
                <p>{{ $data->board_title }}</p>
            </div>         
            <div class="last_user">
                <img class="community_icon"  src="../img/default_f.png" alt="" class="board_nic_img">                               
                <div class="board_nic_text">
                    <div>
                    {{ $data->user_name }}
                    </div>
                    <div>
                        {{$data->created_at}}
                    </div>
                </div>
            </div> 
            <div class="detail_content">
            @foreach($data->images as $image)
                <img src="{{ $image->img_address }}" alt="Board Image">
            
            @endforeach
                <br>
                <div>
                {{ $data->board_content }}
                </div>                
            </div>
            <div>                
                <div>
                #해시태그
                </div>
            </div>
        </div>
    </div>
    <div class="detail_bottom_button">
        <form class="detail_form" action="" method = "POST">
            @csrf
            @method('DELETE')
            <button class="d_btn"><a class="a_cancel" href="{{route('categoryboard')}}">목록</a></button>	
            <button class="d_btn"><a href="{{route('board.edit',['board'=>$data->board_id])}}" class="a_update ">수정</a></button>
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
                    <img class="community_icon"  src="../img/default_f.png" alt="" class="board_nic_img">                               
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
                    <img class="community_icon"  src="../img/default_f.png" alt="" class="board_nic_img">                               
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