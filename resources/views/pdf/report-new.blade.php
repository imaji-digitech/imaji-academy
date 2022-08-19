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
@foreach($users as $index=>$user)
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
            <img src="{{ public_path('images/ymi.png') }}" alt="" style="width: 90px">
        </div>
        <div style="    text-align: center">
            <h2 style="padding: 0;margin: 0">RAPOR HASIL PEMBELAJARAN SISWA</h2>
            <h3 style="padding: 0;margin: 0">{{ $imajiAcademy->title }}</h3>
            <h3 style="padding: 0;margin: 0">{{ $imajiAcademy->village }}</h3>
        </div>
        <br>
        <div>
            <table style="margin: 0;padding: 0; width: 100%">
                <tr>
                    <td style="width: 15%">Nama Siswa</td>
                    <td style="width: 45%">: {{ $user->name }}</td>
                    <td style="width: 15%">NIS</td>
                    <td style="width: 45%">: {{ $user->nis }}</td>
                </tr>
                <tr>
                    <td style="width: 15%">Semester</td>
                    <td style="width: 20%">: 1</td>
                </tr>
            </table>
        </div>
        <br>
        <div class="static">
            <table style="margin: 0;padding: 0; width: 100%;">
                <thead style="text-align: center">
                <tr>
                    <td rowspan="2" style="width: 5%">No</td>
                    <td rowspan="2">Materi kelas fitur</td>
                    <td colspan="2">Penilaian</td>
                </tr>
                <tr>
                    <td style="width: 15%"><b>Teori</b></td>
                    <td style="width: 15%"><b>Praktik</b></td>
                </tr>
                </thead>
                <tbody>
                @php
                    $total_practice=0;
                    $total_theory=0;
                    $c=0
                @endphp
                @foreach($user->featureStudents as $index=>$q1)
                    <tr style="font-weight: bold">
                        <td style="text-align: center">{{ $alphabet[$index] }}</td>
                        <td>{{$q1->imajiAcademyFeature->feature->title}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach($q1->imajiAcademyFeature->featureScores as $index2=>$q2)
                        <tr>
                            <td style="text-align: center">{{ $index2+1 }}</td>
                            <td>{{ $q2->module }}</td>
                            @php
                                $score=\App\Models\FeatureScoreStudent::whereUserId($user->id)->whereFeatureScoreId($q2->id)->first();
if (isset($score->score_practice)){
                                $total_practice+=$score->score_practice;
                                $total_theory+=$score->score_theory;
                                $c+=1;
}

                            @endphp
                            <td style="text-align: center">@isset($score->score_practice){{ $score_practice[$score->score_practice] }}@endisset</td>
                            <td style="text-align: center">@isset($score->score_practice){{ $score_theory[$score->score_theory] }}@endisset</td>
                        </tr>
                    @endforeach
                @endforeach
                <tr style="font-weight: bold">
                    <td style="text-align: center"></td>
                    <td>RATA-RATA</td>
                    <td style="text-align: center">@if($total_practice!=0){{ $score_practice[round($total_practice/$c)] }}@endif</td>
                    <td style="text-align: center">@if($total_theory!=0){{ $score_theory[round($total_theory/$c)] }}@endif</td>
                </tr>
                </tbody>
            </table>
        </div>
        <br><br>
        <div class="static">
            <table style="margin: 0;padding: 0; width: 100%;">
                <tr style="border: 1px solid black;">
                    <td rowspan="2">
                        {{--                    <td>--}}
                        @php($iaff=[])
                        @php($iafp=[])
                        @foreach($user->featureStudents as $ias)
                            @php($iaff[$ias->iaf_id]=0)
                            @php($iafp[$ias->iaf_id]=0)
                        @endforeach
                        @foreach($user->featureActivityPresences as $fap)
                            @php($iaff[$fap->featureActivity->iaf_id]+=1)
                            @if($fap->presence_status_id==1)
                                @php($iafp[$fap->featureActivity->iaf_id]+=1)
                            @endif
                        @endforeach
                        @php( $total=0 )
                        @php( $count=0 )
                        @foreach($iaff as $index=>$a)
                            @php($total+=$iafp[$index])
                            @php($count+=$a)
                        @endforeach
                        @php($attitude_title=['-','Sangat Baik','Baik','Cukup'])
                        @isset($user->featureReports)
                        Sikap : <br> {{ $attitude_title[round($user->featureReports->sum('attitude')/$user->featureReports->count())] }}
                            <br>
                        @endisset
                        Kedisiplinan : <br> {{($total/$count*100>=80?'Sangat disiplin':($total/$count*100)>=60)?'Disiplin':'Cukup'}}
                        <br>

                    </td>
                    <td>
                        Catatan tutor untuk diperhatikan oleh peserta didik dan orang tua/wali
                    </td>
                </tr>
                <tr>
                    <td>
                        @isset($user->featureReports)
                        @foreach( $user->featureReports as $fr )
                            {{ $fr->imajiAcademyFeature->feature->title }}: <br>
                            {{ $fr->note }} <br>
                        @endforeach
                            @endisset
                    </td>
                </tr>
            </table>
        </div>
        <br><br>
        <div>
            <table style="margin: 0;padding: 0; width: 100%;">
                <tr>
                    <td style="width:70%"></td>
                    <td style="width:30%">Jember, 11 januari 2022</td>
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
