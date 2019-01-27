@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/event.css">
@endsection

@section ( 'content' )

<h3 id="page"> Evènements à venir! </h3>

<div id="rowButton">
<a href="{{url('oldevents')}}" class="buttons">Ancien évènements</a>
<a href="" class="buttons">Ajouter des évènements</a>
</div>

<div id="wrapper">
</div>

<script src="../js/event.js"></script>
@endsection
