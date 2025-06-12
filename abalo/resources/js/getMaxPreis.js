/*
* die als Parameter die Daten erhält und den Namen des ersten
* Produkts mit dem höchsten Preis zurückgibt.
* */

export function getMaxPreis(data){
    let products = data['produkte'];
    let maxPrice = 0;
    let maxPriceProduct;
    let formatter = new Intl.NumberFormat('de-DE', {
        style: 'currency',
        currency: 'EUR',
    });
    products.forEach(function(productData, index){
        if (productData.preis > maxPrice){
            maxPrice = productData.preis;
            maxPriceProduct = productData.name;
        }
    });
    alert("maxPrice: " + formatter.format(maxPrice) + "\n" + "productName: " + maxPriceProduct);
    return maxPrice;
}

export function getMaxPreisNoAlert(data){
    let products = data['produkte'];
    let maxPrice = 0;
    let maxPriceProduct;

    products.forEach(function(productData, index){
        if (productData.preis > maxPrice){
            maxPrice = productData.preis;
            maxPriceProduct = productData.name;
        }
    });
    return maxPrice;
}
