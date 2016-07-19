@extends('layouts.default')

@section('page-title')
    Dashboard
@stop

@push('page-js')
    <script src="{{ URL::asset('assets/js/Chart.js') }}"></script>
    <script>
var ctx = document.getElementById("myChart");
data = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
            label: "My First dataset",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(75,192,192,0.4)",
            borderColor: "rgba(75,192,192,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: [65, 59, 80, 81, 56, 55, 40],
        }
    ]
};
var myChart = new Chart(ctx, {
    type: 'line',
    data: data,

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
