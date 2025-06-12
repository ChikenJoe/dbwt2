<template>
    <div id='articleform'>
        <form @submit.prevent="submitArticle">
            <fieldset>
                <legend>Neuen Artikel anlegen</legend>
                <div>
                    <label for="name">Artikelname:</label>
                    <input type="text" id="name" v-model="name" placeholder="Artikelname">
                </div>
                <div>
                    <label for="price">Preis:</label>
                    <input type="number" id="price" v-model.number="price" placeholder="Preis">
                </div>
                <div>
                    <label for="description">Beschreibung:</label>
                    <textarea id="description" v-model="description" placeholder="Beschreibung"></textarea>
                </div>
                <div>
                    <button type="submit">Speichern</button>
                </div>
            </fieldset>
        </form>
        <div v-if="feedback" class="feedback">{{ feedback }}</div>
    </div>
</template>

<script>
export default{
    data: function() {
        return {
            name: "",
            price: null,
            description: "",
            feedback: ""
        };
    },
    methods: {
        submitArticle() {
            this.feedback = "";

            if (!this.name.trim()) {
                this.feedback = "Der Artikelname darf nicht leer sein.";
                return;
            }
            if (!this.price || this.price <= 0) {
                this.feedback = "Der Preis muss eine Zahl sein und größer als 0.";
                return;
            }

            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content');

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "/api/articles");
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.setRequestHeader("Accept", "application/json");
            xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);

            xhr.onload = () => {
                if (xhr.status >= 200 && xhr.status < 300) {
                    let responseData = {};
                    try {
                        responseData = JSON.parse(xhr.responseText);
                    } catch (e) {
                    // In case parsing fails, fallback to an empty object
                    }
                    this.feedback = responseData.message || "Artikel erfolgreich angelegt!";
                    // Optionally, reset form fields
                    this.name = "";
                    this.price = null;
                    this.description = "";
                } else {
                    this.feedback = "Fehler beim Absenden: " + xhr.statusText;
                }
            };
            xhr.onerror = () => {
                this.feedback = "Netzwerkfehler";
            };

            const data = JSON.stringify({
                name: this.name,
                price: this.price,
                description: this.description
            });

            xhr.send(data);
        }
    }
}
</script>
