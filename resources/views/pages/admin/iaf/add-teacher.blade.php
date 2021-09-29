<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Tambah siswa baru') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Feature</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:form-adding-teacher dataId="{{$id}}"/>
    </div>
</x-app-layout>
