<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="{{$action}}">
        <x-input title="Nama imaji academy" model="data.title" type="text"/>
        <x-input title="Code Imaji academy" model="data.code" type="text"/>
        <x-input title="Desa Imaji academy" model="data.village" type="text"/>
        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
