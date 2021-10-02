<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Penilain') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Penilaian</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="score" :model="$score" :dataId="$iaf"/>
    </div>
</x-app-layout>
