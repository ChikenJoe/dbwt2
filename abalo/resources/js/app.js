import './bootstrap';
import { shoppingCart } from './shoppingcart.js';
import { ListObject, items } from './navMenuObject.js';
import { createApp } from "vue";
import { add_article_form, submitArticle } from './add_article_form.js';
import { cookieCheck } from './cookiecheck.js';
import { data } from './data.js';
import { getAnzahlProdukteOfKategorie} from "./getAnzahlProdukteOfKategorie.js";
import { getGesamtWert } from "./getGesamtWert.js";
import { getMaxPreis, getMaxPreisNoAlert} from "./getMaxPreis.js";
import { getMinPreisProdukt } from "./getMinPreisProdukt.js";
import { getPreisSum } from './getPreisSum.js';
import { format } from 'mathjs';
import ClickCounter from '../vue/clickcounter.vue'
import SiteHeader from '../vue/siteheader.vue';
import SiteBody from '../vue/sitebody.vue';
import SiteFooter from '../vue/sitefooter.vue'
import Cart from '../vue/cart.vue';
import ArticleForm from '../vue/articleform.vue';
import ArticleSearch from '../vue/articlesearch.vue';
import ArticleOverview from '../vue/articleoverview.vue';
import VueFloatMenu from 'vue-float-menu';
import 'vue-float-menu/style.css';
window.ListObject = ListObject;
window.items = items;
window.data = data;
//window.shoppingCart = shoppingCart;
window.cookieCheck = cookieCheck;

/*

window.add_article_form = add_article_form;
window.format = format;

*/
/*
const oldsiteApp = createApp({
    components:{
        ArticleSearch,
        ArticleOverview
    }
});
*/

const newsiteApp = createApp({


    components:{
        SiteHeader,
        SiteBody,
        SiteFooter,
        Cart,
        ArticleForm
    },
    data: function(){
        return {
            page: 1,
            articles:[],
            shoppingcartitems:[],
            items: [
                { name: 'Home' },
                { name: 'Kategorien' },
                {name: 'Verkaufen' },
                {name: 'Unternehmen',
                    subMenu: {
                        name: 'edit-items',
                        items: [{name: 'Philosophie'}, {name: 'Karriere'}],
                    },
                }
            ]


        }
    },
    created: function(){


        const handleSelection = (selectedItem) => {
            console.log('Selected:', selectedItem);
        };

        let xhr_articles = new XMLHttpRequest();
        xhr_articles.open('GET', '/api/articles');
        xhr_articles.setRequestHeader('Accept', 'application/json');
        xhr_articles.onload = () => {
            if (xhr_articles.status === 200) {
                this.$data.articles = JSON.parse(xhr_articles.responseText);
                console.log("First object of articles received: ");
                console.log(this.$data.articles[0]);
            }
        }
        xhr_articles.onerror = () => { console.log("Did not receive any article records"); }
        xhr_articles.send();

        //Receive shopping cart records
        let xhr_shoppingcart = new XMLHttpRequest();
        xhr_shoppingcart.open('GET', '/api/shoppingcartitems');
        xhr_shoppingcart.setRequestHeader('Accept', 'application/json');

        xhr_shoppingcart.onload = () => {
            if (xhr_shoppingcart.status === 200){
                this.$data.shoppingcartitems = JSON.parse(xhr_shoppingcart.responseText);
                console.log("First object of shoppingcart received: ");
                console.log(this.$data.shoppingcartitems[0]);
            }
        }
        xhr_shoppingcart.send();


    },
    methods:{
        refresh(){
            console.log("running refresh");
            let xhr_shoppingcart = new XMLHttpRequest();
            xhr_shoppingcart.open('GET', '/api/shoppingcartitems');
            xhr_shoppingcart.setRequestHeader('Accept', 'application/json');

            xhr_shoppingcart.onload = () => {
                if (xhr_shoppingcart.status === 200){
                    this.$data.shoppingcartitems = JSON.parse(xhr_shoppingcart.responseText);
                    console.log("First object of shoppingcart received: ");
                    console.log(this.$data.shoppingcartitems[0]);
                }
            }
            xhr_shoppingcart.send();
        }
    },
    template: `
        <div class ="wrapper">
            <div id ="top"><site-header/></div>
            <div class="middle-wrapper">
                <div id ="left"></div>
                <div id ="middle">
                    <site-body v-bind:shoppingcartitems='shoppingcartitems'
                                             v-bind:articles='articles'
                                             v-bind:page ="page"
                                             @refresh="refresh"/>
                    </div>
                <div id ="right">
                    <cart v-bind:shoppingcartitems='shoppingcartitems'
                          v-bind:articles='articles'
                          @refresh="refresh"/>
                </div>
            </div>
            <div id="footer"><site-footer v-on:update:page="page = $event"/></div>


            <!-- Float Menu -->
            <float-menu :buttons="buttons" position="right" :menu-data="items">
                <template #toggle>


                </template>
            </float-menu>
        </div>`
});
if (document.getElementById('app') && window.location.pathname === '/newsite') {
    newsiteApp.use(VueFloatMenu);
    newsiteApp.mount('#app');
}

if (document.getElementById('addarticle')) {
    createApp({ components: { ArticleForm } })
        .mount('#addarticle');
}

window.Echo.channel('maintenance')
    .listen('.MaintenanceEvent', (e) => {

        alert(e.message);
    });



window.Echo.channel('user.1')
    .listen('ArticleSoldEvent', e => {
        alert(e.message);
    });
