@extends('layouts.admin')

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
      <a href="{{route('admin-order-index', 'pending')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{count($products)}}</h3>

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
      <a href="{{route('admin-order-index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{ App\Models\User::count() }}</h3>

        <p>Total Customers</p>
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

<div class="row row-cards-one">
    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <h5 class="card-header">Popular Product(s)</h5>
            <div class="card-body">
                <div class="table-responsiv  dashboard-home-table">
                    <table id="poproducts" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Featured Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($poproducts as $data)
                            <tr>
                                <td><img style="width:100px; height: auto;" src="{{filter_var($data->photo, FILTER_VALIDATE_URL) ?$data->photo:asset('assets/images/products/'.$data->photo)}}"></td>
                                <td>{{  mb_strlen(strip_tags($data->name),'utf-8') > 50 ? mb_substr(strip_tags($data->name),0,50,'utf-8').'...' : strip_tags($data->name) }}</td>
                                <td>{{ $data->category->name }}
                                    @if(isset($data->subcategory))
                                    <br>
                                    {{ $data->subcategory->name }}
                                    @endif
                                    @if(isset($data->childcategory))
                                    <br>
                                    {{ $data->childcategory->name }}
                                    @endif
                                </td>
                                <td> {{ $data->showPrice() }} </td>
                                <td>
                                    <div class="action-list"><a href="{{ route('admin-prod-edit',$data->id) }}">View</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row row-cards-one">
    <div class="col-md-6 col-lg-6 col-xl-6">
        <div class="card">
            <h5 class="card-header">Recent Product(s)</h5>
            <div class="card-body">
                <div class="my-table-responsiv">
                <table id="pproducts" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>Featured Image</th>
                          <th>Name</th>
                          <th>Category</th>
                          <th>Price</th>
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($pproducts as $data)
                      <tr>
                          <td><img style="width:70px; height: auto;" src="{{filter_var($data->photo, FILTER_VALIDATE_URL) ?$data->photo:asset('assets/images/products/'.$data->photo)}}"></td>
                          <td>{{  mb_strlen(strip_tags($data->name),'utf-8') > 50 ? mb_substr(strip_tags($data->name),0,50,'utf-8').'...' : strip_tags($data->name) }}</td>
                          <td>{{ $data->category->name }}
                              @if(isset($data->subcategory))
                              <br>
                              {{ $data->subcategory->name }}
                              @endif
                              @if(isset($data->childcategory))
                              <br>
                              {{ $data->childcategory->name }}
                              @endif
                          </td>
                          <td> {{ $data->showPrice() }} </td>
                          <td>
                            <div class="action-list"><a href="{{ route('admin-prod-edit',$data->id) }}">View</a>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-6">
        <div class="card">
            <h5 class="card-header">Recent Customer(s)</h5>
            <div class="card-body">
                <div class="my-table-responsiv">
                    <table class="table table-hover dt-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Customer Email</th>
                                <th>Joined</th>
                            </tr>
                            @foreach($rusers as $data)
                            <tr>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td>
                                    <div class="action-list"><a href="{{ route('admin-user-show',$data->id) }}"> View</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </thead>
                    </table>
                </div>
            </div>
        </div>
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
  labels  : [{!!$days!!}],
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
      data                : [{!!$sales!!}]
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