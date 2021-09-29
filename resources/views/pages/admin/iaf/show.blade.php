<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Tambahakan fitur baru') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Feature</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.iaf.index') }}">Tambahakan fitur baru</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:form-adding-student action="update" :dataId="$id" />
    </div>
</x-app-layout>
