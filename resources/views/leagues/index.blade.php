@extends('main')
@section('title', 'Leagues')
@section('content')
    <div class="private-lobby">
        <div class="_container">
    <h1>Leagues</h1>
    <a href="{{ route('leagues.create') }}" class="btn btn-success">Add League</a>
    <table style="width: 100%" class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Icon</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($leagues as $league)
            <tr>
                <td>{{ $league->id }}</td>
                <td>{{ $league->name }}</td>
                <td>{{ $league->description }}</td>
                <td> <img style="width: 40px; height: 40px" src="/{{ $league->image }}" /></td>
                <td>
                    <a href="{{ route('leagues.edit', $league) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('leagues.destroy', $league) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

        </div>
    </div>
