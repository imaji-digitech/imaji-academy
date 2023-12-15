@php use App\Models\FeatureScoreStudent; @endphp
    <!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @page {
            margin: 0in;
        }

        body {
            background-image: url({{ public_path('images/raport.jpg') }});
            background-position: top left;
            background-repeat: no-repeat;
            background-size: 100%;
            width: 100%;
            height: 100%;
        }

        .static table {
            border-spacing: 0px;
            border-collapse: separate;
            border: 1px solid black;
        }

        .static table tr {
            border-spacing: 0px;
            border-collapse: separate;
            border: 1px solid black;
        }

        .static table tr:nth-child(even) {
            border-spacing: 0px;
            border-collapse: separate;
            border: 1px solid black;
        }

        .static table tr:first-child td,
        .static table tr:first-child th {
            font-size: 16px;
            font-weight: 600;
            line-height: 26px;
            border-spacing: 0px;
            border-collapse: separate;
            border: 1px solid black;
        }

        .static td {
            border-spacing: 0px;
            border-collapse: separate;
            border: 1px solid black;
        }
    </style>
</head>
<body>

@foreach($iaf->featureStudents as $index=>$user)
    @php
        $c=0;
        $total=0;
    @endphp


    @foreach($iaf->featureScores as $index2=>$q2)
        @php
            $score=FeatureScoreStudent::whereStudentId($user->student->id)->whereFeatureScoreId($q2->id)->orderByDesc('id')->first();
        @endphp
        @if($score!=null)
        @if($score->score!=0)
            @php
                $c+=1;
            @endphp
        @endif
        @endif
    @endforeach
    @if($c==0)
        @continue
    @endif
    @if($index!=0)
        <div style="page-break-before: always;"></div>
    @endif


    <div style="padding: 50px">
        <br>
        <div style="text-align: center">
            <img src="{{ public_path('images/half_image.png') }}" alt="" style="width: 90px;margin-right: 10px">
            <img src="{{ public_path('images/ia.png') }}" alt="" style="width: 90px;margin-right: 10px">

        </div>
        <div style="    text-align: center">
            <h2 style="padding: 0;margin: 0">RAPOR HASIL PEMBELAJARAN SISWA</h2>
            <h3 style="padding: 0;margin: 0">{{ $iaf->imajiAcademy->title }}</h3>
            <h3 style="padding: 0;margin: 0">{{ $iaf->imajiAcademy->village }}</h3>
        </div>
        <br>
        <div>
            <table style="margin: 0;padding: 0; width: 100%">
                <tr>
                    <td style="width: 15%">Nama Siswa</td>
                    <td style="width: 45%">: {{ $user->student->name }}</td>
                    <td style="width: 15%">NIS</td>
                    <td style="width: 45%">: {{ $user->student->nis }}</td>
                </tr>
                <tr>
                    <td style="width: 15%">Semester</td>
                    <td style="width: 45%">: 1</td>
                    <td style="width: 15%">Fitur</td>
                    <td style="width: 45%">: {{ $iaf->feature->title }}</td>
                </tr>
            </table>
        </div>
        <br>
        <div class="static">
            <table style="margin: 0;padding: 0; width: 100%;">
                <thead style="text-align: center">
                <tr>
                    <td style="width: 5%">No</td>
                    <td>Materi kelas fitur</td>
                    <td>Penilaian</td>
                </tr>

                </thead>
                <tbody>


                @php
                    $c=0;
                    $total=0;
                @endphp
                @foreach($iaf->featureScores as $index2=>$q2)
                    @php
                        $score=FeatureScoreStudent::whereStudentId($user->student->id)->whereFeatureScoreId($q2->id)->orderByDesc('id')->first();
                    @endphp
                    @if($score!=null and $score->score!=0)
                        @php
                            $c+=1;
                            $total+=$score->score;
                        @endphp
                    <tr>
                        <td style="text-align: center">{{ $c }}</td>

                        <td>{{ $q2->module }}</td>

                        <td style="text-align: center">

                                @if($score->score>84)
                                    A
                                @elseif($score->score>70)
                                    B
                                @elseif($score->score>60)
                                    C
                                @else
                                    D
                                @endif
                        </td>
                    </tr>
                    @endif
                @endforeach
                <tr>
                    <td colspan="2"><b>Rata-rata</b></td>
                    @if($c!=0)
                    @php($score=$total/$c)
                    <td style="text-align: center">
                        @if($score>84)
                            A
                        @elseif($score>70)
                            B
                        @elseif($score>60)
                            C
                        @else
                            D
                        @endif
                    </td>
                    @endif

                </tr>

                </tbody>
            </table>
        </div>
        <br>
        <div class="static" style="float: left; width: 25%">
            <table style="margin: 0;padding: 0; ">
                <tr style="border: 1px solid black;">
                    <td style="text-align: center; padding:0 15px " colspan="2">
                        Keterangan
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; padding:5px 15px ">A</td>
                    <td style="text-align: center; padding:5px 15px ">85 - 100</td>
                </tr>
                <tr>
                    <td style="text-align: center; padding:5px 15px ">B</td>
                    <td style="text-align: center; padding:5px 15px ">71 - 84</td>
                </tr>
                <tr>
                    <td style="text-align: center; padding:5px 15px ">C</td>
                    <td style="text-align: center; padding:5px 15px ">60 - 70</td>
                </tr>
                <tr>
                    <td style="text-align: center; padding:5px 15px ">D</td>
                    <td style="text-align: center; padding:5px 15px ">0 - 59</td>
                </tr>
            </table>
        </div>

        @php($report= \App\Models\FeatureReport::where('iaf_id','=',$iaf->id)->where('student_id','=',$user->student_id)->first())
            @if($report!=null)
            <div class="static" style="float: right; width: 25%">
                    <table style="margin: 0;padding: 0; width: 100%;">
                        <tr style="border: 1px solid black;">
                            <td>
                                Catatan tutor untuk diperhatikan oleh peserta didik dan orang tua/wali
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ $report->note }}
                            </td>
                        </tr>
                    </table>
                </div>
            @endif

        <br><br>
        <div>
            <table style="margin: 0;padding: 0; width: 100%;">
                <tr>
                    <td style="width:70%"></td>
                    <td style="width:30%">Jember, 15 Desember 2023</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Direktur Imaji Sociopreneur</td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <img src="{{ public_path('images/ttd.png') }}" alt="" style="height: 150px"><br>
                        _____________
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Moch Musta'Anul Khusni</td>
                </tr>

            </table>

        </div>
    </div>
@endforeach
</body>
</html>
