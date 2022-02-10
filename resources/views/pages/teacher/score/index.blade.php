<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Penilain') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Penilaian</a></div>
        </div>
    </x-slot>

    <div>
        <a href="{{ route('admin.score.manual',$iaf) }}" class="btn btn-primary">Tambah nilai peserta didik secara manual</a>
        <livewire:table.main name="score" :model="$score" :dataId="$iaf"/>
    </div>
</x-app-layout>
