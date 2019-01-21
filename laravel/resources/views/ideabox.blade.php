@extends ('template')
@section ('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/ideabox.css">
<style>
	main {
		height: 65%;
	}
</style>
@endsection

@section ('content')

<h3 id="page"> Boite à idées </h3>

<h4 id="pub"> Venez proposer vos idées d'évènements! </h4>

<div id="wrapper">
    <div class="row">
    	<div id="imgcase">
   		</div>
        <div class="content">
	  	<p> description de l'idée </p>
	    </div>
	    <div id="buttonCase">
	    <div></div>
	    <div></div>
	    </div>
	</div>
	<div id="likeButton"><i class="fa fa-thumbs-up"></i></div>
</div>

@endsection