@extends('adminpage/adminlayout.layout')

@section('title','index')

@section('main')

	<main class="content">
		<div class="container-fluid p-0">
			<div id="statistics" data-results="{{ json_encode($result) }}"></div>
			<div class="index-container">
				<div class="index-container-mini">
					<div class="age_box">연령</div>
					<br><br>
					<div class="card-header" id="main-gender">
						<div id="chart" style="width: 100%; height: 280px; margin-top: 20px;"></div>
					</div>
				</div>
				<div>
					<div class="age_box">댓글&게시글</div>
					<br><br>
					<div class="card-header index-container-mini2">
						<div id="chart1" style="width: 100%; height: 348px;"></div>
					</div>
				</div>
			</div>
			<br><br>
			<div class="pandemic_box">2024년 부위-증상 통계</div>
			<br><br>
			<div class="index_display_grid">
				<div onclick="psModal(1); return false;" id="psModal1">
					<div class="card-header pandemic-border-bottom ps-width index_bc_gray">
						<div class="admin-index-ps-mini">
							<span class="index_rank">순위</span>
							<span class="index_ps">부위 - 증상</span>
							<span class="index_cnt">2024년 (2023년)</span>
						</div>
					</div>
					@foreach ($result[4] as $item)
					<div class="card-header ps-width">
						<div class="admin-index-ps-mini">
							<span class="index_rank">{{ $loop->iteration }}</span>
							<span class="index_ps">{{ $item->part_name[0]->part_name }} - {{ $item->symptom_name[0]->symptom_name }}</span>
							<div class="index_cnt">
								<span>{{ $item->cnt }}회</span>
								@if ($item->last_year > 0)
								<span class="index-font-color-red">(+{{ $item->last_year }}%)</span>
								@else
								<span class="index-font-color-blue">({{ $item->last_year }}%)</span>
								@endif
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<div class="psmodaldisplaynone" onclick="psModal(2); return false;" id="psModal2">
					<div id="chart2" style="width: 700px; height: 400%;"></div>
				</div>
				<div onclick="psModal(3); return false;" id="psModal3">
					<div class="card-header pandemic-border-bottom ps-width index_bc_gray">
						<div class="admin-index-ps-mini">
							<span class="index_rank">연령대</span>
							<span class="index_ps">부위 - 증상</span>
							<span class="index_cnt">2024년(2023년)</span>
						</div>
					</div>
					@foreach ($result[6] as $item)
					<div class="card-header ps-width">
						<div class="admin-index-ps-mini">
							<span class="index_rank">{{ $item->age_range }}</span>
							<span class="index_ps">{{ $item->part_name[0]->part_name }} - {{ $item->symptom_name[0]->symptom_name }}</span>
							<div class="index_cnt">
								<span>{{ $item->cnt }}회</span>
								@if ($item->last_year > 0)
								<span class="index-font-color-red">(+{{ $item->last_year }}%)</span>
								@else
								<span class="index-font-color-blue">({{ $item->last_year }}%)</span>
								@endif
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<div class="psmodaldisplaynone" onclick="psModal(4); return false;" id="psModal4">
					<div id="chart3" style="width: 700px; height: 400%;"></div>
				</div>
			</div>
			<br><br><br>
            <div class="button-box1">
				<div class="pandemic_box">유행하는 질병</div>
				<div class="pandemic_insert_box">
					<input type="text" id="pandemic_name_insert" name="pandemic_name" class="insert-pandemic-input1" placeholder="질병명">
					<input type="text" id="pandemic_symptom_insert" name="pandemic_symptom" class="insert-pandemic-input2" placeholder="증상">
					<button type="button" class="admin-custom-btn custom-common-delete-btn" onclick="insertpandemic(); return false;">+</button>
				</div>
            </div>
			<br>
			<div class="card-header pandemic-border-bottom index_bc_gray">
				<div>
					<div class="admin-index-ps">
						<span>선택</span>
						<span class="pandemic-name">질병명</span>
						<span class="pandemic-symptom">증상</span>
						<span>생성일자</span>
					</div>
				</div>
			</div>
			<form action="/admin/pandemicdelete" method="post" id="pandemicdeletebox">
				@csrf
				@method('DELETE')
				@foreach ($result[5] as $item)
				<div class="card-header">
					<div class="admin-index-ps">
						<span><input type="checkbox" name="pandemic_id[]" value="{{$item->pandemic_id}}"></span>
						<span class="pandemic-name1">{{$item->pandemic_name}}</span>
						<span class="pandemic-symptom1">{{$item->pandemic_symptoms}}</span>
						<span>{{$item->created_at}}</span>
					</div>
				</div>
				@endforeach
				<br>
				<div class="button-box">
					<button type="button" class="admin-custom-btn custom-common-delete-btn" onclick="pandemicdelete(); return false;">삭제</button>
				</div>
			</form>
		</div>
	</main>
	<script src="https://cdn.jsdelivr.net/npm/echarts@5.3.2/dist/echarts.min.js"></script>
	<script src="/js/adminindex.js"></script>
@endsection