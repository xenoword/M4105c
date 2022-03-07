<template>
  <b-list-group class="scrollable">
    <b-list-group-item v-for="operateur in listOperateur" :key="operateur.id" class="element">
      <b-container>
        <b-row>
          <b-col>
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Opérateur :  {{ operateur.id }}</h5>
          </div>
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Nom : {{   operateur.name   }}</h5>
          </div>
            <b-button class="float-right" variant="outline-primary" v-if="$route().current() == 'userTicket'" :href="$route('displayDetailOperateur',{id:operateur.id})">Détails</b-button>
          </b-col>
        </b-row>
         <b-button class="float-right" variant="outline-primary">Attribuer</b-button>
         <!--Ceci est a mettre dans button Attribuer v-if="$route().current() == 'listOperateur'" :href="$route('AttributionOperateur', {id:operateur.id})" -->
      </b-container>
    </b-list-group-item>
    <p v-if="listOperateur.length == 0">pas d'opérateur</p>
  </b-list-group>
</template>

<script>
export default {
  name: "List",
  props: {
    listOperateur: {
      type: Array,
      required: true,
    },
  },
  methods: {

  },
  data() {
    return {};
  },
  mounted() {
    //quand tout est créé
  }
};
</script>
<style scoped>
.scrollable{
  overflow-y: scroll;
}
.element{
  min-height: 150px;
}
</style>