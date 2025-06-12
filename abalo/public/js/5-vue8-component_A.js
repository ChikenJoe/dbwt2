import ComponentB from '../js/5-vue8-component_B.js';

export default{
    components:{
        ComponentB
    },
    template:`
        <div>
            <h2>Component A</h2>
            <p>Count: {{ count }}</p>
            <component-b v-on:callParentMethod="thisMethod"></component-b>
        </div>
    `,
    data(){
        return {
          count: 1
        }
    },
    methods:{
        thisMethod(){
            this.count++;
        }
    }
}
