export default{
    template:` <div>
        <input type="text" v-model="searchText" @input="onInput" placeholder="Artikelsuche..."/>
        <ul v-if="articles.length">
            <li v-for="article in articles" :key="article.id">
                {{ article.ab_name }} – {{ (article.ab_price / 100).toFixed(2) }}€
            </li>
        </ul>
        <p v-else-if="searchText.length >= 3">Keine Treffer gefunden.</p>
    </div>`,
    data() {
        return {
            searchText: "",
            articles: []
        };
    },
    methods: {
        onInput() {
            if (this.searchText.length < 3) {
                this.articles = [];
                return;
            }

            const xhr = new XMLHttpRequest();
            const url = `/api/articles?search=${encodeURIComponent(this.searchText)}`;
            xhr.open("GET", url);
            xhr.setRequestHeader("Accept", "application/json");

            xhr.onload = () => {
                if (xhr.status >= 200 && xhr.status < 300) {
                    try {
                        this.articles = JSON.parse(xhr.responseText);
                    } catch (error) {
                        console.error("Fehler beim Parsen der Antwort:", error);
                        this.articles = [];
                    }
                }
                else {
                    console.error("Server-Fehler:", xhr.statusText);
                }
            };
            xhr.onerror = () => {
                console.error("Netzwerkfehler");
            };

            xhr.send();
        }
    }
}
