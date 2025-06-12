export default{
    data: function(){
        return {
            count: 1
        }
    },
    template: `<button @click="count++">Increment count</button><br>
               <button @click="count--">Decrement count</button>
               <p>{{count}}</p>`
}
