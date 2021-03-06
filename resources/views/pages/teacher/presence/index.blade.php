<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Presensi') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Presensi</a></div>
        </div>
    </x-slot>

    <div>
        <a href="{{ route('admin.presence.manual',$iaf) }}" class="btn btn-primary">Tambah presensi peserta didik secara manual</a>
        <livewire:table.main name="presence" :model="$presence" :dataId="$iaf"/>
    </div>
</x-app-layout>
