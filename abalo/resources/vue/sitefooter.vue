<script>
    export default{
        props:['page']
    }
</script>

<template>
    <a @click="$emit('update:page', 1)">Artikelübersicht</a>
    <a @click="$emit('update:page', 2)">Impressum</a>
</template>

<style scoped>
a{
    padding:5px;
}
</style>
