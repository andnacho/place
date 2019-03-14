@component('mail::message')
Hola {{ strtoupper($usuario) }}

The body of your message.

@component('mail::button', ['url' => '/algo'])
Button Text
@endcomponent

@component('mail::header', ['url' => $url] )
    <nav>Ventas de aquí</nav>
@endcomponent

@component('mail::panel')
Aquí queda la información y la pela de mi morci
@endcomponent

@component('mail::table')

@endcomponent

Gracias,<br>

@endcomponent
