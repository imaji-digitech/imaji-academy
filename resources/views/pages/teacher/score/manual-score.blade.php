<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Buat presensi kegiatan') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Score</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.score.index',$iaf) }}">Buat nilai manual</a></div>
        </div>
    </x-slot>

    <div>
        asdkjashdjk
        <livewire:form-manual-score :iaf="$iaf" />
    </div>
</x-app-layout>
