@extends('layout.layout')

@section('title','Detail')

@section('main')

<main class="last_main">
	<div class="detail_container">               
        <div class="detail-board-created">
            {{$data->created_at}}
        </div>
        <p class="detail_board_hits">조회수 : {{$data->board_hits}}</p>
        @if(Auth::id() !== $data->user->id)
<button type="button" class="detail_comment-btn" onclick="openModal()"><img src="/img/singo.png" style="width: 30px; height: 30px; alt=""></button>
    <div id="myModal" class="modal">
        <div class="comment_modal_content">            
            <p><input type="radio" name="options" value="option1">                                        
            욕설</p> 
            <p><input type="radio" name="options" value="option2">                                        
            사기</p> 
            <p><input type="radio" name="options" value="option3">                                        
            허위사실 유포</p>                                             
            <!-- <input type="radio" name="options" value="option4">
            <label></label> -->   
            <button type="button">신고</button> 
            <span class="close" onclick="closeModal()">취소</span>                                    
        </div>
    </div>
    @endif
        <div class="last_user">
            <div class="last-board-title">    
                <p>{{ $data->board_title }}</p>
            </div>
            {{-- <div class="last-board-detail"> --}}
                <img class="community_icon" src="{{ asset('user_img/' . optional($data->user)->user_img) }}" alt="">                                  
                <div class="board_nic_text">
                    <div class="detail-board-name">
                    {{ optional($data->user)->user_name }}
                    </div>
                    
                </div>
            {{-- </div> --}}
            <div class="detail_content">
                @foreach($data->images as $image)
                <div class="detail_board_content">
                    <img src="/board_img/{{ $image->img_address }}" alt="Board Image">
                </div>    
                @endforeach          
                <br>
                <div>
                    {!! $data->board_content !!}          
                </div>                
            </div>
        </div>          
        <div class="detail-hashtag">
            @foreach($data->hashtags as $hashtag)
                <span>{{ $hashtag->hashtag_name }}</span>
            @endforeach
        </div>     
    </div>
    <div class="detail_bottom_button">
        <form class="detail_form-flex" action="{{ route('board.destroy', ['board' => $data->board_id]) }}" method="POST" id="deleteForm" onsubmit="return confirm('정말로 삭제하시겠습니까?');">
            @csrf
            @method('DELETE')
            @if(Auth::id() === $data->user->id)
                <a href="{{ route('categoryboard') }}" class="a_cancel">목록</a>
                <a href="{{ route('board.edit', ['board' => $data->board_id]) }}" class="a_update">수정</a>
                <button type="submit" class="d_btn">삭제</button>
            @else
                <a href="{{ route('categoryboard') }}" class="a_cancel">목록</a>
            @endif         
        </form>
    </div>

    <div class="detail_comment">
        <div class="comment_bottom">
        <p>댓글 <span style="color:#e86507; font-weight:900;">{{ count($data->comments ?? []) }}</span>개</p>
        </div>
        <ul>
        @foreach($data->comments ?? [] as $comment)
            <li>
                <div class="last_user">                
                    <img class="community_icon_comment " src="{{ asset('user_img/' . optional($comment->user)->user_img) }}" class="board_nic_img" alt="">                    
                    <div class="board_nic_text">
                        <div class="board_nic_text_a">
                            {{ optional($comment->user)->user_name }}
                        </div>
                        <div class="detail-comments-flex">
                            <span>{{ $comment->created_at }}</span>
                            <form style="display: inline-block"
                            method="POST" action="{{ route('comments.destroy', $comment->comment_id) }}" onsubmit="return confirm('정말로 삭제하시겠습니까?');">
                                @csrf
                                @method('DELETE')
                                @if(Auth::id() === $comment->u_id)
                                <button type="submit" class="delete-comment-btn">X</button>
                                @else
                                <button type="button" class="detail_comment-btn" onclick="openModal()"><img src="/img/singo.png" style="width: 30px; height: 30px; alt=""></button>
                                <div id="myModal" class="modal">
                                    <div class="comment_modal_content">
                                        <span class="close" onclick="closeModal()">&times;</span>
                                       <p><input type="radio" name="options" value="option1">                                        
                                        욕설</p> 
                                        <p><input type="radio" name="options" value="option2">                                        
                                        사기</p> 
                                        <p><input type="radio" name="options" value="option3">                                        
                                        허위사실 유포</p>                                             
                                        <!-- <input type="radio" name="options" value="option4">
                                        <label></label> -->   
                                        <button type="button">신고</button> 
                                        <span class="close" onclick="closeModal()">취소</span>                                    
                                    </div>
                                </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="detail-comment-area">
                    <p>{{ $comment->comment_content }}</p>
                </div>
            </li>
        @endforeach
        </ul>           
        <div class="detail_comment_insert">
            <form action="{{ route('comments', ['boardId' => $data->board_id]) }}" method="post" id="commentForm">
                @csrf
                <input type="hidden" name="board_id" value="{{ $data->board_id }}">
                <textarea name="comment_content" id="comment_content" class="comment_content"></textarea>
                <button type="submit" class="detail_comment_insert_complete">입력</button>
            </form>

        </div>
</main>
<script src="/js/detail.js"></script>

@endsection