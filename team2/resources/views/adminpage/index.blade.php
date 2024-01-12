@extends('adminpage/adminlayout.layout')

@section('title','index')

@section('main')

	<main class="content">
		<div class="container-fluid p-0">
			<div id="statistics" data-results="{{ json_encode($result) }}"></div>
			<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

			<div class="index-container">
				<div class="index-container-mini">
					<div class="card-header" id="main-gender">
						<div class="col-xl-6 col-xxl-5">
							<div id="chart" style="width: 400px; height: 300px;"></div>
						</div>
					</div>
				</div>
				<div class="card-header index-container-mini2">
					<div>
						<div id="chart1" style="width: 800px; height: 300px;"></div>
					</div>
				</div>
			</div>
			<br><br>
			<span>2024년</span>
			<div class="card-header">
				<div>
					<div class="admin-index-ps">
						<div class="admin-index-ps-mini">
							<span>순위</span>
							<span>부위 - 증상</span>
						</div>
						<span>조회수</span>
					</div>
					<div></div>
				</div>
			</div>
		</div>
	</main>
	<script src="https://cdn.jsdelivr.net/npm/echarts@5.3.2/dist/echarts.min.js"></script>
@endsection