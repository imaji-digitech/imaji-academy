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
@foreach($q3 as $index=>$user)
    @if($index!=0)
        <div style="page-break-before: always;"></div>
    @endif
    <div style="padding: 50px">
        <br><br>
        <div style="text-align: center">
            <img src="{{ public_path('images/half_image.png') }}" alt="" style="width: 90px;margin-right: 10px">
            <img src="{{ public_path('images/ia.png') }}" alt="" style="width: 90px;margin-right: 10px">
            <img src="{{ public_path('images/ymi.png') }}" alt="" style="width: 90px">
        </div>
        <div style="text-align: center">
            <h2 style="padding: 0;margin: 0">RAPOR HASIL PEMBELAJARAN SISWA</h2>
            <h3 style="padding: 0;margin: 0">{{$iaf->imajiAcademy->title}}</h3>
            <h3 style="padding: 0;margin: 0">Desa {{$iaf->imajiAcademy->village}}</h3>
        </div>
        <br><br>
        <div>
            <table style="margin: 0;padding: 0; width: 100%">
                <tr>
                    <td style="width: 15%">Nama Siswa</td>
                    <td style="width: 45%">: {{ $user->user->name }}</td>
                    <td style="width: 15%">Fitur</td>
                    <td style="width: 20%">: {{ $iaf->feature->title }}</td>
                </tr>
                <tr>
                    <td style="width: 15%">NIS</td>
                    <td style="width: 45%">: {{ $user->user->nis }}</td>
                    <td style="width: 15%">Semester</td>
                    <td style="width: 20%">: 1</td>
                </tr>
            </table>
        </div>
        <br><br>
        <div class="static">
            <table style="margin: 0;padding: 0; width: 100%;">
                <thead style="text-align: center">
                <tr>
                    <td rowspan="2" style="width: 5%">No</td>
                    <td rowspan="2">Nama</td>
                    <td colspan="2">Penilaian</td>
                </tr>
                <tr>
                    <td style="width: 15%"><b>Teori</b></td>
                    <td style="width: 15%"><b>Praktik</b></td>
                </tr>
                </thead>
                <tbody>
                @foreach($q1 as $q)
                    <tr>
                        <td style="text-align: center">1</td>
                        <td>{{$q->module}}</td>
                        <td style="text-align: center">{{ $col[$user->user_id][$q->module.'_teori'] }}</td>
                        <td style="text-align: center">{{ $col[$user->user_id][$q->module.'_praktik'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <br><br>
        <div class="static">
            <table style="margin: 0;padding: 0; width: 100%;">
                <tr style="border: 1px solid black;">
                    <td rowspan="2">
                        Sikap : <br>
                        Kedisiplinan :
                    </td>
                    <td>
                        Catatan tutor untuk diperhatikan oleh peserta didik dan orang tua/wali
                    </td>
                </tr>
                <tr>
                    <td>

                    </td>
                </tr>
            </table>
        </div>
        <br><br><br>
        <div>
            <table style="margin: 0;padding: 0; width: 100%;">
                <tr>
                    <td style="width:70%"></td>
                    <td style="width:30%">Jember, 11 januari 2022</td>
                </tr>
                <tr>
                    <td>Tutor Fitur</td>
                    <td>Direktur Imaji Sociopreneur</td>
                </tr>
                <tr>
                    <td>
                        <br><br><br><br><br>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>_____________</td>
                    <td>_____________</td>
                </tr>
                <tr>
                    <td>{{ $iaf->featureTeachers[0]->user->name }}</td>
                    <td>Moch Musta'Anul Khusni</td>
                </tr>

            </table>

        </div>
    </div>
@endforeach
</body>
</html>
