@extends ('template')
@section ('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/shop.css">
@endsection

@section ('content')

<h3 id="top3"> TOP 3 DES VENTES </h3>

	<div class="search-container">
		<form id="searching" action="">
		  <input type="text" placeholder="Rechercher.." name="search">
		  <button type="submit"><i class="fa fa-search"></i></button>
		</form>
	  <a href="card">
		<i class="fa fa-shopping-cart " href=""></i>
	  </a>
	</div>
  <div class="wrapper">
	<div class="row">
	  <div class="column">
		<div class="content"style="background-color: black;">
		  <!-- <img src="mountains.jpg" alt="Mountains" style="width:100%"> -->
		  <h3>Article : prix</h3>
		  <p>Description du produit!</p>
		</div>
	  </div>
	  <div class="column">
		<div class="content"style="background-color: black;">
		  <!-- <img src="mountains.jpg" alt="Mountains" style="width:100%"> -->
		  <h3>Article : prix</h3>
		  <p>Description du produit!</p>
		</div>
	  </div>
	  <div class="column">
		<div class="content" style="background-color: black;">
			<!-- <img src="mountains.jpg" alt="Mountains" style="width:100%"> -->
			<h3>Article : prix</h3>
			<p>Description du produit!</p>
		</div>
	  </div>
	</div>
  </div>

  <h3 id="top3"> Tout les articles : </h3>

<div id="categorie">
	{!! Form::label('categorie', 'All:') !!}
	{!! Form::select('categorie', $categories, ['required'=>'required'])!!}
	{!! $errors->first('categorie','<small class="help-block">:message</small>') !!}
</div>


  <div class="wrapper" id="allarticles">
  </div>

	<script type="text/javascript" src="./js/shop.js"></script>
@endsection
