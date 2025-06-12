export default{
    props:['count'],
    template:`<button @click="$emit('update:count', (count + 1))">Inc count</button>
              <button @click="$emit('update:count', (count - 1))">Dec count</button>`
}
