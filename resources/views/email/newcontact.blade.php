<div>
    
    <h2>Ordine Deliveboo processato</h2>

    <div>Grazie per aver scelto Deliveboo. Ecco il riepilogo dell'ordine effettuato:</div>

    <h3>Cliente:</h3>

    <ul>
        <li>>Nome e cognome: {{ $lead->name }}</li>
        <li>Email: {{ $lead->email }}</li>
    </ul>
   
    {{-- messaggio con i prodotti --}}
    <p>{{ $lead->message }}</p>
</div>
    


    

