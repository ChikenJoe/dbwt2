export let items = [
    { text: 'Home', url: "/#" },
    { text: "Kategorien", url:"/#"},
    { text: "Verkaufen", url: "/#"},
    { text: "Unternehmen", url: "/#", children:[
            {text: "Philosophie", url: "/#"},
            {text: "Karriere", url:"/#"}]}
];


export class ListObject {

    constructor(items){
        this.nav = document.createElement('nav');
        this.nav.appendChild(this.populateList(items));
    }
    getNav(){return this.nav;}

    populateList(items){

        let unorderedList = document.createElement('ul');
        unorderedList.style.listStyleType = "none";
        unorderedList.style.display = "flex";

        for (const item  of items){

            //  List element "li" and link element
            const listElement = document.createElement('li');
            const link = document.createElement('a');
            link.href = item.url;
            link.textContent = item.text;

            listElement.style.marginRight = "20px"
            listElement.appendChild(link);

            if (item.children){
                const subMenu = this.populateList(item.children);
                subMenu.style.display = "none";
                subMenu.style.position = "absolute";

                listElement.appendChild(subMenu);
                listElement.addEventListener("mouseover", function(){
                    subMenu.style.display = "block";
                })
                listElement.addEventListener("mouseout", function(){
                    subMenu.style.display = "none";
                })

            }

            unorderedList.appendChild(listElement);
        }
        return unorderedList;
    }
}

let navMenu = new ListObject(items);


/*
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('top').appendChild(navMenu.getNav());
});
*/
