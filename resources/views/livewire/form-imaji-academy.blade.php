<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="{{$action}}">
{{--        $this->data['title'] = '';--}}
{{--        $this->data['code'] = '';--}}
{{--        $this->data['village'] = '';--}}
{{--        $this->data['village_program'] = '';--}}
{{--        $this->data['year_program'] = '';--}}
{{--        $this->data['year_program_code'] = '';--}}
{{--        $this->data['village_code'] = '';--}}
{{--        $this->data['note'] = '';--}}

        <x-input title="Nama imaji academy" model="data.title" type="text"/>
        <x-input title="Code Imaji academy" model="data.code" type="text"/>
        <x-input title="Desa Imaji academy" model="data.village" type="text"/>
        <x-input title="Desa program" model="data.village_program" type="text"/>
        <x-input title="Tahun program masuk" model="data.year_program" type="number"/>
        <x-input title="Kode tahun (2022->22, 2023->23)" model="data.year_program_code" type="text"/>
        <x-input title="Village code" model="data.village_code" type="text"/>
        <x-textarea title="Catatan program" model="data.note"/>
        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
