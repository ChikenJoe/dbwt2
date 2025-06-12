export function getAnzahlProdukteOfKategorie(data, category){
    let categoryID;
    let categories = data['kategorien'];
    let products = data['produkte'];
    let sumCategoryProducts = 0;

    for (let i = 0; i < categories.length; ++i){
        if (categories[i].name == category){
            categoryID = categories[i].id;
            break;
        }
    }

    products.forEach(function(product, index){
       if (product.kategorie == categoryID){
           sumCategoryProducts += product.anzahl;
       }
    });

    alert("Anzahl Produkte der Kategorie " + category + ": " + sumCategoryProducts);
    return sumCategoryProducts;
}

/*
* var data = {
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
* */
