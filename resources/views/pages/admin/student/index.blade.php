<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Siswa') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Data Siswa</a></div>

        </div>
    </x-slot>

    <div>
        <livewire:table.main name="student" :model="$student" />
    </div>
</x-app-layout>
