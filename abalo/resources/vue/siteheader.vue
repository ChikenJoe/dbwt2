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
    <div>
        <article-search></article-search>
        <nav-menu v-bind:items="items"></nav-menu>
    </div>
</template>

<style scoped>
div{
    display:flex;
    grid-template-columns: 1fr 1fr;
}

</style>
