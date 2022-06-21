<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <div class="main-menu-content">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mr-auto">
                        <a class="navbar-brand" href="{{route('home')}}">
                            <div class="logo"></div>
                            <h2 class="brand-text mb-0"></h2>
                        </a>
                    </li>
                    <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
                </ul>
            </div>
            <div class="shadow-bottom"></div>
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li>
                    <select class="form-control" id="project">
                        <option value="" selected>Chọn dự án</option>
                        <option value="1">HTV</option>
                        <option value="2">OKR</option>
                    </select>
                </li>
                <li class=" navigation-header"><span>QUẢN LÝ DỰ ÁN</span>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-briefcase"></i><span class="menu-title" >{{__('VẤN ĐỀ')}}</span></a>
                    <ul class="menu-content">
                        <li><a href="{{route('measuring_units')}}"><i class="feather icon-circle"></i><span class="menu-item">{{__('Danh sách vấn đề')}}</span></a></li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-briefcase"></i><span class="menu-title" >{{__('MENU 1')}}</span></a>
                    <ul class="menu-content">
                        <li><a href="{{route('measuring_units')}}"><i class="feather icon-circle"></i><span class="menu-item">{{__('One Card')}}</span></a></li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-box"></i><span class="menu-title" >{{__('MENU 2')}}</span></a>
                    <ul class="menu-content">
                        <li><a href="{{route('reorder_guidelines.list')}}"><i class="feather icon-circle"></i><span class="menu-item">{{__('Two Card')}}</span></a></li>
                     </ul>
                </li>
                <hr class="mx-1"/>
                <li class=" navigation-header"><span>THIẾT ĐẶT</span>
                </li>
                <li class=" nav-item"><a href="app-email.html"><i class="fa fa-sliders"></i><span class="menu-title">{{__('Danh sách dự án')}}</span></a>
                </li>
                <li class=" nav-item"><a href="#"><i class="fa fa-address-book"></i><span class="menu-title">{{__('Loại vấn đề')}}</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
