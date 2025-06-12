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

import { FloatMenu } from 'vue-float-menu';
import 'vue-float-menu/style.css';

const items = [
    { name: 'New' },
    {
        name: 'Edit',
        subMenu: {
            name: 'edit-items',
            items: [{ name: 'Copy' }, { name: 'Paste' }],
        },
    },
    { name: 'Open Recent' },
    { name: 'Save' },
];

const handleSelection = (selectedItem) => {
    console.log('Selected:', selectedItem);
};
</script>

<template>
    <template>
        <float-menu position="top left" :dimension="50" :menu-data="items" @select="handleSelection">
            <template #icon>
                <BoxIcon />
            </template>
        </float-menu>
    </template>
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

