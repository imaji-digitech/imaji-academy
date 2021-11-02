<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="{{ $action }}">
        <x-input title="Nama guru" model="user.name" type="text"/>
        <x-input title="Email guru" model="user.email" type="text"/>
        <x-input title="Password" model="user.password" type="password"/>
        <x-input title="Asal Sekolah" model="user.school" type="text"/>

        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
