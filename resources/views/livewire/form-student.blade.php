<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="{{ $action }}">
        <x-input title="Nama siswa" model="user.name" type="text"/>
        <x-input title="Email siswa" model="user.email" type="text"/>
        <x-input title="Password" model="user.password" type="password"/>
        <x-input title="Asal Sekolah" model="user.school" type="text"/>
        <x-input title="Kelas" model="user.class" type="number"/>
        <x-input title="Hobi" model="user.hobby" type="text"/>
        <x-input title="Cita-cita" model="user.future_goal" type="text"/>
        <x-input title="Nama Orang Tua" model="user.parent_name" type="text"/>
        <x-input title="Pekerjaan Orang Tua" model="user.parent_job" type="text"/>
        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
