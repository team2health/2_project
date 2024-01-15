<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="canonical" href="https://demo-basic.adminkit.io/icons-feather.html">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="/bootstrap/img/icons/icon-48x48.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/ui-buttons.html" />
	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-up.html" />
	<link rel="canonical" href="https://demo-basic.adminkit.io/"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- <link rel="canonical" href="https://demo-basic.adminkit.io/ui-cards.html" />
	<link rel="canonical" href="https://demo-basic.adminkit.io/ui-forms.html" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/ui-typography.html" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/upgrade-to-pro.html" /> --}}
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="/bootstrap/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/admincommon.css">
	<title>@yield('title', 'main')</title>
</head>
    <body>
        <div class="wrapper">
            @include('adminpage/adminlayout.nav')

            <main class="content">
                <div class="container-fluid p-0">
                    @yield('main')
                
                
                
                </div>
            </main>
            @include('adminpage/adminlayout.footer')
        </div>
        <script src="/bootstrap/js/app.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        {{-- <script src="/js/contentboard.js"></script> --}}
        <script src="/js/admincommon.js"></script>
    </body>
</html>