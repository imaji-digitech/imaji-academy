<div class="bg-white p-3">
    <div class="table-responsive">
    <table class="table table-bordered align-content-center ">
        <thead>
        <tr>
            <th scope="col" style="width: 10px">#</th>
            <th scope="col" style="width: 200px">Nama</th>
            <th scope="col" style="width: 100px">Nilai Teori</th>
            <th scope="col" style="width: 250px">Nilai Keterampilan</th>
            <th style="width: 250px">Keterangan</th>
        </tr>
        </thead>
        <tbody>

        @foreach($students as $index=>$student)
            <tr>
                <th scope="row">{{ $index+1 }}</th>
                <td>{{ $student->student->name }}</td>
                <td>
                    @for($i=0;$i<3;$i++)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id=1.{{$student->student->name}}.{{$i}}"
                                   name="check"
                                   {{ ($i+1==$student->score_theory) ?'checked':'' }}
                                   wire:click="changeScoreTheory({{$student->id}},{{$i+1}})"
                            >
                            <label class="form-check-label" style="font-size: 12px"
                                   for="1.{{$student->student->name}}.{{$i}}">{{ $i+1==1?'A':''}}{{$i+1==2?'B':''}}{{$i+1==3?'C':'' }}</label>
                        </div>
                    @endfor
                </td>
                <td>
                    @for($i=0;$i<3;$i++)
                        <div class="form-check form-check-inline col-md-4">
                            <input class="form-check-input mr-1" type="checkbox" id=2.{{$student->student->name}}.{{$i}}"
                                   name="check"
                                   {{ ($i+1==$student->score_practice) ?'checked':'' }}
                                   wire:click="changeScorePractice({{$student->id}},{{$i+1}})"
                            >
                            <label class="form-check-label" style="font-size: 11px"
                                   for="2.{{$student->student->name}}.{{$i}}">{{ $i+1==1?'Membanggakan':''}}{{$i+1==2?'Cemerlang':''}}{{$i+1==3?'Memuaskan':'' }}</label>
                        </div>
                    @endfor
                </td>
                <td>
                    <div class="m-1">
                        <textarea class="form-control col-lg-8 mr-1" style="display: inline" wire:model="essay.{{$student->id}}"></textarea>
                        <button class="btn btn-primary col-lg-3" wire:click="changeNote({{$student->id}})">
                            Simpan
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
