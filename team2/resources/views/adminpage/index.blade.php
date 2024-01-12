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
		</div>
	</main>
	<script src="https://cdn.jsdelivr.net/npm/echarts@5.3.2/dist/echarts.min.js"></script>
@endsection