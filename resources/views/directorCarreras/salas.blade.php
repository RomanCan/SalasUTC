@extends('layouts.masterDirector')

@section('contenido')
    <h1>Salas</h1>
    <section>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-borderless">
                    <thead>
                        <th>Nombre</th>
                        <th>Cupo</th>

                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

@endpush

<input type="hidden" name="route" value="{{ url('/') }}">
