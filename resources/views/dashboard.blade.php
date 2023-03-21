<x-app-layout>
    <x-slot name="header_content">
        <h1>Dashboard</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Layout</a></div>
            <div class="breadcrumb-item">Default Layout</div>
        </div>
    </x-slot>


    @if(auth()->user()->role==1)
        <livewire:dashboard-admin/>
    @elseif(auth()->user()->role==2)
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-4">
                <livewire:dashboard-teacher/>
            </div>
        </div>
    @endif
</x-app-layout>
