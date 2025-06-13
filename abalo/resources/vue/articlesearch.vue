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
            <li
                v-for="article in articles"
                :key="article.id"
                class="article-search__item"
            >
                <span class="article-search__name">{{ article.ab_name }}</span>
                <span class="article-search__price">
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
