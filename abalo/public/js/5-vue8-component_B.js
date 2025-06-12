export default{
    template:`
        <button v-on:click="notifyParent" >
            Click calls parent component (A) function
       </button>`,
    methods:{
        notifyParent(){
            this.$emit("callParentMethod");
        }
    }
}
