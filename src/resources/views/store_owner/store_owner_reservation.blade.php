@extends('layouts.store_owner')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/store_owner_reservation.css') }}">
@endsection

@section('content')
<div class="reservations">
    <table class="reservations__table">
        <thead class="reservations__header">
            <tr class="reservations__row">
                <th class="reservations__column-title">来店者名</th>
                <th class="reservations__column-title">予約日</th>
                <th class="reservations__column-title">予約時間</th>
                <th class="reservations__column-title">予約人数</th>
                <th class="reservations__column-title">支払い状況</th>
                <th class="reservations__column-title">支払い金額</th>
                <th class="reservations__column-title">アクション</th>
            </tr>
        </thead>
        <tbody class="reservations__body">
            @foreach($reservations as $reservation)
            <tr class="reservations__row">
                <td class="reservations__data">{{ $reservation->user_name }}</td>
                <td class="reservations__data">{{ $reservation->reservation_day }}</td>
                <td class="reservations__data">{{ $reservation->reservation_time }}</td>
                <td class="reservations__data">{{ $reservation->number_of_people }}</td>
                <td class="reservations__data">{{ $reservation->payment_status }}</td>
                <td class="reservations__data">{{ $reservation->amount }} 円</td>
                <td class="reservations__data">
                    <button class="reservations__btn" data-id="{{ $reservation->id }}" onclick="openModal({{ $reservation->id }})">金額を更新</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- モーダルウィンドウ -->
<div id="reservationModal" class="reservation__modal">
    <div class="reservation__modal-content">
        <span class="reservation__modal-close" onclick="closeModal()">&times;</span>
        <form action="" method="POST" id="reservationForm">
            @csrf
            <label for="amount">支払い金額</label>
            <input type="text" name="amount" id="amount">
            <button type="submit">金額を確定</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
// モーダルを開く関数
function openModal(reservationId) {
    var modal = document.getElementById('reservationModal');
    var form = document.getElementById('reservationForm');
    
    // モーダルのアクションURLを設定
    form.action = '/store/reservation/amount/' + reservationId;
    
    // モーダルを表示
    modal.style.display = 'block';
}

// モーダルを閉じる関数
function closeModal() {
    var modal = document.getElementById('reservationModal');
    modal.style.display = 'none';
}

// ウィンドウ外をクリックした場合、モーダルを閉じる
window.onclick = function(event) {
    var modal = document.getElementById('reservationModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>
@endsection

