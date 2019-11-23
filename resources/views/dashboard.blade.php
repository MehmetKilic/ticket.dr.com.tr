@extends('layouts.app')
@section('styles')
    <link href="{{ asset('public/css/bootstrap-tagsinput.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Dashboard</h2></div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <ul>
                    <li><a href="{{ route('home') }}">Tüm Ticketlar</a></li>
                </ul>
                <div class="row">
                    <div class="col-md-4">
                        <div class="btn btn-default btn-lg btn-block">
                            <img src="/public/img/clipboard.png"><span style="font-size:34pt;margin-left:20%;">12</span><br><br>
                            Toplam Ticket Sayısı
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h4>Son Açılan 10 Ticket</h4></div>
                            <div class="panel-body">
                                <table class="table" id="datatable">
                                    <thead>
                                    <tr>
                                        <th># ID</th>
                                        <th style="width:80%;">Başlık</th>
                                        <th>Durum</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($activeTenTickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->id }}</td>
                                            <td><a href="{{ route('ticket.detail', $ticket->id) }}">{{ $ticket->title }}</a></td>
                                            <td>
                                                @if( $ticket->status == 1 )
                                                    <button class="btn btn-warning">Beklemede</button>
                                                @else
                                                    <button class="btn btn-default">Tamamlandı</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h4>7 Gündür Açık Olan Uzun Ticketlar</h4></div>
                            <div class="panel-body">
                                <table class="table" id="datatable">
                                    <thead>
                                    <tr>
                                        <th># ID</th>
                                        <th style="width:80%;">Başlık</th>
                                        <th>Durum</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($activeLongTickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->id }}</td>
                                            <td><a href="{{ route('ticket.detail', $ticket->id) }}">{{ $ticket->title }}</a></td>
                                            <td>
                                                @if( $ticket->status == 1 )
                                                    <button class="btn btn-warning">Beklemede</button>
                                                @else
                                                    <button class="btn btn-default">Tamamlandı</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h4>En Çok Kullanılan Tagler</h4></div>
                            <div class="panel-body">
                                @foreach($mostPopularTickets as $ticket)
                                    <a class="label label-info" href="{{ route('tag.detail', $ticket->tag) }}">{{ $ticket->tag }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
