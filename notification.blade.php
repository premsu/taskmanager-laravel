Dear {{ $data->task_owner }},

The task "{{ $data->task_description }}" has been added for you.<br><br>

@if ($data->status == 0)
Kindly complete it within {{ $data->task_eta }}.<br><br>
@else
It has been marked as completed.<br><br>
@endif

Thank you.
