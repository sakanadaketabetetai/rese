@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="store_list-content">
    <div class="form_search">
            <table>
            <form action="/search" method="get" id="searchForm">
                <tr>
                    <td>
                        <div class="store_list-search">
                            <select name="store_area" onchange="document.getElementById('searchForm').submit();">
                                <option value="">All area</option>
                                @foreach($stores->unique('store_area') as $store)
                                    <option value="{{ $store->store_area }}">{{ $store->store_area }}</option>
                                @endforeach
                            </select>
                        </div>
                    </td> 
                    <td>
                        <div class="store_list-search">
                            <select name="store_genre" onchange="document.getElementById('searchForm').submit();">
                                <option value="">All genre</option>
                                @foreach($stores->unique('store_genre') as $store)
                                    <option value="{{ $store->store_genre }}">{{ $store->store_genre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="store_keyword-input">
                            <input type="text" name="keyword" placeholder="Keyword" oninput="document.getElementById('searchForm').submit();">
                        </div>
                    </td>
                </tr>
            </form>
        </table>
    </div>
    <div class="store_list">
        @foreach ($stores as $store)
            <div class="store_card">
                <div class="store_card-img">
                    <img src="{{ $store->image }}" alt="">
                </div>
                <div class="store_card-ttl">{{ $store->store_name }}</div>
                <div class="store_card-content">
                    <div class="store_card-content-tag">
                        <span class="store_card-content-tag">#{{ $store->store_area }}</span>
                        <span class="store_card-content-tag">#{{ $store->store_genre }}</span>
                    </div>
                    <div class="store_card-button">
                        <form action="/detail/{{ $store->id }}" method="get">
                            @csrf
                            <button class="form_button-submit" type="submit">詳しく見る</button>
                        </form>
                        <form action="/favorite_store" method="post">
                            @csrf
                            <input type="hidden" name="store_id" value="{{ $store->id }}">
                            @if($store->isFavorite())
                                <button class="form_button-submit-favorite" type="submit">♥</button>
                            @else
                                <button class="form_button-submit-heart" type="submit">♥</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection