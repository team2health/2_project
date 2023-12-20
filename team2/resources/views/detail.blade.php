@extends('layout.layout')

@section('title','Detail')

@section('main')

<main class="last_main">
    
	
	<div class="detail_container">		
        <div class="detail_hidden_container">
            <div class="last_user">
                <img class="community_icon"  src="../img/default_f.png" alt="" class="board_nic_img">                               
                <div class="board_nic_text">
                    <div>
                    {{ optional($data->user)->user_name }}
                    </div>
                    <div>
                        {{$data->created_at}}
                    </div>
                </div>
            </div> 
            <div>           
                <p>{{ $data->board_title }}</p>
            </div>         
            <div class="detail_content">
            @foreach($data->images as $image)
            <img src="{{ asset('storage/img/' . $image->img_address) }}" alt="Board Image">
            @endforeach           
                <br>
                <div>
                {{ $data->board_content }}
                </div>                
            </div>
            <div>                
                <div>
                {{ $data->hashtag_id }}
                </div>
            </div>
        </div>
    </div>
    <!-- <div id="confirmModal" class="modal">
        <div class="modal-content">
            <p>삭제하시겠습니까?</p>
            <button id="confirmDelete">확인</button>
            <button id="cancelDelete">취소</button>
        </div>
    </div> -->
    <div class="detail_bottom_button">
        <form class="detail_form" action="{{ route('board.destroy', ['board' => $data->board_id]) }}" method="POST" id="deleteForm" onsubmit="return confirm('정말로 삭제하시겠습니까?');">
            @csrf
            @method('DELETE')
            <a href="{{ route('categoryboard') }}" class="a_cancel">목록</a>
            <a href="{{ route('board.edit', ['board' => $data->board_id]) }}" class="a_update">수정</a>
            <button type="submit" class="d_btn">삭제</button>            
        </form>
    </div>
   
    <div class="detail_comment">
        <div class="comment_bottom">
        <p>댓글{{ count($data->comments ?? []) }}개</p>
        </div>
        <ul>
        @foreach($data->comments ?? [] as $comment)
            <li>
                <div class="last_user">
                    <img class="community_icon" src="../img/default_f.png" alt="" class="board_nic_img">
                    <div class="board_nic_text">
                        <div>
                            {{ optional($comment->user)->user_name }}
                        </div>
                        <div>
                            {{ $comment->created_at }}
                        </div>
                    </div>
                </div>
                <div>
                    <p>{{ $comment->comment_content }}</p>
                </div>
                <form method="POST" action="{{ route('comments.destroy', $comment->comment_id) }}" onsubmit="return confirm('정말로 삭제하시겠습니까?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-comment-btn">댓글 삭제</button>
                </form>
            </li>
        @endforeach
        </ul>           
        <div class="detail_comment_insert">
        <form action="{{ route('comments', ['boardId' => $data->board_id]) }}" method="post" id="commentForm">
            @csrf
            <input type="hidden" name="board_id" value="{{ $data->board_id }}">
            <textarea name="comment_content" id="comment_content"></textarea>
            <button type="submit" class="detail_comment_insert_complete">입력</button>
        </form>

        </div>
</main>
<script src="/js/detail.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection