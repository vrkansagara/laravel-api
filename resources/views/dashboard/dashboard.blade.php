@extends('layouts.app')

@section('wrapper-class','animated fadeInRight')
@section('navbar-extra-class','white-bg')

@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Total Users</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $totalUsers }}</h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Total Active Users</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $activeUsers }}</h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Total Inactive Users</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $inActiveUsers }}</h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Total Roles</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $totalRoles }}</h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Total Permissions</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $totalPermissions }}</h1>
                </div>
            </div>
        </div>

    </div>
@endsection


