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
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($comments))
                            @foreach($comments as $comment)
                            <tr>
                                <td><p>{{$comment->text}}</p></td>
                                <td>{{$comment->created_at}}</td>
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