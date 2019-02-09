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
                <form class="form-group" method="post" action="{{route('comment')}}">
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
                            @if(Auth::user()->isAdmin())<th></th>@endif
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($comments))
                            @foreach($comments as $comment)
                            <tr>
                                <td><a href="{{route('profile', ['id' => $comment->user_id])}}">{{$comment->user_name}}</a></td>
                                <td style="width:70%"><p>{{$comment->text}}</p></td>
                                <td><p>{{$comment->created_at}}</p></td>
                                @if(Auth::user()->isAdmin())
                                    <td>
                                        <form action="{{ route('delete_comment', ['id' => $comment->id]) }}" id="destroy_form{{$comment->id}}" method="post" style="display: inline;">
                                            @method('DELETE')
                                            @csrf
                                            <a style="color: #c60000" href="javascript:document.getElementById('destroy_form{{$comment->id}}').submit();"><i class="fas fa-trash"></i></a>
                                        </form>
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
@endsection