<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Ubah imaji academy') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Feature</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.imaji-academy.index') }}">Ubah imaji academy</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:form-imaji-academy action="update" :dataId="$id" />
    </div>
</x-app-layout>
