<table class="table">
    <thead>
        <tr>
            <th scope="col" style="width: 35%">Title</th>
            <th scope="col">Description</th>
        </tr>
    </thead>
    @foreach($tasks as $task)
        <tr>
            <td>{{ $task->title }}</td>
            <td>{{ $task->description }}</td>
        </tr>
    @endforeach
</table>
<!--show pagination links now we want to pagination in ajax so how we can do it with a litle change ?-->
{{ $tasks->links() }}