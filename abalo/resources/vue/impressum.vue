<script>
    export default{
        data:function(){
            return{
                operatorName: 'DoucheBag',
                commercialAddress: 'DoucheBag Road XYZ',
                email:'douchebag@douche.bag',
                phone:'123-456',
                tradeRegisterNumber:'XYZ',
                VAT:'321'
            }
        }
    }
</script>
<template>
    <h2>Impressum</h2>
    <ul>
        <li>Operator: {{operatorName}}</li>
        <li>Address: {{commercialAddress}}</li>
        <li>E-Mail: {{email}}</li>
        <li>Phone: {{phone}}</li>
        <li>TRN: {{tradeRegisterNumber}}</li>
        <li>VAT: {{VAT}}</li>
    </ul>
</template>

<style scoped>
h2{ text-align:center; }
ul{ display: grid; }
li{ padding: 5px; }
</style>
