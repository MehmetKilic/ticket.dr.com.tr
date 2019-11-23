@extends('layouts.app')
@section('styles')
    <link href="{{ asset('public/css/bootstrap-tagsinput.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.alert')
                <div class="panel panel-default">
                    <div class="panel-heading lead" style="text-align: center;">Ticket Oluştur</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('ticket') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="text" class="col-md-12 control-label">Ticket Başlığı</label>

                                <div class="col-md-12">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label for="content" class="col-md-12 control-label">Ticket Konusu</label>

                                <div class="col-md-12">
                                    <textarea id="content" name="content" class="form-control" required></textarea>

                                    @if ($errors->has('content'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                                <label for="text" class="col-md-12 control-label">Etiket</label>

                                <div class="col-md-12">
                                    <input type="text" value="" name="tags" data-role="tagsinput" id="tags" class="form-control">
                                    @if ($errors->has('tag'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-4">
                                    <button type="submit" class="btn btn-success btn-block">
                                        Kaydı Oluştur
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
@endsection