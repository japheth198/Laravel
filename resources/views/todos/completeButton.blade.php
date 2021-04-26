@if($todo->completed)
    <span onclick="event.preventDefault(); document.getElementById('form-incomplete-{{$todo->id}}').submit()" class="fas fa-check px-4 text-green-400 cursor-pointer fa-lg"/>
    <form style="display:none" id="{{'form-incomplete-'.$todo->id}}" method="post" action="{{route('todo.incomplete', $todo->id)}}">
        @csrf
        @method('delete')
    </form>
@else
    <span onclick="event.preventDefault(); document.getElementById('form-complete-{{$todo->id}}').submit()" class="fas fa-check px-4 text-gray-300 cursor-pointer fa-lg"/>
    <form style="display:none" id="{{'form-complete-'.$todo->id}}" method="post" action="{{route('todo.complete', $todo->id)}}">
        @csrf
        @method('put')
    </form>
@endif
