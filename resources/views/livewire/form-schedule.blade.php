<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="{{$action}}">
        <x-select :options="$optionIaf" :selected="$data['iaf_id']" title="Imaji Academy Fitur" model="data.iaf_id"/>
        <x-select :options="$optionDay" :selected="$data['day']" title="Hari" model="data.day"/>
        <x-time title="Waktu" model="data.time"/>
        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
