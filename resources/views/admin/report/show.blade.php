@extends('layouts.admin')

@section('title')
Product Comment | {{ App\Models\Generalsetting::find(1)->site_name }}
@endsection

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
            Product Comment
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="table-responsive show-table">
                    <table>
                        <tr>
                            <th>Reporter</th>
                            <td>{{$data->user->name}}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{$data->user->email}}</td>
                        </tr>
                        @if($data->user->phone != "")
                        <tr>
                            <th>Phone:</th>
                            <td>{{$data->user->phone}}</td>
                        </tr>
                        @endif

                        <tr>
                            <th>Reported at:</th>
                            <td>{{ date('d-M-Y h:i:s',strtotime($data->created_at))}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
            <h5>
                Title:
                </h5>
                <p> 
                    {{$data->title}}
                </p>

            <h5>
                Note:
                </h5>
                <p> 
                    {{$data->note}}
                </p>

            </div>           
        </div>
    </div>    
    </div>
</div>
@endsection