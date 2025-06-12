<script>
import ArticleOverview from "./articleoverview.vue";
import Impressum from "./impressum.vue"

    export default{
        components:{
            ArticleOverview,
            Impressum
        },
        props:['articles', 'page', 'shoppingcartitems'],
        methods:{
            refresh(){
                console.log("Sitebody refresh");
                this.$emit('refresh');
            }
        }
    }
</script>

<template>
    <div v-if="page === 1" >
        <article-overview v-bind:shoppingcartitems="shoppingcartitems"
                          v-bind:articles="articles"
                            @refresh="refresh">
        </article-overview>
    </div>
    <div v-else-if="page === 2" >
        <impressum></impressum>
    </div>
</template>

