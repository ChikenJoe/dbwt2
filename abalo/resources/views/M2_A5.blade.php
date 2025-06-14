<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Laravel</title>
    @vite('resources/css/app.scss')
    @vite('resources/js/app.js')
</head>
<body>
    <script>
        var data = {
            'produkte': [
                { name: 'Ritterburg', preis: 59.99, kategorie: 1, anzahl: 3 },
                { name: 'Gartenschlau 10m', preis: 6.50, kategorie: 2, anzahl: 5 },
                { name: 'Robomaster' ,preis: 199.99, kategorie: 1, anzahl: 2 },
                { name: 'Pool 250x400', preis: 250, kategorie: 2, anzahl: 8 },
                { name: 'Rasenmähroboter', preis: 380.95, kategorie: 2, anzahl: 4 },
                { name: 'Prinzessinnenschloss', preis: 59.99, kategorie: 1, anzahl: 5 }
            ],
            'kategorien': [
                { id: 1, name: 'Spielzeug' },
                { id: 2, name: 'Garten' }
            ]
        };
        getMaxPreis(data);
        getMinPreisProdukt(data);
        getPreisSum(data);
        getGesamtWert(data);
        getAnzahlProdukteOfKategorie(data, 'Garten');
    </script>
</body>
</html>
