
<x-mail::message>

Dear {{$fullname}},

Your appointment has been cancelled on {{ date('M d,Y', strtotime($date)) }} at {{ date('h:i A', strtotime($time)) }}.


Best regards,<br>
Dr.Joseph Marquez,
</x-mail::message>