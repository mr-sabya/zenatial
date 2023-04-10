@extends('layouts.vendor')

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
                Dashboard
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{count($pending)}}</h3>

        <p>Pending Orders</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="{{route('vendor-order-index', 'pending')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ count($user->products) }}</h3>

        <p>Total Products</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="{{route('admin-prod-index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{ App\Models\Order::where('status','=','completed')->get()->count() }}</h3>

        <p>Completed Orders</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="{{route('vendor-order-index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{ App\Models\Product::vendorConvertPrice( App\Models\VendorOrder::where('user_id','=',$user->id)->where('status','=','completed')->sum('price') ) }}</h3>

        <p>Total Earnings</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="{{route('admin-user-index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
</div>
<!-- /.row -->

<div class="row">
  <div class="col-md-12">
    <!-- Custom tabs (Charts with tabs)-->
    <div class="card">
    <div class="card-header">
      <h3 class="card-title">
        <i class="fas fa-chart-pie mr-1"></i>
        Orders in Last 30 days
      </h3>
    </div><!-- /.card-header -->
    <div class="card-body">
      <div class="tab-content p-0">
        <!-- Morris chart - Sales -->
        <div class="chart tab-pane active" id="revenue-chart"
              style="position: relative; height: 300px;">
            <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>                         
          </div>  
      </div>
    </div><!-- /.card-body -->
  </div>
  <!-- /.card --> 
  </div>
</div>
@endsection


@section('scripts')
<script>
/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(function () {

'use strict'

/* Chart.js Charts */
// Sales chart
var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');
//$('#revenue-chart').get(0).getContext('2d');

var salesChartData = {
  labels  : [],
  datasets: [
    {
      label               : 'Sold',
      backgroundColor     : 'rgba(60,141,188,0.9)',
      borderColor         : 'rgba(60,141,188,0.8)',
      pointRadius          : 5,
      pointColor          : '#ff0000',
      pointStrokeColor    : 'rgba(60,141,188,1)',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      data                : []
    }
  ]
}

var salesChartOptions = {
  maintainAspectRatio : false,
  responsive : true,
  title: {
      display: false
    },  
  legend: {
    display: false
  },
  scales: {
    xAxes: [{
      gridLines : {
        display : false,
      }
    }],
    yAxes: [{
      gridLines : {
        display : false,
      },
      ticks: {
        beginAtZero: true,
        suggestedMin: 10
      }      
    }]
  }
}

// This will get the first returned node in the jQuery collection.
var salesChart = new Chart(salesChartCanvas, { 
    type: 'line', 
    data: salesChartData, 
    options: salesChartOptions
  }
)
    

})
</script>
@endsection