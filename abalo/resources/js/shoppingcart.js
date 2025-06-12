export function shoppingCart() {

    const itemlist = document.getElementById('cart-items');
    shoppingCartItems.forEach(item => {
        articles.forEach(article => {
            if (item.ab_article_id == article.id) {
                const listelement = document.createElement('li');
                const removeButton = document.createElement('button');

                listelement.innerText = article.ab_name;
                removeButton.innerText = '-';


                document.querySelectorAll(".add-to-cart").forEach((button) => {
                    const buttonId = button.closest('tr').getAttribute('data-id');
                    if (buttonId == article.id) {
                        button.disabled = true;
                    }
                });

                removeButton.addEventListener('click', (event) => {
                    let xhr = new XMLHttpRequest();
                    const csrf = document.getElementById('csrf-token').content;
                    xhr.open('DELETE', `/api/shoppingcart/1/articles/${article.id}` );
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrf);

                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            const list_el_to_remove = event.target.closest('li');
                            list_el_to_remove.remove();
                            document.querySelectorAll(".add-to-cart").forEach((button) => {
                                const buttonId = button.closest('tr').getAttribute('data-id');
                                if (buttonId == article.id) {
                                    button.disabled = false;
                                }
                            });
                        } else
                            alert("Couldnt delete item from cart");
                    }
                    xhr.send();
                });

                listelement.appendChild(removeButton);
                itemlist.appendChild(listelement);
            }
        })
    });

    document.querySelectorAll(".add-to-cart").forEach((button) => {
        //Disable + button for initialized items

        button.addEventListener('click', (event) => {
            const itemlist = document.getElementById('cart-items');

            const articleRow = event.target.closest('tr');
            const articleName = articleRow.querySelector('td:first-child').textContent;
            const articleId = articleRow.getAttribute('data-id');

            const postobj = {articleId: articleId};
            const post = JSON.stringify(postobj);
            const csrf = document.getElementById('csrf-token').content;

            const removeButton = document.createElement('button');
            removeButton.innerText = '-';

            const addButton = event.target;
            removeButton.addEventListener('click', (event) => {
                let xhr = new XMLHttpRequest();
                xhr.open('DELETE', `/api/shoppingcart/1/articles/${articleId}`);
                xhr.setRequestHeader('X-CSRF-TOKEN', csrf);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        const list_el_to_remove = event.target.closest('li');
                        list_el_to_remove.remove();
                        addButton.disabled = false;
                    } else
                        alert("Couldnt delete item from cart");
                }

                xhr.send();
            });

            let xhr = new XMLHttpRequest();
            xhr.open('POST', '/api/shoppingcart');
            xhr.setRequestHeader('X-CSRF-TOKEN', csrf);
            xhr.setRequestHeader('Content-Type', 'application/json');


            xhr.onload = function () {
                if (xhr.status === 200) {
                    const listelement = document.createElement('li');
                    listelement.innerText = articleName;
                    listelement.appendChild(removeButton);
                    itemlist.appendChild(listelement);
                    event.target.disabled = true;
                }
            }

            xhr.send(post);
        });
    });
}
/*
document.addEventListener('DOMContentLoaded', shoppingCart);
*/
