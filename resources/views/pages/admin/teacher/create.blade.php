<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Tambah tutor baru') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Feature</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.teacher.index') }}">Tambah tutor baru</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:form-teacher action="create" />
    </div>
</x-app-layout>
