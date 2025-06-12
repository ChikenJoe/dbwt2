export function getGesamtWert(data){
    let gesamtWert = 0;
    let products = data['produkte'];
    let formatter = new Intl.NumberFormat('de-DE',{
        style: 'currency',
        currency: 'EUR'
    });

    products.forEach(function(product, index){
        gesamtWert += product.preis * product.anzahl;
    });

    alert("Gesamtwert aller Produkte: " + formatter.format(gesamtWert));
    return gesamtWert;
}
