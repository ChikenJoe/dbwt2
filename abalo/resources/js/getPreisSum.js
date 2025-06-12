export function getPreisSum(data){
    let products = data['produkte'];
    let priceSum = 0;
    let formatter = new Intl.NumberFormat('de-DE', {
        style: 'currency',
        currency: 'EUR',
    });

    products.forEach(function(product, index){
        priceSum += product.preis;
    });
    alert("Gesammtsumme Preis aller Produkte: " + formatter.format(priceSum));
    return priceSum;
}
