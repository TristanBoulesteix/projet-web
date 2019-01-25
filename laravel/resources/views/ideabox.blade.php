@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/ideabox/ideabox.css">
<link rel="stylesheet" href="./css/ideabox/ideabox_ipad.css">
<link rel="stylesheet" href="./css/ideabox/ideabox_phone.css">
@endsection

@section ( 'content' )

<h3 id="page"> Boite à idées </h3>

<div id="Adminbtn">
        <div id="addEventCase">
            <a id="addEventBut" href=""> Proposer&nbsp;un&nbsp;évènement </a>
        </div>

<h4 id="pub"> Venez proposer vos idées dévènements! </h4>
<a id="connexion" href="/idea/admin">Administrer</a>
</div>



<div id="wrapper">
</div>
<script type="text/javascript" src="./js/ideas.js"></script>

@endsection
