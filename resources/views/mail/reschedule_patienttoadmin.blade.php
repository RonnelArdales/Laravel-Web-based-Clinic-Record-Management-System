<x-mail::message>

Dear Doc/Secretary,

The appointment for {{$fullname}} has been rescheduled on {{ date('M d, Y', strtotime($date)) }} at {{ date('h:i A', strtotime($time)) }}.


</x-mail::message>