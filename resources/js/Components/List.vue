<template>
    <div class="list">
        <h1>{{ title }}</h1>
        <b-list-group>
            <b-list-group-item v-for="element in items" :key="element">{{ element }}</b-list-group-item>
        </b-list-group>
    </div>
</template>

<script>
export default {
    name: "List",
    props: {
        title: {
            type: String,
            required: true
        },
        items : {
            type: Array,
            required: true
        }
    },
    data(){
        return {

        }
    },
    mounted() {
        //quand tout est créé
    },
    computed: {
        titleUppercase(){
            return this.title.toUpperCase();
        }
    }

}
</script>

<style scoped>
.list{
    background-color: #A000A0;
    font-size: 3em;
    border: solid black 2px;
    border-radius: 10px;
    padding: 20px;
}
</style>