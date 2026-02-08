@extends('main')
@section('title', 'Причины отказов')
@section('content')
    <style>
        input, textarea {
            color: #000000;
        }
        .container {
            max-width: 100%;
            padding: 20px;
            background-color: #1a202c;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .text-center {
            text-align: center;
        }
        .mb-4, .mb-3 {
            margin-bottom: 1.5rem;
        }
        .card {
            background-color: #fff;
            border: 1px solid #1a2a38;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #d42a28;
            color: #fff;
            padding: 10px 15px;
            border-bottom: 1px solid #dee2e6;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .card-title {
            margin: 0;
            font-size: 1.25rem;
        }
        .card-body {
            padding: 15px;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
        }
        .btn-primary {
            background-color: #d42a28;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #d42a28;
        }
        .btn-warning {
            background-color: #ffc107;
            color: #212529;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }
        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            border-top: 1px solid #dee2e6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.075);
        }
        .table-dark {
            background-color: #343a40;
            color: #fff;
        }
        .table-dark th,
        .table-dark td {
            border-color: #454d55;
        }
        .alert {
            padding: 15px;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-info {
            color: #0c5460;
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
        .mt-5 {
            margin-top: 3rem;
        }
        .mb-4 {
            margin-bottom: 1.5rem;
        }
    </style>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Причины отказов</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Добавить причину отказа</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('rejection-reasons.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Заголовок</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Описание</label>
                        <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Список причин отказов</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                    <tr>
                        <th>Заголовок</th>
                        <th>Описание</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reasons as $reason)
                        <tr>
                            <td>{{ $reason->title }}</td>
                            <td>{{ $reason->description }}</td>
                            <td>
                                <a href="{{ route('rejection-reasons.edit', $reason->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                                <form action="{{ route('rejection-reasons.destroy', $reason->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if($reasons->isEmpty())
                    <div class="alert alert-info mt-3">Нет доступных причин отказов.</div>
                @endif
            </div>
        </div>
    </div>
@endsection
