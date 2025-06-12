export const menuData = [
    { title: "Home" },
    { title: "Kategorien" },
    { title: "Verkaufen" },
    { title: "Unternehmen",
        children: [
            { title: "Philosophie" },
            { title: "Karriere" }
        ]
    }
];

export function createMenu(menuItems) {

    //Create unordered list
    const ul = document.createElement("ul");
    ul.style.listStyleType = "none";
    ul.style.display = "flex";


    menuItems.forEach(item => {
        const li = document.createElement("li");
        const link = document.createElement("a");
        link.href = "#";
        link.textContent = item.title;
        li.style.marginRight = "20px";
        li.appendChild(link);

        if (item.children && item.children.length > 0) {
            const subMenu = createMenu(item.children);
            subMenu.style.display = "none";
            subMenu.style.position ="absolute";

            li.appendChild(subMenu);

            //Hide and show submenu by hovering
            li.addEventListener("mouseover", function(){
                subMenu.style.display = "block";
            })
            li.addEventListener("mouseout", function(){
                subMenu.style.display = "none";
            })
        }

        ul.appendChild(li);
    });

    return ul;
}


const navContainer = document.getElementById("navMenu");
const menu = createMenu(menuData);
navContainer.appendChild(menu);
