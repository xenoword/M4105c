<template>
  <b-container>
    <b-row>
      <b-col offset-md="1">
        <h1>Les tickets non attribué</h1>
      </b-col>
    </b-row>
    <b-row class="pb-4">
    </b-row>
    <b-row>
      <b-col>
        <ticket-list-view :ticketList="listTicketUnassigned" class="ticketListView"></ticket-list-view>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import ticketListView from "../Components/ticketListView.vue";
export default {
  name: "Ticket",
  components: {
    ticketListView,
  },
  props: {
    listTicketUnassigned: {
      type: Array,
      defaultValue() {
        return [];
      },
    }
  },
  data() {
  },
};
</script>
<style scoped>
.ticketListView{
  max-height: 70vh;
}
</style>