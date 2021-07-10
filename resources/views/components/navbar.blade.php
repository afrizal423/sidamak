@php
$user = auth()->user();
@endphp

<div class="navbar-bg">
    {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#6777ef" fill-opacity="1" d="M0,288L6.5,277.3C13,267,26,245,39,202.7C51.9,160,65,96,78,74.7C90.8,53,104,75,117,117.3C129.7,160,143,224,156,245.3C168.6,267,182,245,195,208C207.6,171,221,117,234,96C246.5,75,259,85,272,101.3C285.4,117,298,139,311,144C324.3,149,337,139,350,165.3C363.2,192,376,256,389,277.3C402.2,299,415,277,428,240C441.1,203,454,149,467,144C480,139,493,181,506,181.3C518.9,181,532,139,545,144C557.8,149,571,203,584,240C596.8,277,610,299,623,288C635.7,277,649,235,662,192C674.6,149,688,107,701,117.3C713.5,128,726,192,739,181.3C752.4,171,765,85,778,90.7C791.4,96,804,192,817,224C830.3,256,843,224,856,181.3C869.2,139,882,85,895,96C908.1,107,921,181,934,208C947,235,960,213,973,208C985.9,203,999,213,1012,213.3C1024.9,213,1038,203,1051,213.3C1063.8,224,1077,256,1090,266.7C1102.7,277,1116,267,1129,245.3C1141.6,224,1155,192,1168,192C1180.5,192,1194,224,1206,218.7C1219.5,213,1232,171,1245,160C1258.4,149,1271,171,1284,181.3C1297.3,192,1310,192,1323,186.7C1336.2,181,1349,171,1362,165.3C1375.1,160,1388,160,1401,176C1414.1,192,1427,224,1434,240L1440,256L1440,0L1433.5,0C1427,0,1414,0,1401,0C1388.1,0,1375,0,1362,0C1349.2,0,1336,0,1323,0C1310.3,0,1297,0,1284,0C1271.4,0,1258,0,1245,0C1232.4,0,1219,0,1206,0C1193.5,0,1181,0,1168,0C1154.6,0,1142,0,1129,0C1115.7,0,1103,0,1090,0C1076.8,0,1064,0,1051,0C1037.8,0,1025,0,1012,0C998.9,0,986,0,973,0C960,0,947,0,934,0C921.1,0,908,0,895,0C882.2,0,869,0,856,0C843.2,0,830,0,817,0C804.3,0,791,0,778,0C765.4,0,752,0,739,0C726.5,0,714,0,701,0C687.6,0,675,0,662,0C648.6,0,636,0,623,0C609.7,0,597,0,584,0C570.8,0,558,0,545,0C531.9,0,519,0,506,0C493,0,480,0,467,0C454.1,0,441,0,428,0C415.1,0,402,0,389,0C376.2,0,363,0,350,0C337.3,0,324,0,311,0C298.4,0,285,0,272,0C259.5,0,246,0,234,0C220.5,0,208,0,195,0C181.6,0,169,0,156,0C142.7,0,130,0,117,0C103.8,0,91,0,78,0C64.9,0,52,0,39,0C25.9,0,13,0,6,0L0,0Z"></path></svg> --}}
</div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-turbolinks="false" data-toggle="sidebar" class="nav-link nav-link-lg" id="klik"><i class="fas fa-bars"></i></a></li>
        </ul>
        <h1 class="font-weight-bold text-2xl text-white">Daily Activity Pelindo III</h1>
        {{-- {{ config('app.name', 'Daily Activity Pelindo III') }} --}}
    </form>
    <ul class="navbar-nav navbar-right">
        {{-- // load livewire --}}
        @livewire('notifikasi')
        <li class="dropdown"><a href="#" data-turbolinks="false" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            @if (!is_null($user))
                <div class="d-sm-none d-lg-inline-block">Hi, {{ $user->nama }}</div></a>
            @else
                <div class="d-sm-none d-lg-inline-block">Hi, Welcome</div></a>
            @endif
            <div class="dropdown-menu dropdown-menu-right">
                {{-- <a href="/user/profile" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a> --}}
                @if (request()->get('is_admin'))
                <a href="/setting" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Setting
                </a>
                @endif
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>
