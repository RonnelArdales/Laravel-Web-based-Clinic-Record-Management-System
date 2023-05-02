
<x-mail::message>

Dear {{$fullname}},

This email serves as a notification that you have cancelled your appointment on 
{{ date('M d,Y', strtotime($date)) }} at {{ date('h:i A', strtotime($time)) }}.


Best regards,<br>
Dr.Joseph Marquez,
</x-mail::message>


