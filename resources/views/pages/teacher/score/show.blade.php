<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Presensi kegiatan belajar') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Presensi</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.presence.index',$iaf) }}">Presensi kegiatan belajar</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:form-score-student :iaf="$iaf" dataId="{{$id}}"/>
    </div>
</x-app-layout>
