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
        @foreach(\App\Models\ImajiAcademy::get() as $im)
            @isset($activity[$im->id])
            <div class="col-lg-6 col-md-12 col-sm-6 col-12">
                <div>
                    <h1 class="text-primary text-title font-weight-bold " style="font-size: 20px">Aktifitas {{$im->title}}</h1>
                    <canvas id="activity{{$im->id}}" height="150"></canvas>
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

                            var statistics_chart = document.getElementById("activity{{$im->id}}").getContext('2d');
                            @foreach($activity[$im->id] as $key=>$val)
                            var data{{\Illuminate\Support\Str::slug($key)}} = [
                                @foreach($val as $a)
                                    {{$a}},
                                @endforeach
                            ];
                            @endforeach
                            var borderColor = ['#FAA255', '#F0C348', '#E27CF1', '#F562AC', '#EB5959', '#9EE67A', '#50D989', '#66CFF2', '#7F7CE6'];
                            borderColor = shuffle(borderColor);
                            new Chart(statistics_chart, {
                                type: 'bar',
                                data: {
                                    labels: [
                                        @for($i=1;$i<=$max[$im->id];$i++)
                                            'Pertemuan {{$i}}',
                                        @endfor
                                    ],
                                    datasets: [
                                            @php($l=0)
                                            @foreach($activity[$im->id] as $key=>$val)
                                        {
                                            @php($l+=1)
                                            label: '{{\Illuminate\Support\Str::slug($key)}}',
                                            data: data{{\Illuminate\Support\Str::slug($key)}},
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
                </div>
            </div>
            @endisset
        @endforeach
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">

        </div>
    </div>
</div>
