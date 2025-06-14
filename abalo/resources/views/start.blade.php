@extends('layouts.abalo')
<script>
    var shoppingCartItems = @json($shoppingcartitems);
    var articles = @json($articles);
</script>
@section('title', 'Welcome to Abalo!')

@section('top')

    <div id="articlesearch"></div>
@endsection

@section('right')
    <div id="cart">
        <h2 style="text-align: center">Warenkorb</h2>
        <ul id="cart-items">
        </ul>
    </div>
@endsection

@section('middle')
    <table border="1">
        <thead>
        <tr>
            <td>Name</td>
            <td>Price</td>
            <td>Description</td>
            <td>Bild</td>
            <td>Hinzufügen</td>
        </tr>
        </thead>

        @forelse($articles as $article)
            <tr data-id="{{ $article['id'] }}">
                <td>{{$article['ab_name']}}</td>

                <td>{{ number_format($article['ab_price'] / 100, 2) }}€</td>
                <td>{{$article['ab_description']}}</td>
                <td>
                    @if (!empty($article->image->ab_img_filename))
                        <img src="{{ asset('img/articleimages/' . $article->image->ab_img_filename) }}"
                             alt="Platzhalter"
                             height="128px"
                             width="192px">
                    @endif
                </td>
                <td>
                    <button class="add-to-cart">+</button>
                </td>
            </tr>
        @empty
            <tr>
                <td> No item found </td>
            </tr>
        @endforelse
    </table>
    @endsection

