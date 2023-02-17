<x-mail::message>
# Verify this email address

Please use the verification code to verify your email

# {{$otp}}
{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>