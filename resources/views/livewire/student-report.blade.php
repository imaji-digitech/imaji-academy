<div class="bg-white p-3">
    <table class="table table-bordered align-content-center">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
{{--            <th scope="col">Sikap</th>--}}
            <th>Catatan untuk peserta didik</th>
        </tr>
        </thead>
        <tbody>
{{--        @php($ps=['Baik sekali','Baik','Cukup'])--}}
        @foreach($students as $index=>$student)
            <tr>
                <th scope="row">{{ $index+1 }}</th>
                <td>{{ $student->student->name }}</td>
{{--                <td>--}}
{{--                    @for($i=0;$i<3;$i++)--}}
{{--                        <div class="form-check form-check-inline">--}}
{{--                            <input class="form-check-input" type="checkbox" id="{{$student->user->name}}.attitude.{{$i}}"--}}
{{--                                   name="changeAttitude"--}}
{{--                                   {{ ($i+1==$student->attitude) ?'checked':'' }}--}}
{{--                                   wire:click="changeAttitude({{$student->id}},{{$i+1}})">--}}
{{--                            {{ $ps[$i] }}--}}
{{--                        </div>--}}
{{--                        <br>--}}
{{--                    @endfor--}}
{{--                </td>--}}
                <td>
                    <div class="">
                        <input type="text" class="form-control col-lg-8 mr-1" style="display: inline" wire:model="essay.{{$student->id}}">
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
