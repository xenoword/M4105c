<template>
    <div>
        <h1>Un site cool</h1>
        <!-- <List v-for="list in lists" :key="list.title" :title="list.title" :items="list"></List> -->
        <input class="inputIndex" placeholder="Salut ça va ?" :v-model="title">
        <Link :href="$route('login')">Pour se log c'est ici stuv</Link>
        <List :title="title" :items="list"></List>
        <Link :href="$route('bonjour')">Bonjour</Link>
        <b-button variant="primary" v-on:Click="reloadData">Recharger les données</b-button>
    </div>
</template>

<script>
import List from "../Components/List.vue"
export default {
    name: "Index",
    components: {
        List
    },
    props: {
        list: {
            type : Array,
            defaultValue(){
                return [];
            }
        }
    },
    data(){
        return {
        }
    },
    methods: {
        reloadData(){
            this.$inertia.reload();
        }
    }
}
</script>
