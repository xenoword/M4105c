<template>
  <b-container>
    <b-row>
      <b-col offset-md="1">
        <h1>Mes tickets</h1>
      </b-col>
    </b-row>
    <b-row class="pb-4">
      <b-col md="4" offset-md="7">
        <b-form-select v-model="selected" :options="options"></b-form-select>
      </b-col>
    </b-row>
    <b-row>
      <b-col>
        <ticket-list-view :ticketList="ticketList" class="ticketListView"></ticket-list-view>
      </b-col>
    </b-row> 
    <b-row class="mt-4">
      <b-col md="3" offset-md="8">
        <b-button variant="primary" :href="$route('ticketSaisiUser')">Nouveau ticket</b-button>
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
    ticketList: {
      type: Array,
      defaultValue() {
        return [];
      },
    }
  },
  mounted(){
    this.selected = this.$route().params.resolved ?? "tous";
  },
  watch: {
    selected: function(){
      this.$inertia.reload({ data: {
        resolved : this.selected 
      }});
    }
  },
  data() {
    return {
      selected: "tous",
      options: [
        { value: "tous", text: "Tous" },
        { value: "resolu", text: "Résolu(s)" },
        { value: "nonResolu", text: "Non résolu(s)" },
      ],
    };
  },
};
</script>
<style scoped>
.ticketListView{
  max-height: 70vh;
}
</style>