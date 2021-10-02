<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Ubah penilaian') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Penilaian</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.score.index',$iaf) }}">Ubah penilaian</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:form-score action="update" :iaf="$iaf" :dataId="$id"/>
    </div>
</x-app-layout>
