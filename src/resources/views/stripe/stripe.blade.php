@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection

@section('content')
<div class="payment">
    <div class="payment__header-back">
        <a href="/mypage/{{ Auth::id() }}" class="payment__back-link"><</a>
    </div>
    <div class="payment__header">
        <h1 class="payment__page-title">支払い画面</h1>
    </div>
    <div class="payment__content">
        <div class="payment__section">
            <h3 class="payment__section-title">支払情報</h3>
            <table class="payment__table">
                <tr class="payment__row">
                    <th class="payment__table-header">予約店名</th>
                    <td class="payment__data">{{ $store_name }}</td>
                </tr>
                <tr class="payment__row">
                    <th class="payment__table-header">予約日</th>
                    <td class="payment__data">{{ $reservation->reservation_day }}</td>
                </tr>
                <tr class="payment__row">
                    <th class="payment__table-header">予約時間</th>
                    <td class="payment__data">{{ $reservation->reservation_time }}</td>
                </tr>
                <tr class="payment__row">
                    <th class="payment__table-header">支払い金額</th>
                    <td class="payment__data">{{ $reservation->amount }}円</td>
                </tr>
            </table>
        </div>

        <div class="payment__section">
            <h3 class="payment__section-title">カード情報入力フォーム</h3>
            <form action="{{ route('stripe.payment') }}" method="post" id="payment-form" class="payment__form">
                @csrf
                <input type="hidden" name="amount" value="{{ $reservation->amount }}">
                <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                <div id="card-element" class="payment__card-element"></div>
                <button type="submit" class="payment__button">支払い</button>
            </form>
        </div>
    </div>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');
        
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            
            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    console.error(result.error.message);
                } else {
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);
                    form.submit();
                }
            });
        });
    </script>
</div>
@endsection
