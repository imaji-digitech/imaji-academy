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
    @if($index!=0)
        {{--                @php--}}
        {{--                    break--}}
        {{--                @endphp--}}
        <div style="page-break-before: always;"></div>
    @endif

    <div style="padding: 50px">
        <br>
        <div style="text-align: center">
            <img src="{{ public_path('images/half_image.png') }}" alt="" style="width: 90px;margin-right: 10px">
            <img src="{{ public_path('images/ia.png') }}" alt="" style="width: 90px;margin-right: 10px">
            {{--            <img src="{{ public_path('images/ymi.png') }}" alt="" style="width: 90px">--}}
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


                @foreach($iaf->featureScores as $index2=>$q2)
                    <tr>
                        <td style="text-align: center">{{ $index2+1 }}</td>
                        <td>{{ $q2->module }}</td>
                        @php
                            $score=FeatureScoreStudent::whereStudentId($user->student->id)->whereFeatureScoreId($q2->id)->first();
//                            dd($score)
                        @endphp
                        <td style="text-align: center">
                            @if($score!=null)
                                @if($score->score<84)
                                    A
                                @elseif($score->score<70)
                                    B
                                @elseif($score->score<60)
                                    C
                                @else
                                    D
                                @endif
                            @endif
                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <br><br>
        @isset($user->student->featureReports)
            @if($user->student->featureReports!=null)
        <div class="static">
            <table style="margin: 0;padding: 0; width: 100%;">
                <tr style="border: 1px solid black;">
                    <td>
                        Catatan tutor untuk diperhatikan oleh peserta didik dan orang tua/wali
                    </td>
                </tr>
                <tr>
                    <td>
                        @isset($user->student->featureReports)
                            @foreach( $user->student->featureReports as $fr )
                                {{ $fr->imajiAcademyFeature->feature->title }}: <br>
                                {{ $fr->note }} <br>
                            @endforeach
                        @endisset
                    </td>
                </tr>
            </table>
        </div>
            @endif
        @endisset
        <br><br>
        <div>
            <table style="margin: 0;padding: 0; width: 100%;">
                <tr>
                    <td style="width:70%"></td>
                    <td style="width:30%">Jember, 9 Desember 2022</td>
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
