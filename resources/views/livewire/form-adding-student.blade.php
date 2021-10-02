<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="addStudent">
        <x-select2 :options="$optionUsers" :selected="$user" title="Tambahkan murid" model="user"/>
        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
