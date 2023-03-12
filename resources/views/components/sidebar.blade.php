<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">
                <img class="d-inline-block" width="32px" height="30.61px" src="" alt="">
            </a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            @if(auth()->user()->role==1)
                <li class="menu-header">Manajemen Program Pendidikan</li>
                <li class="">
                    <a class="nav-link" href="{{ route('admin.log.index') }}">
                        <i class="fas fa-fire"></i><span>Aktivitas</span>
                    </a>
                </li>
                <li class="">
                    <a class="nav-link" href="{{ route('admin.feature.index') }}">
                        <i class="fas fa-fire"></i><span>Feature</span>
                    </a>
                </li>
                <li class="">
                    <a class="nav-link" href="{{ route('admin.imaji-academy.index') }}">
                        <i class="fas fa-fire"></i><span> Lokasi Program</span>
                    </a>
                </li>

                <li class="">
                    <a class="nav-link" href="{{ route('admin.iaf.index') }}">
                        <i class="fas fa-fire"></i><span> Detail pesebaran</span>
                    </a>
                </li>
                <li class="menu-header">Manajemen SDM Pendidikan</li>
                <li class="">
                    <a class="nav-link" href="{{ route('admin.teacher.index') }}">
                        <i class="fas fa-fire"></i><span>Tutor dan Kawan Belajar</span>
                    </a>
                </li>
                <li class="">
                    <a class="nav-link" href="{{ route('admin.student.index') }}">
                        <i class="fas fa-fire"></i><span>Murid</span>
                    </a>
                </li>
            @endif
            @if(auth()->user()->role==2)
{{--                <li class="menu-header">Manajemen Jadwal</li>--}}
                @php($fts=auth()->user()->featureTeachers)
{{--                @foreach($fts as $ft)--}}
{{--                    <li class="">--}}
{{--                        <a class="nav-link" href="{{ route('admin.schedule.index') }}">--}}
{{--                            <i class="fas fa-fire"></i><span>Jadwal Mengajar</span>--}}
{{--                        </a>--}}
{{--                        <a class="nav-link" href="{{ route('admin.schedule.create') }}">--}}
{{--                            <i class="fas fa-fire"></i><span>Buat Jadwal</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                <li class="menu-header">Manajemen Murid</li>
                @foreach($fts as $ft)
                    <li class="">
                        <a class="nav-link" href="{{ route('admin.iaf.show-student',$ft->iaf_id) }}"><i
                                class="fas fa-fire"></i><span>{{ $ft->imajiAcademyFeature->imajiAcademy->code."-".$ft->imajiAcademyFeature->feature->code }}</span></a>
                    </li>
                @endforeach
                <li class="menu-header">Input data raport</li>
                @foreach($fts as $ft)
                <li class="">
                    <a class="nav-link" href="{{ route('admin.iaf.report',$ft->iaf_id) }}">
                        <i class="fas fa-fire"></i>
                        <span>{{ $ft->imajiAcademyFeature->imajiAcademy->code."-".$ft->imajiAcademyFeature->feature->code }}</span>
                    </a>
                </li>
                @endforeach
                <li class="menu-header">Manajemen Presensi</li>
                @foreach($fts as $ft)
                    <li class="">
                        <a class="nav-link" href="{{ route('admin.presence.index',$ft->iaf_id) }}"><i
                                class="fas fa-fire"></i><span>{{ $ft->imajiAcademyFeature->imajiAcademy->code."-".$ft->imajiAcademyFeature->feature->code }}</span></a>
                    </li>
                @endforeach


                <li class="menu-header">Manajemen nilai</li>
                @foreach($fts as $ft)
                    <li class="">
                        <a class="nav-link" href="{{ route('admin.score.index',$ft->iaf_id) }}"><i
                                class="fas fa-fire"></i><span>{{ $ft->imajiAcademyFeature->imajiAcademy->code."-".$ft->imajiAcademyFeature->feature->code }}</span></a>
                    </li>
                @endforeach
            @endif
        </ul>
    </aside>
</div>
