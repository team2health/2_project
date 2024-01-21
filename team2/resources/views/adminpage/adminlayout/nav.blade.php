<nav id="sidebar" class="sidebar js-sidebar">
<div class="sidebar-content js-simplebar">
    <a class="sidebar-brand" href="{{route('admin.main')}}">
<span class="align-middle">건강하시조</span>
</a>

    <ul class="sidebar-nav">
        <li class="sidebar-header">
            메인
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('admin.main')}}">
                <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">대시보드</span>
            </a>
        </li>

        <li class="sidebar-item">
            {{-- <a class="sidebar-link" href="{{route('pages-profile')}}">
    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
</a> --}}
        </li>

        {{-- <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('pages-sign-in')}}">
                <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Sign In</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('pages-sign-up')}}">
                <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Sign Up</span>
            </a>
        </li> --}}

        <li class="sidebar-header">
            컨텐츠 관리
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('admin.contents')}}">
                <i class="align-middle me-2" data-feather="edit"></i> <span class="align-middle">게시글/댓글</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('contents.declaration')}}">
                <i class="align-middle me-2" data-feather="x-circle"></i> <span class="align-middle">신고내역</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('admin.adminusermanagement')}}">
                <i class="align-middle me-2" data-feather="user"></i> <span class="align-middle">유저관리</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('admin.adminsymptomsmanagement')}}">
                <i class="align-middle me-2" data-feather="plus-square"></i> <span class="align-middle">증상관리</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('adminhashtag.get')}}">
                <i class="align-middle me-2" data-feather="tag"></i> <span class="align-middle">해시태그</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('admin.deletedcontentdate', ['align_board' => '1'])}}">
                <i class="align-middle me-2" data-feather="trash-2"></i> <span class="align-middle">삭제된 게시글</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('admindelete.get')}}">
                <i class="align-middle me-2" data-feather="user-x"></i> <span class="align-middle">관리자 계정</span>
            </a>
        </li>
    </ul>

    <div class="sidebar-cta">
    </div>
</div>
</nav>

<div class="main">
<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
<i class="hamburger align-self-center"></i>
</a>

<div class="navbar-collapse collapse">
    <button type="button" class="admin-custom-btn custom-common-delete-btn1" onclick="adminmodalon(); return false;">관리자 계정 생성</button>
    <a href="{{ route('admin.logout') }}">Logout</a>
</div>

<div style="display: none;" class="admin-regist-modal" id="admin_modal">
    <div class="admin-box">
        <span class="admin-regist-name">관리자 계정 생성</span>
        <span class="admin-modal-down" onclick="adminmodaloff(); return false;">X</span>
    </div>
    <br><br><br>
    <div class="admin-regist-box2">
        <div class="admin-id">관리자 아이디</div>
        <input type="text" name="admin_id" id="admin_regist_id" class="admin-input">
        <div class="admin-id">관리자 이름</div>
        <input type="text" name="admin_name" id="admin_regist_name" class="admin-input">
        <div class="admin-id">비밀번호</div>
        <input type="password" name="admin_password" id="admin_regist_pw" class="admin-input">
    </div>
    <br><br>
    <div class="admin-regist-button-box">
        <button type="button" class="admin-custom-btn2 custom-common-delete-btn2" onclick="adminRegist(); return false;">생성하기</button>
    </div>
</div>

    {{-- <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="bell"></i>
                        <span class="indicator">4</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                        4 New Notifications
                    </div>
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-danger" data-feather="alert-circle"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Update completed</div>
                                    <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                                    <div class="text-muted small mt-1">30m ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-warning" data-feather="bell"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Lorem ipsum</div>
                                    <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
                                    <div class="text-muted small mt-1">2h ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-primary" data-feather="home"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Login from 192.186.1.8</div>
                                    <div class="text-muted small mt-1">5h ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-success" data-feather="user-plus"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">New connection</div>
                                    <div class="text-muted small mt-1">Christina accepted your request.</div>
                                    <div class="text-muted small mt-1">14h ago</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="#" class="text-muted">Show all notifications</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="message-square"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
                    <div class="dropdown-menu-header">
                        <div class="position-relative">
                            4 New Messages
                        </div>
                    </div>
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <img src="img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                </div>
                                <div class="col-10 ps-2">
                                    <div class="text-dark">Vanessa Tucker</div>
                                    <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.</div>
                                    <div class="text-muted small mt-1">15m ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <img src="img/avatars/avatar-2.jpg" class="avatar img-fluid rounded-circle" alt="William Harris">
                                </div>
                                <div class="col-10 ps-2">
                                    <div class="text-dark">William Harris</div>
                                    <div class="text-muted small mt-1">Curabitur ligula sapien euismod vitae.</div>
                                    <div class="text-muted small mt-1">2h ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <img src="img/avatars/avatar-4.jpg" class="avatar img-fluid rounded-circle" alt="Christina Mason">
                                </div>
                                <div class="col-10 ps-2">
                                    <div class="text-dark">Christina Mason</div>
                                    <div class="text-muted small mt-1">Pellentesque auctor neque nec urna.</div>
                                    <div class="text-muted small mt-1">4h ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <img src="img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
                                </div>
                                <div class="col-10 ps-2">
                                    <div class="text-dark">Sharon Lessman</div>
                                    <div class="text-muted small mt-1">Aenean tellus metus, bibendum sed, posuere ac, mattis non.</div>
                                    <div class="text-muted small mt-1">5h ago</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="#" class="text-muted">Show all messages</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
    <i class="align-middle" data-feather="settings"></i>
    </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
    <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark">Charles Hall</span>
    </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> 관리자 프로필</a>
                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('index')}}"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Log out</a>
                </div>
            </li>
        </ul>
    </div> --}}
</nav>