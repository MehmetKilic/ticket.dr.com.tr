@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Ticket Detayı</h2></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <ul>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('home') }}">Tüm Ticketlar</a></li>
                </ul>
            </div>
            <div class="col-md-8">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-size:20pt;">Başlık</label><br>
                                    <span>{{ $ticket->title }}</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-size:20pt;">İçerik</label><br>
                                    <span>{{ $ticket->content }}</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-size:20pt;">IP</label><br>
                                    <span>{{ $ticket->ip }}</span>
                                </div>
                            </div>
                            <button data-id="{{ $ticket->id }}" onClick="ticketConfirm(this)" id="ticketConfirm" class="btn btn-success btn-block" @if( $ticket->status == 0 ) {{ 'disabled' }} @endif>Ticketı Tamamla</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script>
        $(document).ready( function () {
            // Ticket'ı onaylama işlemini ajax işlemi ile gerçekleştiriyoruz
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        function ticketConfirm(elem){
            var id = $(elem).data("id");
            $.ajax({
                type:'POST',
                url:'{{ route('ticket.confirm') }}',
                data:{id:id},
                success:function(data){
                    alert('Başarıyla Ticket tamamlandı.');
                    location.reload();
                }
            });
        }
    </script>
@endsection