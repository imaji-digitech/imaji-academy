<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="{{$action}}">
        <x-input title="Materi hari itu" model="data.module" type="text"/>
        <x-textarea title="Catatan" model="data.note"/>
        <x-date type="datetimepicker" title="Tanggal dan waktu kegiatan" model="data.created_at"/>
        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
