@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua">
                  <i class="fas fa-users"></i>
                </span>

              <div class="info-box-content">
                <span class="info-box-text">Usuários</span>
                <span class="info-box-number">{{ $totalUsers }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua">
                  <i class="fas fa-user-tie"></i>
                </span>

              <div class="info-box-content">
                <span class="info-box-text">Visitantes</span>
                <span class="info-box-number">{{ $totalGuests }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua">
                  <i class="fas fa-car"></i>
                </span>

              <div class="info-box-content">
                <span class="info-box-text">Veículos</span>
                <span class="info-box-number">{{ $totalVehicles }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div hidden class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua">
                  <i class="fas fa-hamburger"></i>
                </span>

              <div class="info-box-content">
                <span class="info-box-text"></span>
                <span class="info-box-number">{{-- {{ $totalProducts }} --}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

    </div>
@endsection
