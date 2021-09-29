<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Tambah imaji academy baru') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Feature</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.imaji-academy.index') }}">Tambah imaji academy baru</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:form-imaji-academy action="create" />
    </div>
</x-app-layout>
