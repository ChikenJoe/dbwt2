<script>
export default{
    created: function() {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '/api/categories');
        xhr.setRequestHeader('Accept','application/json');

        xhr.onload = () => {
            if (xhr.status === 200){
                this.categories = JSON.parse(xhr.responseText);
                console.log("Fetched categories, first object: ");
                console.log(this.categories[0]);
            } else {
                console.log("Couldnt fetch categories");
            }
        }
        xhr.send();
    },
    data: function(){
        return {
            categories: [],
            searchText: "",
            articles: [],
            page: 0,
            priceLowerBound: 0,
            priceUpperBound: 100,
            category: 0,
            articleFlag: true
        }
    },
    methods: {
        handleLeft(){
            if (this.page > 0) {
                this.page--;
                console.log("page: " + this.page);
                this.onInput();
            }
        },
        handleRight(){
            if (this.articleFlag){
                this.page++;
                console.log("page: " + this.page);
                this.onInput();
            }else {
                console.log("page: " + this.page);
                this.articleFlag = false;
            }
        },
        onInput() {
            if (this.searchText.length < 3) {
                this.articles = [];
                this.articleFlag = false;
                return;
            }
            const xhr = new XMLHttpRequest();
            const url = `/api/articles?search=${encodeURIComponent(this.searchText)}&page=${this.page}`;
            xhr.open("GET", url);
            xhr.setRequestHeader("Accept", "application/json");
            xhr.onload = () => {
                if (xhr.status >= 200 && xhr.status < 300) {
                    try {
                        this.articles = JSON.parse(xhr.responseText);
                        console.log("check");
                        console.log(this.articles);
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

            if (this.articles)
                this.articleFlag = true;
            else
                this.articleFlag = false;
        }
    },
    computed: {
        filteredArticles() {
            return this.articles.filter(article => {
                return (this.category === 0  || article.category.ab_articlecategory_id === this.category)
                    && article.ab_price >= this.priceLowerBound && article.ab_price <= this.priceUpperBound;
            });
        }
    }
}
</script>

<template>
    <div class="article-search">
        <!-- Block: article-search -->
        <input
            type="text"
            v-model="searchText"
            @input="onInput"
            placeholder="Artikelsuche..."
            class="article-search__input"
        />

        <ul
            v-if="articles.length"
            class="article-search__list"
        >
            <li>
                v-for="article in article in articles"
                :key="article.id
<!--                class="article-search__item"-->

                <span >{{ article.ab_name }}</span>
                <span >
                    {{ (article.ab_price / 100).toFixed(2) }}€
                </span>
            </li>
        </ul>

        <p
            v-else-if="searchText.length >= 3"
            class="article-search__no-results"
        >
            Keine Treffer gefunden.
        </p>

        <button @click="handleLeft"><</button>
        <button @click="handleRight">></button><br>

        <!-- Price filter -->
        <label for ="priceLowerBound">Price Low limit: </label>
        <input type="text" id="priceLowerBound" v-model="priceLowerBound" placeholder="Lower price bound"/>

        <label for ="priceUpperBound">Price High limit: </label>
        <input type="text" id="priceUpperBound" v-model="priceUpperBound" placeholder="Upper price bound"/><br>

        <!-- Category filter -->
        <label for ="category">Category: </label>
        <select v-model="category" id="category">
            <option value="0">None</option>
            <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.ab_name }}
            </option>
        </select>

    </div>
</template>

<style scoped lang="scss">
// Variablen
$input-padding: 0.5rem 1rem;
$input-border-width: 1px;
$input-border-style: solid;
$input-border-color: #ccc;
$list-bg: #706f6c;
$item-bg: #939393;
$no-results-color: #ff6b6b;
$transition-time: 0.2s;

// Mixin
@mixin transition($props...) {
    transition: $props $transition-time ease;
}

// Placeholder-Selektor
%text-base {
    font-family: Amiri, serif;
    font-size: 1rem;
}

.article-search {
    &__input {
        @extend %text-base;
        padding: $input-padding;
        border: $input-border-width $input-border-style $input-border-color;
        width: 100%;
        max-width: 300px;
        @include transition(border-color, box-shadow);

        &:focus {
            border-color: darken($input-border-color, 20%);
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
    }

    &__list {
        list-style: none;
        margin: 0.5rem 0 0;
        padding: 0;
        background: $list-bg;
        border-radius: 4px;
    }

    &__item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem;
        background: $item-bg;
        border-bottom: 1px solid darken($item-bg, 10%);

        &:last-child {
            border-bottom: none;
        }
    }

    &__name {
        @extend %text-base;
    }

    &__price {
        @extend %text-base;
        font-weight: bold;
    }

    &__no-results {
        @extend %text-base;
        color: $no-results-color;
        margin-top: 0.5rem;
    }
}
</style>
