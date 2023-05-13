<x-mail::message>

Dear {{$fullname}},

Thank you for booking an appointment with JG Marquez RPSY. We appreciate your trust and look forward to meeting with you on 
{{ date('M d,Y', strtotime($date)) }} at {{ date('h:i A', strtotime($time)) }}.

Thank you again for choosing to work with us. We are excited to speak with you soon.


Best regards,<br>
JGMarquez, RPsy Clinic.
</x-mail::message>
