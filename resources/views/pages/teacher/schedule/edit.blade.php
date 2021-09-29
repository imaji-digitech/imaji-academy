<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Ubah Jadwal') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Jadwal</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.schedule.index') }}">Ubah Jadwal</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:form-schedule action="update" :iaf="$iaf" :dataId="$id" />
    </div>
</x-app-layout>
