<div
    style="font-family: Arial, sans-serif; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px;">
    <h2 style="color: #d9534f; text-align: center;">Ordine Deliveboo processato</h2>

    <div style="margin-bottom: 20px; text-align: center; font-size: 16px;">
        Grazie per aver scelto Deliveboo. Ecco il riepilogo dell'ordine effettuato:
    </div>

    <h3 style="color: #5a5a5a; font-size: 18px; margin-bottom: 10px;">Cliente:</h3>
    <ul style="list-style: none; padding: 0; font-size: 16px; line-height: 1.6;">
        <li style="margin-bottom: 5px;"><strong>Nome e cognome:</strong> {{ $lead->name }}</li>
        <li style="margin-bottom: 5px;"><strong>Email:</strong> {{ $lead->email }}</li>
    </ul>

    {{-- messaggio con i prodotti --}}
    {{-- <p style="font-size: 16px; color: #333; line-height: 1.6; margin-top: 20px;">{{ $lead->message }}</p> --}}
    {!! $lead->message !!}
</div>
