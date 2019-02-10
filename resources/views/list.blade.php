@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-md-12">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form-group" method="post" action="{{route('comment.store')}}">
                    @csrf
                    <label for="comment">Комментарий:</label>
                    <textarea class="form-control" name="comment" rows="5" id="comment" placeholder="Ваш отзыв" required></textarea>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Пользователь</th>
                            <th>Отзыв</th>
                            <th>Время</th>
                            @if($isAdmin)<th></th>@endif
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($comments))
                            @foreach($comments as $comment)
                            <tr id="row-{{$comment->id}}">
                                <td><a href="{{route('user.show', ['id' => $comment->user_id])}}">{{$comment->user_name}}</a></td>
                                <td class="text"><p>{{$comment->text}}</p></td>
                                <td><p>{{$comment->created_at}}</p></td>
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
                {{ $comments->links() }}
            </div>
        </div>
    </div>
</div>
<script src='/js/comment_destroy.js'></script>
@endsection