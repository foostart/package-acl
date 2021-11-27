@extends('package-acl::admin.layouts.base-2cols')

@section('title')
    Internship
@stop

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3><i class="fa fa-dashboard"></i> Internship</h3>
            <hr/>
        </div>
        <div class="col-md-4">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nội dung</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td><a href="https://docs.google.com/spreadsheets/d/1v2eXhnEx4aVxHGzSY2-AnWNeSrkhpnHYca8HmgdlgwE/edit?usp=sharing">
                        Tài liệu hướng dẫn sử dụng hệ thống Internship
                    </a></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td><a href="https://drive.google.com/drive/folders/11JH_bLiEdd6dwEVltc1TVb7cC8lPfZ4n?usp=sharing">
                        Biểu mẫu thực tập
                    </a></td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td><a href="https://docs.google.com/spreadsheets/d/1thn1xTb76Y0eyGMw-7qFCNCuwlU03LM26agJfNq5n5k/edit?usp=sharing">
                        Gặp vấn đề, sự cố cần hỗ trợ
                    </a></td>
            </tr>
            </tbody>
        </table>
        </div>
        <div class="col-md-8"></div>
    </div>
@stop
