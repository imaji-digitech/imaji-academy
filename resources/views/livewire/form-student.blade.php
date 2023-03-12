<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="{{ $action }}">

        <x-input title="Nama siswa" model="user.name" type="text"/>

        {{--        <x-input title="TTL" model="user.birthday" type="text"/>--}}

        <div class="row">
            <div class="col">
                <x-input title="Tempat lahir" model="user.birth_place" type="text"/>
            </div>
            <div class="col">
                <x-input title="Tanggal lahir" model="user.birth_place" type="date"/>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <x-input title="Asal Sekolah" model="user.school" type="text"/>
            </div>
            <div class="col">
                <x-select title="kelas" :selected="$user['class']" model="user.class" :options="$optionClass"/>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <x-input title="Tahun program" model="user.year_enter" type="int"/>
            </div>
            <div class="col">
                <x-select title="Semester" :selected="$user['semester']" model="user.semester"
                          :options="$optionSemester"/>
            </div>
        </div>

        <x-select title="Desa Program" :selected="$user['imaji_academy_id']" model="user.imaji_academy_id" :options="$optionVillage"/>
        <div class="row">
            <div class="col">
                <x-input title="Hobi" model="user.hobby" type="text"/>
            </div>
            <div class="col">
                <x-input title="Cita-cita" model="user.future_goal" type="text"/>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <x-input title="Nama Orang Tua" model="user.parent_name" type="text"/>
            </div>

            <div class="col">
                <x-input title="Pekerjaan Orang Tua" model="user.parent_job" type="text"/>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <x-input title="Desa siswa" model="user.home_village" type="text"/>
            </div>

            <div class="col">
                <x-input title="Alamat siswa" model="user.home_address" type="text"/>
            </div>
        </div>

        <x-select title="Petani mitra kasih 1 untuk iya 0 untuk tidak" model="user.ips" :selected="$user['ips']"
                  :options="$optionIps"/>
        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
