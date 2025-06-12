export function add_article_form(){
    "use strict";

        //  Form mitsamt Inputs erstellen

        const form = document.createElement('form');
        form.id = 'articleForm';

        const nameInput = document.createElement('input');
        nameInput.type = 'text';
        nameInput.id = 'name';
        nameInput.placeholder = 'Artikelname';

        const priceInput = document.createElement('input');
        priceInput.type = 'number';
        priceInput.id = 'price';
        priceInput.placeholder = 'Preis';

        const descriptionInput = document.createElement('textarea');
        descriptionInput.id = 'description';
        descriptionInput.placeholder = 'Beschreibung';

        //  Submit button
        const submitButton = document.createElement('button');
        submitButton.type = 'button';
        submitButton.innerText = 'Speichern';
        submitButton.addEventListener('click', submitArticle);

        form.appendChild(nameInput);
        form.appendChild(priceInput);
        form.appendChild(descriptionInput);
        form.appendChild(submitButton);

        //  Append form to body
        document.body.appendChild(form);

        // Feedback-Bereich hinzufügen

        const feedbackDiv = document.createElement('div');
        feedbackDiv.id = 'feedback';
        document.body.appendChild(feedbackDiv);

}


//  Event Submit button click
export function submitArticle() {
    const name = document.getElementById('name').value.trim();
    const price = parseFloat(document.getElementById('price').value);
    const description = document.getElementById('description').value.trim();
    const feedbackDiv = document.getElementById('feedback');

    // Feedback-Reset
    feedbackDiv.innerHTML = '';

    // Validierung
    if (!name) {
        feedbackDiv.innerText = 'Der Artikelname darf nicht leer sein.';
        return;
    }
    if (isNaN(price) || price <= 0) {
        feedbackDiv.innerText = 'Der Preis muss eine Zahl sein und größer als 0 sein.';
        return;
    }

    // Daten absenden
    const formData = new FormData();
    formData.append('name', name);
    formData.append('price', price);
    formData.append('description', description);

    //  XMLHttpRequest
    const xhr = new XMLHttpRequest();
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    formData.append('_token', csrfToken);


    xhr.open('POST', 'http://127.0.0.1:8000/api/articles');
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

    xhr.onload = function(){
        if (xhr.status >= 200 && xhr.status < 300) {
            console.log('Response headers:', xhr.getAllResponseHeaders());
            feedbackDiv.innerText = xhr.responseText;
        } else {
            feedbackDiv.innerText = 'Fehler beim Absenden: ' + xhr.statusText;
        }
    };

    xhr.onerror = function() {
        feedbackDiv.innerText = 'Netzwerkfehler';
    };

    xhr.send(formData);
}
