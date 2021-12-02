<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Buat feature baru') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Feature</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.feature.index') }}">Buat Feature Baru</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:form-feature action="update" :dataId="$id" />
    </div>
</x-app-layout>
