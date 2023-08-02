<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Jadwal Kegiatan') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Feature</a></div>

        </div>
    </x-slot>

    <div class="row">
        @foreach($schedules as $schedule)
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <article class="article article-style-b">
                    <div class="article-details">
                        <div class="article-title">
                            <h2><a href="#">{{$schedule->imajiAcademyFeature->imajiAcademy->title}}</a></h2>
                            <h6>{{$schedule->imajiAcademyFeature->imajiAcademy->village}}</h6>
                        </div>
                        <p>{{ int_to_day($schedule->day) }}</p>
                        <p>{{ $schedule->time }}</p>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
</x-app-layout>
