@extends('layouts.app')

@section('content')
    <div class="container">

        @include('flash::message')

        <h2>Recipes</h2>

        @foreach($recipes as $recipe)
            <div class="panel-body">
                <h2><a href="{{ action("RecipeController@show", ['id' => $recipe->id]) }}">{{$recipe->name}}</a></h2>
                <p>Category: {{ $recipe->category }}</p>
                <h3>Creator: <a href="{{ action("RecipeController@userRecipes", ['id' => $recipe->creator->id]) }}">{{ $recipe->creator->name }}</a> </h3>
                <h3>Price: {{ $recipe->price }}</h3>

                @if( $recipe->owners()->get()->contains(\Auth::user()) )
                    <h2>Ingredients:</h2>
                    <ul>
                        @foreach($recipe->ingredients as $info)
                            <li>
                                <h4>{{ $info['value']}}
                                    {{ $info['quantity']->measurement }}
                                    <a href="{{ action("RecipeController@index", ['ing[]' => $info['ingredient']->name]) }}">{{ $info['ingredient']->name }}</a>
                                </h4>
                            </li>
                        @endforeach
                    </ul>

                @else
                    <a href="{{ action("RecipeController@purchase", ['id' => $recipe->id]) }}">Buy</a>
                @endif

                <hr>

            </div>
        @endforeach

        {{ $recipes->links() }}
    </div>


@endsection