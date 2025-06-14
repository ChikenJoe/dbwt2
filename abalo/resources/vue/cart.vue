<script>
    export default{
        emits: ['refresh'],
        props:['shoppingcartitems', 'articles'],
        methods: {
            removeArticle(id, event){
                let xhr = new XMLHttpRequest();
                let csrf = document.getElementById('csrf-token').getAttribute('content');
                xhr.open('DELETE', `/api/shoppingcart/1/articles/${id}`)
                xhr.setRequestHeader('X-CSRF-TOKEN', csrf);

                xhr.onload = () => {
                    if (xhr.status === 200){
                        let li = event.target.closest('li');
                        li.remove();
                        this.$emit('refresh');
                    }
                    else{
                        console.error("Couldnt delete article from cart.");
                        alert("Couldnt delete article from cart.");
                    }
                }

                xhr.send();
            }
        },
        computed: {
            articleLookup(){
                return this.articles.reduce((acc, article) => {
                    acc[article.id] = article.ab_name;
                    return acc;
                }, {});
            }
        }
    }
</script>

<template>
    <h2>Warenkorb</h2>
    <ul>
        <li v-for="item in shoppingcartitems" :data-id="item.ab_article_id">
            {{ articleLookup[item.ab_article_id] }}
        <button @click="removeArticle(item.ab_article_id, $event)" >-</button>
        </li>
    </ul>
</template>
