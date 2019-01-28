@extends ( 'template' )
@section('description')
<meta name="description" content="évènements" />
@endsection
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/event.css">
@endsection

@section ( 'content' )

<h3 id="page"> {{ $h3 }} </h3>

<div id="rowButton">
<a href="{{url($uriSwitch)}}" class="buttons">{{ $buttonText }}</a>
@if($role == 'BDE')
<a href="{{ url('addevent') }}" class="buttons">Ajouter des évènements</a>
@endif
</div>

<div id="wrapper">
</div>

<script src="{{ $uriScript }}"></script>
@endsection
