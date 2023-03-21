<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Imaji Academy') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Imaji Academy</a></div>

        </div>
    </x-slot>

    <div>
        <livewire:table.main name="imajiAcademyStudent" :data-id="$id"/>
    </div>
</x-app-layout>
