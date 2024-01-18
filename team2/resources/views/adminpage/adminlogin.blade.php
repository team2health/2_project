
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/admincommon.css">
    <title>관리자 로그인</title>
</head>
<body>
    <div class="adminlogin-maindiv">
        <form action="/adminlogin" method="post" class="adminlogin-form">
            @csrf
            <div class="mb-3">
                <label for="admin_id" class="form-label">관리자 아이디</label>
                <input type="text" class="form-control" id="admin_id" name="admin_id">
            </div>
            <div class="mb-3">
                <label for="admin_password" class="form-label">비밀번호</label>
                <input type="password" class="form-control" id="admin_password" name="admin_password">
            </div>
            <button type="submit" class="btn btn-outline-dark">Login</button>
        </form>
        @if (isset($adminPassword))
            <input type="hidden" value="{{$adminPassword}}" id="adminPasswordChk">
        @else
            <input type="hidden" value="0" id="adminPasswordChk">
        @endif
    </div>

    <script src="/js/adminlogin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
