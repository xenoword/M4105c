<template>
  <b-container>
    <b-row>
      <b-col offset-md="1">
        <h1>Les Opérateur</h1>
      </b-col>
    </b-row>
    <b-row>
      <b-col>
        <operateur-list-view
          :listOperateur="listOperateur"
          class="operateurListView"
        ></operateur-list-view>
      </b-col>
    </b-row>
  </b-container>
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