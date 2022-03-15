<template>
    <div>

        <operateur-list-view
            :listOperateur="listOperateur"
            class="operateurListView"
            :ticket="ticket"
        ></operateur-list-view>

    </div>
</template>
<script>
import operateurListView from "../Components/operateurListView.vue";
export default {
    name: 'TicketRealocationOperator',
    components: {
        operateurListView,
    },
    props: {
        ticket : Object,
        listOperateur : {
            type: Array,
            defaultValue() {
                return [];
            },
        },
    }
}
</script>
<style scoped>
.operateurListView {
  max-height: 75vh;
}
</style>
