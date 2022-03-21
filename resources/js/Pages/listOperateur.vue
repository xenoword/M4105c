<template>
  <div>
    <b-container>
      <b-row>
        <b-col offset-md="1">
          <h1>Les Opérateurs</h1>
        </b-col>
      </b-row>
      <b-row>
        <b-col>
          <operateur-list-view
            :listOperateur="listOperateur"
            :ticket="ticket"
            :countTicket="countTicket"
            class="operateurListView"
          ></operateur-list-view>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import operateurListView from "../Components/operateurListView.vue";
export default {
  name: "Ticket",
  components: {
    operateurListView,
  },
  props: {
    listOperateur: {
      type: Array,
      defaultValue() {
        return [];
      },
    },
    ticket: {
      type: Object,
    },
    countTicket: {
      type: Object,
    },
  },
  data() {
    return {};
  },
};
</script>
<style scoped>
.operateurListView {
  max-height: 75vh;
}
</style>