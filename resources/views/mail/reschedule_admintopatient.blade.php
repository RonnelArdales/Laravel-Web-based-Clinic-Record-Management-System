<x-mail::message>

Dear {{$fullname}},

Your appointment has been rescheduled on {{ date('M d, Y', strtotime($date)) }} at {{ date('h:i A', strtotime($time)) }}.


Best regards,<br>
JGMarquez, RPsy Clinic.
</x-mail::message>