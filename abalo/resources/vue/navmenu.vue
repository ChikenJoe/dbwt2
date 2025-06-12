<script>
export default {
    props: ['items']
}
</script>

<template>
    <nav>
        <ul>
            <li v-for="item in items" :key="item.text">
                <a :href="item.url">{{ item.text }}</a>

                <ul v-if="item.children">
                    <li v-for="child in item.children" :key="child.text">
                        <a :href="child.url">{{ child.text }}</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</template>


<style scoped>
nav{
    font-family: Amiri;
}
nav ul {
    list-style-type: none;
    display: flex;
}
nav li {
    position: relative;
    margin-right: 20px;
}
nav ul ul {
    display: none;
    position: absolute;
}
nav li:hover ul {
    display: block;
    background-color: #a1a09a;
}

</style>
