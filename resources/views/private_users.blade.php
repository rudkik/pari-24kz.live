@extends('main')
@section('title', 'Букмекерская компания')
@section('content')
    <article class="spoiler leagues__sect _js-active" data-sel-target="" style="margin: 20px;">
        <div class="_container">
            <div class="leagues__top">
                <div class="leagues__l-top">
                    <div class="leagues__ico">
                        <picture>
                            <source srcset="/img/ico/l1.avif" type="image/avif">
                            <source srcset="/img/ico/l1.webp" type="image/webp">
                            <img class="p-img-c" src="/img/ico/l1.png" loading="lazy" width="100" height="100" alt="img">
                        </picture>
                    </div>
                    <h3>Список пользователей</h3>
                </div>
            </div>

            <form action="{{ route('private.users') }}" method="GET" class="search-form" style="margin-top: 20px; display: flex; align-items: center; gap: 10px;">
                <input type="text" name="search_id" placeholder="Search by ID, phone, name, or email" class="search-input" style="padding: 10px; color: #1a2a38; border: 1px solid #ddd; border-radius: 4px;">
                <button type="submit" class="search-button" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 4px;">Search</button>
            </form>


            <div class="user-count" style="margin-top: 20px;">
                <p>Общее количество пользователей: {{ $totalUsers }}</p>
            </div>

            <div class="user-list" style="margin-top: 20px;">
                <table class="user-table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                    <tr class="user-item-header" style="background-color: #2a2a2a; color: #fff;">
                        <th class="user-id-header" style="padding: 10px; border: 1px solid #007bff;">ID</th>
                        <th class="user-name-header" style="padding: 10px; border: 1px solid #007bff;">Имя</th>
                        <th class="user-email-header" style="padding: 10px; border: 1px солид #007bff;">Email</th>
                        <th class="user-phone-header" style="padding: 10px; border: 1px solid #007bff;">Телефон</th>
                        <th class="user-money-header" style="padding: 10px; border: 1px solid #007bff;">Баланс</th>
                        <th class="user-created_at-header" style="padding: 10px; border: 1px solid #007bff;">Дата регистрации</th>
                        <th class="user-updated_at-header" style="padding: 10px; border: 1px solid #007bff;">Последняя активность</th>
                        <th class="user-action-header" style="padding: 10px; border: 1px solid #007bff;">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        @if (auth()->user()->id != $user->id)
                            <tr class="user-item" style="background-color: #1a2a38; color: #fff;">
                                <td class="user-id" style="padding: 10px; border: 1px solid #007bff;">{{ $user->id }}</td>

                                <td class="user-name" style="padding: 10px; border: 1px solid #007bff;">{{ $user->name }} (2110{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }})</td>
                                <td class="user-email" style="padding: 10px; border: 1px solid #007bff;">{{ $user->email }}</td>
                                <td class="user-phone" style="padding: 10px; border: 1px solid #007bff;">{{ $user->phone }}</td>
                                <td class="user-money" style="padding: 10px; border: 1px solid #007bff;">{{ $user->money }}</td>
                                <td class="user-created_at" style="padding: 10px; border: 1px solid #007bff;">{{ $user->created_at->format('d.m.Y H:i') }}</td>
                                <td class="user-updated_at" style="padding: 10px; border: 1px solid #007bff;">{{ $user->updated_at->format('d.m.Y H:i') }}</td>
                                <td class="user-action" style="padding: 10px; border: 1px solid #007bff;">
                                    <a href="{{ route('private.user', ['id' => $user->id]) }}" class="view-button" style="padding: 5px 10px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; text-decoration: none;">Посмотреть</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </article>
@endsection
