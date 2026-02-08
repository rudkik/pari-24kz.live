@extends('main')
@section('title', 'Договорные матчи')
@section('content')
    <div class="contract-matches-container">
        <div class="container">
            <h1 class="private-lobby__title">
                Договорные матчи
            </h1>
            <div class="private-lobby__inner">
                @foreach($matches as $match)
                    <div class="match-item" id="match-{{ $match->id }}">
                        <a href="{{ route('private.match.details', ['id' => $match->id]) }}" class="match-link">
                            <h2>{{ $match->name }}</h2>
                        </a>
                        <button class="btn btn-danger delete-match" data-id="{{ $match->id }}">Удалить</button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.delete-match').forEach(button => {
                button.addEventListener('click', function () {
                    let matchId = this.getAttribute('data-id');
                    if (confirm('Вы уверены, что хотите удалить этот матч?')) {
                        fetch(`/private/match/${matchId}/delete`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    document.getElementById(`match-${matchId}`).remove();
                                    alert('Матч успешно удален.');
                                } else {
                                    alert('Ошибка при удалении матча.');
                                }
                            })
                            .catch(error => {
                                alert('Произошла ошибка: ' + error.message);
                            });
                    }
                });
            });
        });
    </script>
@endsection
