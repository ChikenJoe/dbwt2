/*
* als Parameter die Daten erhält
* die vollständigen Produktdaten (das Objekt) des ersten Produkts mit dem niedrigsten Preis
* zurückgibt.
* */

export function getMinPreisProdukt(data){
    let product;
    let products = data['produkte'];
    let minPrice = getMaxPreisNoAlert(data);
    let formatter = new Intl.NumberFormat('de-DE', {
        style: 'currency',
        currency: 'EUR',
    });

    products.forEach(function(productData, index){
        if (productData.preis < minPrice){
            minPrice = productData.preis;
            product = productData;
        }
    });

    alert("Produkt mit niedigristem Preis:\n" + "Name: " + product.name + "\nPreis: " + formatter.format(product.preis));
    return product;
}
