@extends('main')
@section('title', 'Редактирование причины отказа')
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
        .form-group {
            margin-bottom: 1rem;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            color: #000000;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
        }
        .btn-primary {
            background-color: #d42a28;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #b51f1d;
        }
        .alert {
            padding: 15px;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .mt-5 {
            margin-top: 3rem;
        }
    </style>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Редактирование причины отказа</h1>

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

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Редактирование причины отказа</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('rejection-reasons.update', $rejectionReason->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title" class="form-label">Заголовок</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $rejectionReason->title }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Описание</label>
                        <textarea name="description" id="description" class="form-control" rows="3" required>{{ $rejectionReason->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    <a href="{{ route('rejection-reasons.index') }}" class="btn btn-secondary">Отмена</a>
                </form>
            </div>
        </div>
    </div>
@endsection