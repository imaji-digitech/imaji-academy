@php use App\Models\ImajiAcademy;use App\Models\ImajiAcademyFeature; @endphp
<div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Karya anak didik</h4>
                    </div>
                    <div class="card-body">
                        0
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Murid</h4>
                    </div>
                    <div class="card-body">
                        {{ $data['student'] }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Imaji Academy</h4>
                    </div>
                    <div class="card-body">
                        {{$data['imajiAcademy']}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($year as $y)
            @if(ImajiAcademyFeature::whereYearProgram($y)->first()!=null)
                <div class="col-md-12 mb-2 mt-3">
                    <h1 style="font-size: 25px; text-transform: uppercase; padding-left: 20px"><b>{{ $y }}</b></h1>
                    <div style="width: 100%; height: 5px;" class="bg-primary rounded"></div>
                </div>
            @endif
            @foreach($semester as $s)
                @if(ImajiAcademyFeature::whereYearProgram($y)->whereSemester($s)->first()!=null)
                    <div class="col-md-12 mb-2">
                        <h1 style="font-size: 25px; text-transform: uppercase; padding-left: 20px"><b>{{ $s }}</b></h1>
                        <div style="width: 15%; height: 5px;" class="bg-primary rounded"></div>
                    </div>
                @endif
                @foreach(ImajiAcademy::get() as $im)
                    @php
                        $d=$this->getActivity($im->id,$y,$s);
                    @endphp
                    @if(ImajiAcademyFeature::whereImajiAcademyId($im->id)->whereYearProgram($y)->whereSemester($s)->first()!=null)
                        <div class="col-lg-6 col-md-12 col-sm-6 col-12">
                            <div class="bg-white m-1 p-3 shadow rounded">
                                <h1 class="text-primary text-title font-weight-bold " style="font-size: 20px">
                                    Aktifitas {{$im->title}}</h1>
                                @isset($d[0])
                                    <canvas id="activity{{$im->id}}{{$im->y}}{{$im->s}}" height="150"></canvas>
                                    <script>
                                        window.addEventListener('DOMContentLoaded', function () {
                                            function shuffle(array) {
                                                var currentIndex = array.length, randomIndex;
                                                while (currentIndex != 0) {
                                                    randomIndex = Math.floor(Math.random() * currentIndex);
                                                    currentIndex--;
                                                    [array[currentIndex], array[randomIndex]] = [
                                                        array[randomIndex], array[currentIndex]];
                                                }
                                                return array;
                                            }

                                            var statistics_chart = document.getElementById("activity{{$im->id}}{{$im->y}}{{$im->s}}").getContext('2d');
                                            @foreach($d[0] as $key=>$val)
                                            var data{{$key}} = [
                                                @foreach($val as $a)
                                                        {{$a}},
                                                @endforeach
                                            ];
                                            @endforeach
                                            var borderColor = [
                                                '#FAA255',
                                                '#F0C348',
                                                '#E27CF1',
                                                '#F562AC',
                                                '#EB5959',
                                                '#9EE67A',
                                                '#50D989',
                                                '#66CFF2',
                                                '#7F7CE6',
                                            ];
                                            borderColor = shuffle(borderColor);
                                            new Chart(statistics_chart, {
                                                type: 'bar',
                                                data: {
                                                    labels: [
                                                        @for($i=1;$i<=$d[1];$i++)
                                                            'Pertemuan {{$i}}',
                                                        @endfor
                                                    ],
                                                    datasets: [
                                                            @php($l=0)
                                                            @foreach($d[0] as $key=>$val)
                                                        {
                                                            @php($l+=1)
                                                            label: '{{$key}}',
                                                            data: data{{$key}},
                                                            borderWidth: 5,
                                                            borderColor: borderColor[{{$l}}],
                                                            backgroundColor: borderColor[{{$l}}] + '44',
                                                            pointBackgroundColor: '#fff',
                                                            pointBorderColor: borderColor[{{$l}}],
                                                            pointRadius: 3
                                                        },
                                                        @endforeach
                                                    ]
                                                },
                                                options: {
                                                    scales: {
                                                        yAxes: [{
                                                            ticks: {
                                                                beginAtZero: true
                                                            }
                                                        }]
                                                    }
                                                }
                                            });
                                        });
                                    </script>
                                @endisset
                            </div>
                        </div>

                    @endif
                @endforeach
            @endforeach
        @endforeach
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">

        </div>
    </div>
</div>
