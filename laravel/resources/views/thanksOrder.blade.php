@extends ('template')
@section ('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/shop.css">
<style>
	main {
		height: 73.2vh;
	}
</style>
@endsection

@section ('content')

<div>
	<p id="thx">
		Merci de votre achat!
	</p>
	<a href="/shop" id="backshop"> Retour à la Boutique </a>
</div>

@endsection
