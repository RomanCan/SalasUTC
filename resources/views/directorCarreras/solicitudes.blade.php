@extends('layouts.masterDirector')

@section('contenido')
    <div>
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="js/director/solicitudes.js"></script>
@endpush

<input type="hidden" name="route" value="{{ url('/') }}">
