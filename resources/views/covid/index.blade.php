@extends('layouts.app')
@section('content')
    @php
    // дэлхийн хэмжээний мэдээлэл авах
    $global = $response->Global;
    // Монгол улсыг авсан жишээ
    $mongolia = ((array)$response->Countries)[114];
    $test = ((array)$dayone);
    // өнөөдрийн он сар өдөр
    $date = date('y/m/d', strtoTime($test[count($test)-1] ->Date));
    // $date = DateTime::createFromFormat('ymd',$test);
    $cases = array();
    $casesDate = array();
    $casesDeaths = array();
    $casesRecovered = array();
    function getResponse($response, $dayone){
        global $cases, $casesDate, $casesDeaths, $casesRecovered;
        
        // Эхний өдрөөс хойших тухайн улсад бүртгэгдсэн нийт батлагдсан тохиолдлуудын массив
        $cases = array();
        // Эхний өдрөөс хойших тухайн улсад бүртгэгдсэн тохиолдлуудтай харгалзах он сар өдөр
        $casesDate = array();
        $casesDeaths = array();
        $casesRecovered = array();
        foreach ($dayone as &$item){
            $caseDate = date('Y-m-d', strtoTime($item->Date));
            // print_r($item->Confirmed);
            array_push($cases, $item->Confirmed);
            array_push($casesDate, $caseDate);
            // Тухайн өдөр ороод нийт нас барсан хүний тоо
            array_push($casesDeaths, $item->Deaths);
            // Тухайн өдөр орсон эдгэрсэн хүний тоо
            array_push($casesRecovered, $item->Recovered);
            // {{-- @if ($loop->index == 20)
                //     @break
                // @endif --}}
        }
    }
    
    global $cases, $casesDate, $casesDeaths, $casesRecovered;
    getResponse($response, $dayone);
    @endphp
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> --}}
    {{-- {{json_encode($cases)}}
    {{json_encode($casesDate)}} --}}
    <div class="grid grid-cols-6 gap-4">
        {{-- {{$mongolia->Date}}<br> --}}
        <div class="col-start-2 col-span-4 grid grid-cols-6 gap-4 ">
            <div class="col-span-6">{{/* $global->Date */$date}} байдлаар</div>
            <div class="col-span-6">Дэлхийд</div>
            {{-- Үндсэн контент эхлэл --}}
            <div class="col-span-6 rounded border border-gray-700 text-center md:col-span-3 lg:col-span-2">
                <div>Нийт батлагдсан</div>
                <div>{{$global->TotalConfirmed}}</div>
            </div>
            <div class="col-span-6 rounded border border-gray-700 text-center md:col-span-3 lg:col-span-2">
                <div>Нийт нас барагсад</div>
                <div>{{$global->TotalDeaths}}</div>
            </div>
            <div class="col-span-6 rounded border border-gray-700 text-center md:col-span-3 lg:col-span-2">
                <div>Нийт эдгэрсэн</div>
                <div>{{$global->TotalRecovered}}</div>
            </div>
            <div class="col-span-6 rounded border border-gray-700 text-center md:col-span-3 lg:col-span-2">
                <div>Шинээр батлагдсан</div>
                <div>{{$global->NewConfirmed}}</div>
            </div>
            <div class="col-span-6 rounded border border-gray-700 text-center md:col-span-3 lg:col-span-2">
                <div>Шинээр нас барсан тоо</div>
                <div>{{$global->NewDeaths}}</div>
            </div>
            <div class="col-span-6 rounded border border-gray-700 text-center md:col-span-3 lg:col-span-2">
                <div>Шинээр эдгэрсэн</div>
                <div>{{$global->NewRecovered}}</div>
            </div>
            {{-- Mongolia --}}
            <div class="col-span-6">{{-- {{$mongolia->Country}} --}} Монгол улсад<br></div>
            {{-- <div class="col-span-3">{{$date}} <br></div> --}}
            <div class="col-span-6 rounded border border-gray-700 text-center md:col-span-3 lg:col-span-2">
                <div>Нийт батлагдсан</div>
                <div>{{$mongolia->TotalConfirmed}}</div>
            </div>
            <div class="col-span-6 rounded border border-gray-700 text-center md:col-span-3 lg:col-span-2">
                <div>Нийт нас барагсад</div>
                <div>{{$mongolia->TotalDeaths}}</div>
            </div>
            <div class="col-span-6 rounded border border-gray-700 text-center md:col-span-3 lg:col-span-2">
                <div>Нийт эдгэрсэн</div>
                <div>{{$mongolia->TotalRecovered}}</div>
            </div>
            <div class="col-span-6 rounded border border-gray-700 text-center md:col-span-3 lg:col-span-2">
                <div>Шинэээр батлагдсан</div>
                <div>{{$mongolia->NewConfirmed}}</div>
            </div>
            <div class="col-span-6 rounded border border-gray-700 text-center md:col-span-3 lg:col-span-2">
                <div>Шинээр нас барсан тоо</div>
                <div>{{$mongolia->NewDeaths}}</div>
            </div>
            <div class="col-span-6 rounded border border-gray-700 text-center md:col-span-3 lg:col-span-2">
                <div>Шинээр эдгэрсэн</div>
                <div>{{$mongolia->NewRecovered}}</div>
            </div>
            <div class="chart-container col-span-6" style="position: relative; height:40vh;">
                <form action="">
                    @csrf {{-- {{ csrf_field() }} --}}
                    <select name="Country" id="Country" onchange="sendAjaxRequest()">
                        @foreach ($response->Countries as $item)
                            @if ($item->Slug == 'mongolia')
                                <option value="{{$item->Slug}}" selected>{{$item->Country}}</option>
                                
                            @endif
                            <option value="{{$item->Slug}}">{{$item->Country}}</option>
                        @endforeach
                    </select>
                </form>
                
            <canvas id="chart" style="z-index: -1;">
                <div style="height: 100%; width: 100%; background-color:green; z-index:2;" id="chartLoader">chart loading</div>
                <img src="https://i.imgur.com/fXUIBfi.gif" alt="Chart will Render Here..." id="myloader"/>
            </canvas>
            </div>
            <!-- Charting library -->
            {{-- <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
            <!-- Chartisan -->
            <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script> --}}

            {{-- <script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script> --}}
            <!-- Chartisan -->
            {{-- <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist   /chartisan_chartjs.umd.js"></script> --}}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js" charset="utf-8"></script>
            <script>
                
                var cases1 = '<?php echo json_encode($cases); ?>';
                var cases2 = cases1.substring(1, cases1.length-1);
                var cases = cases2.split(",");

                var cases1Date = '<?php echo json_encode($casesDate); ?>';
                var cases2Date = cases1Date.substring(1, cases1Date.length-1);
                var casesDate = cases2Date.split(",");

                var cases1Deaths = '<?php echo json_encode($casesDeaths); ?>';
                var cases2Deaths = cases1Deaths.substring(1, cases1Deaths.length-1);
                var casesDeaths = cases2Deaths.split(",");

                var cases1Recovered = '<?php echo json_encode($casesRecovered); ?>';
                var cases2Recovered = cases1Recovered.substring(1, cases1Recovered.length-1);
                var casesRecovered = cases2Recovered.split(",");

                var country = '<?php echo ((array)$dayone)[0]->Country;?>';
                var chart1 = new Chart(document.getElementById('chart'), {
                    type: 'line',
                    data: {
                        labels: casesDate,
                        datasets: [{ 
                            data: 
                                cases
                            ,
                            label: country,
                            borderColor: "#3e95cd",
                            fill: false
                        }
                        ]
                    },
                    options: {
                        tooltips:{
                            callbacks:{
                                title: function(t, d){
                                    // return 'sda';
                                    return d.labels[t[0].index];
                                },
                                label: function(t, d){
                                    // return 'ee';
                                    var a = ['Нийт батлагдсан: ' + d.datasets[0].data[t.index]];
                                    if(t.index != 0){
                                        a.push('Шинээр батлагдсан: ' + (d.datasets[0].data[t.index] - d.datasets[0].data[t.index-1]));
                                        a.push('Нийт нас барсан: ' + casesDeaths[t.index]);
                                        a.push('Шинээр нас барсан: ' + (casesDeaths[t.index] - casesDeaths[t.index-1]));
                                        a.push('Нийт эдгэрсэн: ' + casesRecovered[t.index]);
                                        a.push('Шинээр эдгэрсэн: ' + (casesRecovered[t.index] - casesRecovered[t.index-1]));
                                    }
                                    return a;
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: 'Улсын ковид граф',
                        },
                        scales:{
                            xAxes:[{
                                type: 'time',
                                time:{
                                    parser: "YYYY-MM-DD",
                                    displayFormats:{
                                        // day: "YY MMM D",
                                        day: "YY MMM D",
                                        hour: "hA",
                                        millisecond: "h:mm:ss.SSS a",
                                        minute: "h:mm a",
                                        month: "MMM YYYY",
                                        quarter: "[Q]Q - YYYY",
                                        second: "h:mm:ss a",
                                        week: "ll",
                                        year: "YYYY",
                                    },
                                    unit: 'day',
                                    unitStepSize: 30,
                                    // tooltipFormat: 'YYYY MM DD'
                                    // unitStepSize: 1,
                                    // displayFormats:{
                                    //     day: 'MMM DD', 
                                    // }
                                },
                            }],
                        },
                    },
                });
                // window.addEventListener('beforeprint', () => {
                //     chart1.resize(600, 600);
                // });
                // window.addEventListener('afterprint', () => {
                //     myChart.resize();
                // });
                function addData(chart, label, data) {
                    chart.data.labels = label;
                    // chart.data.datasets.forEach((dataset) => {
                    //     dataset.data.push(data);
                    // });
                    chart.data.datasets[0].data = data;
                    chart.data.datasets[0].label = country;
                    // console.log();
                    
                    chart.update();
                    document.getElementById("chartLoader").classList.remove("myfront");
                }

                function removeData(chart) {
                    chart.data.labels.splice(0, chart.data.labels.length);
                    chart.data.datasets.forEach((dataset) => {
                        dataset.data.splice(0, dataset.data.length);
                    });
                    // chart.update();
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                // console.log($('meta[name="csrf-token"]').attr('content'));
                function sendAjaxRequest(){
                    document.getElementById("chartLoader").classList.add("myfront");
                    sendAjaxRequest2();
                }
                function sendAjaxRequest2() {
                    var val = $('#Country').val();
                    $.ajax({
                        type: "POST",
                        url: "",
                        // headers:{
                        //     'slug': val,
                        // },
                        data:{
                            slug : val, 
                        },
                        success: function(data){
                            console.log('bi irlee');
                            // var b = '<?php getResponse($response, $dayone);?>';
                            // console.log(data.dayone);
                            cases = [];
                            casesDate = [];
                            casesDeaths = [];
                            casesRecovered = [];
                            country = data.dayone[0].Country;
                            $.each(data.dayone, function(i){
                                cases.push(this.Confirmed);
                                casesDate.push(dateToYMD(new Date(this.Date)));
                                casesDeaths.push(this.Deaths);
                                casesRecovered.push(this.Recovered);
                            });
                            addData(chart1, casesDate, cases);
                        }
                    });
                }
                function dateToYMD(date) {
                    var d = date.getDate();
                    var m = date.getMonth() + 1; //Month from 0 to 11
                    var y = date.getFullYear();
                    return '' + y + '-' + (m<=9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d);
                }
                function formatDate(date) {
                    var d = new Date(date),
                        month = '' + (d.getMonth() + 1),
                        day = '' + d.getDate(),
                        year = d.getFullYear();

                    if (month.length < 2) 
                        month = '0' + month;
                    if (day.length < 2) 
                        day = '0' + day;

                    return [year, month, day].join('-');
                }
                // window.onload = function() {
                //     var ctx = document.getElementById("chart").getContext("2d");
                //     window.myLine = getNewChart(ctx, chart1);
                // };
                    
                // function getNewChart(canvas, config) {
                //     return new Chart(canvas, config);
                // }
                // chart.destroy();
            </script>
        </div>
    </div>
@endsection