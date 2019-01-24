@extends ('template')
@section ('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/shop.css">
@endsection

@section ('content')

<h3 id="top3"> TOP 3 DES VENTES </h3>

	<div class="search-container">
			<a href="cart">
				<i class="fa fa-shopping-cart "></i>
			</a>
			<form autocomplete="off" action="">
					<div class="autocomplete" style="width:300px;">
						<input id="myInput" type="text" name="articles" placeholder="Vous recherchez?">
					</div>
					<input type="submit">
			</form>
			
	</div>
  <div class="wrapper">
	@foreach ($bestProducts as $product)
		<div class='column {{ $product->id }}'>
			<div style='background-image: url(../img/produit/{{ $product->image }});' class="imgArticle">
				<div class='buttonShop addToCars'> Ajouter au panier </div>
			</div>
			<div class="content">
				<h3>{{ $product->name }} : {{ $product->price }} €</h3>
				<p>{{ $product->description }}</p>
			</div>
		</div>

	@endforeach
  </div>
  <h3 id="all"> Tout les articles : </h3>

<div id="categories">
	{!! Form::label('categorie', 'All:') !!}
	{!! Form::select('categorie', $categories, ['required'=>'required'])!!}
	{!! $errors->first('categorie','<small class="help-block">:message</small>') !!}
</div>


<div class="wrapper" id="allarticles"></div>

	<script src="./js/shop.js"></script>
	<script src="./js/autocomplet.js"></script>*
	<script src="./js/categories.js"></script>
	<script>
		autocomplete(document.getElementById("myInput"), articles);
	</script>
@endsection
