@extends ('template')
@section('description')
<meta name="description" content="Magasin en ligne du BDE, Achat de goodies et de places d'évènements" />
@endsection
@section ('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/shop.css">
<link rel="stylesheet" href="./css/shop/shop_ipad.css">
<link rel="stylesheet" href="./css/shop/shop_phone.css">
<link rel="stylesheet" href="./css/shop/shop_laptop.css">
@endsection

@section ('content')

<h3 id="top3"> TOP 3 DES VENTES </h3>

	<div class="search-container">
			<a href="cart">
				<i class="fa fa-shopping-cart "></i>
			</a>
			@if($role == 'BDE')
			<a id="addProduct" href="addarticle"> Ajouter&nbsp;un&nbsp;article </a>
			@endif
			<form autocomplete="off">
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
					<div class='buttonShop addToCart top3'> Ajouter au panier </div>
					@if($role == 'BDE')
					<div class='buttonShop delete top3'> Supprimer l'article </div>
					@endif
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
	{!! Form::label('categorie', 'Catégories:') !!}
	{!! Form::select('categorie', $categories, ['required'=>'required'])!!}
	{!! $errors->first('categorie','<small class="help-block">:message</small>') !!}
</div>


<div class="wrapper" id="allarticles"></div>

	<script src="./js/shop.js"></script>
	<script src="./js/autocomplet.js"></script>
	<script src="./js/categories.js"></script>
	<script>
		function createArticle(json, wrapper, i) {
			var columnElement = $(document.createElement("div")).addClass("column").attr("id", i);
			wrapper.append(columnElement);
			var img = $(document.createElement("div")).attr("style", "background-image : url('../storage/article/" + json[i].image + "');").addClass('imgArticle');
			img.append("<div class='buttonShop addToCart'>Ajouter au panier</div>");
			var reportbtn = $(document.createElement("a")).addClass('buttonReport').text("report").attr("href", "/home");
			img.append(reportbtn);
			@if($role == 'BDE')
			img.append("<div class='buttonShop delete'> Supprimer l'article </div>");
			@endif
			columnElement.append(img);
			var content = $(document.createElement("div")).addClass("content");
			columnElement.append(content);
			content.append("<h3>"+json[i].name +": "+ json[i].price+"€</h3>");
			content.append("<p>"+json[i].description+"</p>");
		}
		
		autocomplete(document.getElementById("myInput"), articles);
	</script>
@endsection
