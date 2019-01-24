@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/cart.css">
@endsection

@section ( 'content' )

<h3 id="page"> Votre panier </h3>

<div id="wrapper">
	@forelse ( $keeped as $article)
		<div class="row">
			<div class="imgcase"></div>
			<div class="content">
				<p> {{ $article->description }} </p>
			</div>
		</div>
		<p class="nameprice">{{ $article->name }} : {{ $article->price }} € </p>

		@empty

		<p>Vous n&rsquo;avez aucun article dans votre panier. </p>

	@endforelse
</div>

<div id="basket">

	{!! Form::open(['route' => 'buyclean']) !!}
	{!! Form::submit("Valider l'achat", ['class' => 'buyclean', 'disabled' => (empty($keeped) ? true : false), 'onclick' => 'return confirm("Êtes-vous sûr de vouloir acheter tous ces articles");']) !!}
	{!! Form::close() !!}

	{!! Form::open(['method' => 'delete','route' => 'buyclean']) !!}
	{!! Form::submit("Vider le panier", ['class' => 'buyclean', 'onclick' => 'return confirm("Êtes-vous sûr de supprimer votre panier ?");']) !!}
	{!! Form::close() !!}

</div>

@endsection
