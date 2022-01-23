@extends('package-acl::admin.layouts.base-2cols')

@section('title')
    Internship
@stop

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3><i class="fa fa-dashboard"></i> Dashboard</h3>
            <hr/>
        </div>
        <div class="col-md-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Laravel</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Link 1</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Link 2</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Link 3</td>
                </tr>
            </tbody>
        </table>
        </div>
        <div class="col-md-8"></div>
    </div>
@stop
