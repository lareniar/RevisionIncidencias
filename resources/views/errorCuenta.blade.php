@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Error, ese email no es valido. Vuelve a intentarlo con un email de Plaiaundi.</h2>
    <a href="{{ url('auth/google') }}" tyle="margin-top: 20px;" class="btn btn-success" >
        <strong>Cambiar de cuenta</strong>
      </a> 
</div>
@endsection