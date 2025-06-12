<script>
export default{
    data: function(){
        return {
            searchText: "",
            articles: []
        }
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
</script>

<template>
    <div>
        <input type="text" v-model="searchText" @input="onInput" placeholder="Artikelsuche..."/>
        <ul v-if="articles.length">
            <li v-for="article in articles" :key="article.id">
                {{ article.ab_name }} – {{ (article.ab_price / 100).toFixed(2) }}€
            </li>
        </ul>
        <p v-else-if="searchText.length >= 3">Keine Treffer gefunden.</p>
    </div>
</template>

<style scoped>
input[type="text"]{
  position:fixed;
  right:65%;
  top:5.5%;
}
ul{
  position:fixed;
  background-color: #706f6c;
  left:10%;
  top:10%;
}
p{
  position:fixed;
  background-color: #706f6c;
  left:10%;
  top:10%;
}
li{
  background-color: #e3e3e0;
  margin: 2px;
}
</style>
