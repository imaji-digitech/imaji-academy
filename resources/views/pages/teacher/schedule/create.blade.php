<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Buat Jadwal Baru') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Jadwal</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.schedule.index') }}">Buat Jadwal Baru</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:form-schedule action="create" />
    </div>
</x-app-layout>
