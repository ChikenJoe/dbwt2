export default{
    data(){
        return{
            currentPage: 1
        }
    },
    template:`
            <button @click="currentPage--" v-bind:disabled="currentPage === 1"><</button>
            <button @click="currentPage++" v-bind:disabled="currentPage === 10">></button><br>
            <p>{{ pagecount }}</p>
            `
}
