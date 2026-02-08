@extends('main')
@section('title', 'Sports')
@section('content')
    <div class="private-lobby">
        <div class="_container">
            <h1 class="private-lobby__title">Sports</h1>
            <a href="{{ route('sports.create') }}" class="btn btn-success">Add Sport</a>
            <table style="width: 100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>ID API</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sports as $sport)
                    <tr>
                        <td>{{ $sport->id }}</td>
                        <td>{{ $sport->title }}</td>
                        <td>
                            <img style="width: 50px; height: 50px" src=" {{ $sport->img }}"</td>
                        <td>{{ $sport->id_api }}</td>
                        <td >
                            <a style="margin-bottom: 10px" href="{{ route('sports.edit', $sport) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('sports.destroy', $sport) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endsection
        </div>
    </div>
