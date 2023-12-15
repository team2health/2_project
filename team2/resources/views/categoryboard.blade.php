@extends('layout.layout')

@section('title','Categoryboard')

@section('main')
<main class="last_main">
<a href="" class="community_a"><img class="community_icon" src="../img/top.png" alt=""></a>
        <a href="{{route('insert')}}" class="community_aplus"><img class="community_icon" src="../img/plusicon.png" alt=""></a>
    <div class="last_headline">
        <h2>자유게시판</h2>
        <button type="submit" class="cate_btn">
            정렬
        </button>
    </div>
    <div class="last_container">
    @forelse ($data as $item)
        <div class="last_user">
            <img class="community_icon"  src="../img/default_f.png" alt="" class="board_nic_img">                               
            <div class="board_nic_text">
                <div>
                {{ $item->u_id }}
                </div>
                <div>
                {{ $item->created_at }}
                </div>
            </div>
        </div> 
        <div>
            {{ $item->board_title }}
        </div> 
        <div class="last_content">
            <a href="{{ route('board.show',['board'=>$item->board_id]) }}" class="community_content">
                {{ $item->board_content }}
            </a>                   
        </div>  
    </div>
    @empty
    <div>게시글 없음</div>
    @endforelse            
    
    
</main>


@endsection