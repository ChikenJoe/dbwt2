<!--
    Header hat:
        Artikelsuche
        NavMenu
-->
<script>
import { ListObject } from '../js/navMenuObject.js';
import ArticleSearch from '../vue/articlesearch.vue'
import { items } from '../js/navMenuItems.js';
import NavMenu from '../vue/navmenu.vue';

export default{
    components:{
        ArticleSearch,
        NavMenu
    },
    data(){
        return{
            items
        }
    }
}
</script>

<template>
    <div class="grid-container">
        <nav-menu v-bind:items="items"></nav-menu>
        <div class="search">
            <article-search></article-search>
        </div>
    </div>
</template>

<style scoped>
.grid-container {
    display: grid;

    grid-template-columns: 1fr 300px;
    gap: 1rem;
}


</style>
