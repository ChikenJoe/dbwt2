<script>
    export default{
        props:['articles', 'shoppingcartitems'],
        methods:{
            /*  checks if article is in shoppingcart
                if so, disables "+" button
             */

            articleInShoppingCart(articleid){
                return this.$props.shoppingcartitems.some(item => Number(item.ab_article_id) === Number(articleid));
            },
            addArticle(articleid){
                let xhr = new XMLHttpRequest();
                let csrf = document.getElementById('csrf-token').getAttribute('content');

                xhr.open('POST', `/api/shoppingcart`)
                xhr.setRequestHeader('X-CSRF-TOKEN', csrf);

                xhr.setRequestHeader('Content-Type', 'application/json');
                const postobj = {articleId: articleid};
                const post = JSON.stringify(postobj);

                xhr.onload = () => {
                    if (xhr.status === 200){
                        console.log("added to shoppingcart");
                        console.log(this.$props.shoppingcartitems);
                    }
                }
                xhr.send(post);
            },
            handleClick(articleId){
                this.addArticle(articleId);
                this.$emit('refresh');
            }
        }
    }
</script>

<template>
    <table border="1">
        <thead>
        <tr>
            <td>Article</td>
            <td>Price</td>
            <td>Description</td>
            <td>Bild</td>
            <td>Hinzufügen</td>
        </tr>
        </thead>
        <tr v-for="article in articles" v-bind:data-id="article.id">
            <td>{{ article.ab_name }}</td>

            <td>{{ (article.ab_price / 100).toFixed(2) }}€</td>
            <td>{{ article.ab_description}}</td>
            <td v-if="article.image">
                <img v-bind:src="'/img/articleimages/' + article.image.ab_img_filename"
                     alt="Platzhalter"
                     height="128px"
                     width="192px">
            </td>
            <td>
                <button class="add-to-cart"
                        @click="handleClick(article.id)"
                        :disabled="articleInShoppingCart(article.id)">+
                </button>
            </td>
        </tr>
    </table>
</template>

<style scoped>
*{
    font-family: "Dubai Medium";
    text-align:center;
}
thead{
    font-weight: bold;
}
</style>

