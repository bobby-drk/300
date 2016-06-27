@extends('layouts.default')

@section('page-title')
    Dashboard
@stop

@push('page-js')
    <script src="{{ URL::asset('assets/js/Chart.js') }}"></script>
    <script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
@endpush()


@section('content')
<!--    <div class="row well strong_small_boarder">-->
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Payment Chart</h3>
            </div>
            <div class="panel-body">
                <table class='table table-striped'>
                    <tr>
                        <th>Bowler</th>
                        <th>Pay Ratio</th>
                        <th>Last Paid</th>
                    </tr>
                    @var('i', 0)
                    @foreach($balance_ratio as $id => $user)
                    <tr @if($i == 0)
                        class='danger'
                        @elseif ($i == 1)
                            class='warning'
                        @endif >
                        <td >{{$user->first_name}} @if ($user->id == Auth::id()) - <a href="{{ route("mybalance") }}">My Balance</a>@endif</td>
                        <td >{{number_format($user->pay_ratio, 3)}}</td>
                        <td >
                            @if(isset($paid_dates[$user->id]))
                                {{ $paid_dates[$user->id] }}
                            @else
                                &nbsp;
                            @endif
                        </td>
                    </tr>
                    <!-- {{ $i++ }} -->
                    @endforeach
                </table>
                    <br />
                <div class="panel-footer">* 1 means fully paid, fully played</div>
            </div>
        </div>

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Bowling Scores Info</h3>
            </div>
            <div class="panel-body">
                <table class='table'>
                    <tr>
                        <th>PR</th>
                        <th>Average</th>
                    </tr>
                    <tr >
                        <td >{{$pr}}</td>
                        <td >{{round($avg)}}</td>
                    </tr>
                </table>
                <br />
                <div>
                    Bowling Scores over time graph
                    
                    <canvas id="myChart" width="400" height="400"></canvas>

                </div>
            </div>
        </div>


    <!--</div>-->
@stop
