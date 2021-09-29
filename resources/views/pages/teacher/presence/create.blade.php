<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Buat presensi kegiatan') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Presensi</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.presence.index',$iaf) }}">Buat presensi kegiatan</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:form-presence action="create" :iaf="$iaf" />
    </div>
</x-app-layout>
