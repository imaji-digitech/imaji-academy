<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="addPresence">
        <x-select :options="$optionStudent" :selected="$student" title="Nama murid" model="student"/>
        <x-select :options="$optionPresence" :selected="$presence" title="Nama module" model="presence"/>
        <x-select :options="$optionStatusPresence" :selected="$status" title="Status kehadiran" model="status"/>
        <x-textarea model="note" title="Keterangan"/>
        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
