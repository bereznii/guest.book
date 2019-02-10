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
                                    <td id="id">{{$user->id}}</td>
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
                                            <!--@if($user->blocked)
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
                                            @endif-->
                                            @if($user->blocked)
                                                <a href="">
                                                    <i class="fas fa-lock" title="Разблокировать" id="lock-{{$user->id}}" do_status="0"></i>
                                                </a>
                                                @else
                                                <a href="">
                                                    <i class="fas fa-lock-open" title="Заблокировать" id="lock-{{$user->id}}" do_status="1"></i>
                                                </a>
                                            @endif
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
                            <tr id="row-{{$comment->id}}">
                                <td><p>{{$comment->text}}</p></td>
                                <td>{{$comment->created_at}}</td>
                                @if($isAdmin)
                                    <td>
                                        <a class="delete_btn" href="">
                                            <i class="fas fa-trash" id="{{$comment->id}}" title="Удалить"></i>
                                        </a>
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
<script src='/js/comment_destroy.js'></script>
<script src='/js/user_block.js'></script>
@endsection