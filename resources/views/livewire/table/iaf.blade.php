<div>
    <x-data-table :data="$data" :model="$iafs">
        <x-slot name="head">
            <tr>
                <th style="width: 10px">
                    <a wire:click.prevent="sortBy('id')" role="button" href="#">
                        ID
                        @include('components.sort-icon', ['field' => 'id'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('imaji_academy_id')" role="button" href="#">
                        Name Imaji Academy
                        @include('components.sort-icon', ['field' => 'imaji_academy_id'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('feature_id')" role="button" href="#">
                        Nama Fitur
                        @include('components.sort-icon', ['field' => 'feature_id'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('year_program')" role="button" href="#">
                    Tahun / Semester @include('components.sort-icon', ['field' => 'year_program'])
                    </a>
                </th>
                <th>Aktivitas</th>
                <th>Download</th>
                <th>Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($iafs as $iaf)
                <tr x-data="window.__controller.dataTableController({{ $iaf->id }})">
                    <td>{{ $iaf->id }}</td>
                    <td>{{ $iaf->imajiAcademy->title }}</td>
                    <td>
                        {{ $iaf->feature->title }}<br>
                        Siswa : {{ $iaf->featureStudents->count() }}<br>
                        Tutor : {{ $iaf->featureTeachers->count() }}<br>
                    </td>
                    <td style="padding: 0; text-align: center">{{ "$iaf->year_program/$iaf->semester" }}</td>
                    <td style="padding: 0; text-align: center">{{ $iaf->featureActivities->count() }}</td>
                    <td>
                        <a role="button" wire:click="exportPresence({{$iaf->id}})" class="mb-1 btn btn-primary">
                            <i class="fa fa-16px fa-download">Presensi</i></a>
                        <br>
                        <a role="button" wire:click="exportScore({{$iaf->id}})" class="mb-1 btn btn-success">
                            <i class="fa fa-16px fa-download">Penilaian</i></a>
                        <br>
                        {{--                        <a role="button" href="{{ route('admin.iaf.report',$iaf->id) }}" class="mr-2">--}}
                        {{--                            <i class="fa fa-16px fa-download">Sertifikat</i></a>--}}
                    </td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <div class="row">
                        <a role="button" href="{{ route('admin.iaf.edit',$iaf->id) }}" class="m-1 btn btn-success col">
                            <i class="fa fa-16px fa-pen">Ubah</i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#" class="m-1 btn btn-danger col">
                            <i class="fa fa-16px fa-trash">Hapus</i></a>

                        <a role="button" href="{{ route('admin.iaf.show-student',$iaf->id) }}"
                           class="m-1 btn btn-primary col">
                            <i class="fa fa-16px fa-user">Siswa</i></a>
                        <a role="button" href="{{ route('admin.iaf.show-teacher',$iaf->id) }}"
                           class="m-1 btn btn-primary col">
                            <i class="fa fa-16px fa-user">Tutor</i></a>

                        <a role="button" href="{{ route('admin.presence.index',$iaf->id) }}"
                           class="m-1 btn btn-warning col">
                            <i class="fa fa-16px fa-user">Presensi</i></a>
                        <a role="button" href="{{ route('admin.score.index',$iaf->id) }}" class="m-1 btn btn-warning col">
                            <i class="fa fa-16px fa-user">Score</i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
