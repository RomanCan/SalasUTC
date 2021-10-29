@extends('layouts.masterDocente')
@section('contenido')
    <div class="container card" style="text-transform: capitalize;">
        <div id="agenda" class="card-body"></div>

    </div>
@endsection
@push('scripts')
    <script src="js/docente/agenda.js"></script>
@endpush
<input type="hidden" name="route" value="{{ url('/') }}">
