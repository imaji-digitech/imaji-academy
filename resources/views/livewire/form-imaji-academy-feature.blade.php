<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="{{$action}}">
        <x-select :options="$optionImajiAcademy" :selected="$data['imaji_academy_id']" title="Imaji Academy" model="data.imaji_academy_id"/>
        <x-select :options="$optionFeature" :selected="$data['feature_id']" title="Fitur" model="data.feature_id"/>
        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
