
<x-mail::message>


{{$fullname}} cancel his/her appointment on {{ date('M d,Y', strtotime($date)) }} at {{ date('h:i A', strtotime($time)) }}.


</x-mail::message>