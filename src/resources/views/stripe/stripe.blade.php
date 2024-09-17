@extends('layouts.app')

@section('css')

@endsection
@section('content')
<div>
    <div>
        <table>
            <tr>
                <th>予約店名</th>
                <td>{{ $reservation->store_name }}</td>
            </tr>
            <tr>
                <th>予約日</th>
                <td>{{ $reservation->reservation_day }}</td>
            </tr>
            <tr>
                <th>予約時間</th>
                <td>{{ $reservation->reservation_time }}</td>
            </tr>
            <tr>
                <th>支払い金額</th>
                <td>{{ $reservation->amount }}</td>
            </tr>
        </table>
    </div>
    <form action="{{ route('stripe.payment') }}" method="post" id="payment-form">
        @csrf
        <input type="text" name="amount" value="{{ $reservation->amount }}" hidden>
        <div id="card-element">
            <button type="submit">支払い</button>
        </div>
    </form>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        
        // Create an instance of the card Element
        var cardElement = elements.create('card');
        
        // Add an instance of the card Element into the `card-element` div
        cardElement.mount('#card-element');
        
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Create a token or display an error
            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    // Show error in the UI
                    console.error(result.error.message);
                } else {
                    // Send the token to your server
                    var form = document.getElementById('payment-form');
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);
                    
                    // Submit the form
                    form.submit();
                }
            });
        });
    </script>
</div>
@endsection