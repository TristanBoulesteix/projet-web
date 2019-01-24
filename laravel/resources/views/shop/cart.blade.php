@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/cart.css">
@endsection

@section ( 'content' )

<h3 id="page"> Votre panier </h3>

<div id="wrapper">
	@foreach ( $keeped as $article)
		<div class="row">
			<div class="imgcase"></div>
			<div class="content">
				<p> {{ $article->description }} </p>
			</div>
		</div>
		<p class="nameprice">{{ $article->name }} : {{ $article->price }} € </p>
	@endforeach
</div>

<div id="basket">

	<a class="buyclean" href=""> Valider l'achat </a>

	<a class="buyclean" href=""> Vider le panier </a>

</div>

@endsection
