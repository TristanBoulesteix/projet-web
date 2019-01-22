@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/event.css">
@endsection

@section ( 'content' )

<h3 id="page"> Evènements à venir! </h3>

<div id="rowButton">
<a href="" class="buttons">Ancien évènements</a>
<a href="" class="buttons">Si BDE, ajouter des évènements</a>
</div>

<div id="wrapper">
    <div class="row">
        <div class='imgcase'>
        </div>
        <div class="content">
            <p> description </p>
        </div>
    </div>
    <div class="row">
        <div  class='imgcase'>
        </div>
        <div class="content">
            <p> description </p>
        </div>
    </div>
    <div class="row">
        <div  class='imgcase'>
        </div>
        <div class="content">
           <p> description </p>
        </div>
    </div>
</div>


@endsection
