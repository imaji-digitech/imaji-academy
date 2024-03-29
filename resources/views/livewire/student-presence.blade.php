<div class="bg-white p-3">
    <div class="row">
        <div class="col-md-4">
            <label for="">Pencarian Nama Siswa</label>
            <input type="text" class="form-control" wire:model="query">
        </div>
    </div>

    <br>
    <table class="table table-bordered align-content-center">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Status Kehadiran</th>
            <th>Keterangan</th>
        </tr>
        </thead>
        <tbody>
        @php($ps=\App\Models\PresenceStatus::get())
{{--        {{ dd($students) }}--}}
        @foreach($students as $index=>$student)
            <tr>
                <th scope="row">{{ $index+1 }}</th>

                <td>{{ $student->student->name }}</td>
                <td>
                    @for($i=0;$i<5;$i++)
                        <div class="form-check form-check-inline col-md-2">
                            <input class="form-check-input" type="checkbox" id="{{ $student->student->name }}.{{$i}}"
                                   name="check"
                                   {{ ($i+1==$student->presence_status_id) ?'checked':'' }}
                                   wire:click="change({{$student->id}},{{$i+1}})"
                            >
                            <label class="form-check-label" style="font-size: 12px"
                                   for="{{ $student->student->name }}.{{$i}}">{{ $ps[$i]->title }}</label>
                        </div>
                    @endfor
                </td>
                <td>
                    <div class="">
                        <input type="text" class="form-control col-lg-8 mr-1 mb-2" style="display: inline" wire:model="essay.{{$student->id}}">
                        <button class="btn btn-primary  col-lg-3" wire:click="changeNote({{$student->id}})">
                            Simpan
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
