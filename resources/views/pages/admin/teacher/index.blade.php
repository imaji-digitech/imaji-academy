<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Tutora') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Data Tutor</a></div>

        </div>
    </x-slot>

    <div>
        <livewire:table.main name="teacher" :model="$teacher" />
    </div>
</x-app-layout>
