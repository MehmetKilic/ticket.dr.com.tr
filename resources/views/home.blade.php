@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Tüm Ticketlar</h2></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="form-group">
                            <select data-column="3" name="filter-select" id="filter-select" class="form-control">
                                <option value="">Tümü</option>
                                <option value="1">Aktif</option>
                                <option value="0">Pasif</option>
                            </select>
                        </div>
                        <table class="table" id="datatable">
                            <thead>
                            <tr>
                                <th># ID</th>
                                <th style="width:80%;">Başlık</th>
                                <th>Durum</th>
                                <th style="display: none;">Durum</th>
                                <th>İşlem Yap</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->id }}</td>
                                    <td>{{ $ticket->title }}</td>
                                    <td>
                                        @if( $ticket->status == 1 )
                                            <button class="btn btn-warning">Beklemede</button>
                                        @else
                                            <button class="btn btn-default">Tamamlandı</button>
                                        @endif
                                    </td>
                                    <td style="display: none;">{{ $ticket->status }}</td>
                                    <td>
                                        <button data-id="{{ $ticket->id }}" onClick="ticketConfirm(this)" class="btn btn-success" id="ticketConfirm" @if( $ticket->status == 0 ) {{ 'disabled' }} @endif>Ticketı Tamamla</button>
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
@endsection

@section('javascripts')
    <script type="text/javascript" charset="utf8" src="public/js/dataTables.js" defer></script>
    <script>
        $(document).ready( function () {
            var table = $('#datatable').DataTable();

            // Duruma göre ticketlar listelenmek istediğinde status'e bakıyor
            $("#filter-select").change(function () {
                table.column( $(this).data('column') )
                    .search( $(this).val() )
                    .draw();
            });

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
