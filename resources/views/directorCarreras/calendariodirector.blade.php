@extends('layouts.masterDirector')
@section('contenido')
    <div class="container card" style="text-transform: uppercase;">
        <div class="card-header card-header-primary">
            <h5 class="card-title text-center">Agenda de actividades</h5>
            <small class="form-text text-center">Se visualiza las actividades pendientes.</small>
        </div>
        <div id="agenda" class="card-body"></div>

    </div>
@endsection
@push('scripts')
    <script src="js/director/agendadirector.js"></script>
@endpush
<input type="hidden" name="route" value="{{ url('/') }}">
