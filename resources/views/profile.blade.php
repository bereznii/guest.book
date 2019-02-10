@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-md-12">
            <div class="card-body">
                <div class="card col-md-5">
                    <div class="card-body">
                        <table class="table table-default">
                            <tbody>
                                <tr>
                                    <th scope="row">ID</td>
                                    <td>{{$user->id}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Имя</td>
                                    <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Почта</td>
                                    <td>{{$user->email}}</td>
                                </tr>
                                @if($isAdmin)
                                <tr>
                                    <th scope="row">Статус</td>
                                    <td>
                                        <form class="patch" action="{{ route('user.update', ['id' => $user->id]) }}" id="update_form{{$user->id}}" method="post">
                                            @method('PATCH')
                                            @csrf
                                            @if($user->blocked)
                                                <input type="hidden" name="blocked" value="0">
                                                <a href="{{ route('user.update', ['id' => $user->id]) }}"
                                                        onclick="event.preventDefault();
                                                        document.getElementById('update_form{{$user->id}}').submit();">
                                                    <i class="fas fa-lock" title="Разблокировать"></i>
                                                </a>
                                                @else
                                                <input type="hidden" name="blocked" value="1">
                                                <a href="{{ route('user.update', ['id' => $user->id]) }}"
                                                        onclick="event.preventDefault();
                                                        document.getElementById('update_form{{$user->id}}').submit();">
                                                    <i class="fas fa-lock-open" title="Заблокировать"></i>
                                                </a>
                                            @endif
                                        </form>
                                    </td>
                                </tr>            
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Отзыв</th>
                            <th>Время</th>
                            @if($isAdmin)<th></th>@endif
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($comments))
                            @foreach($comments as $comment)
                            <tr>
                                <td><p>{{$comment->text}}</p></td>
                                <td>{{$comment->created_at}}</td>
                                @if($isAdmin)
                                    <td>
                                        <form class="delete" action="{{ route('comment.destroy', ['id' => $comment->id]) }}" id="destroy_form{{$comment->id}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <a class="delete_btn" href="{{ route('comment.destroy', ['id' => $comment->id]) }}"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('destroy_form{{$comment->id}}').submit();">
                                                <i class="fas fa-trash" title="Удалить"></i>
                                            </a>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection