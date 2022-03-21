<template>
  <div>
    <div class="d-inline w-100 justify-content-between">
      <b-list-group>
        <b-list-group-item>
          <h5>Problème ticket : {{ ticket.probleme.libelle }}</h5>
          <h5>Description : {{ ticket.description }}</h5>
        </b-list-group-item>
      </b-list-group>
    </div>
    <b-list-group class="scrollable">
      <b-list-group-item
        v-for="operateur in listOperateur"
        :key="operateur.id"
        class="element"
      >
        <b-container>
          <b-row class="mb-2">
            <b-col>
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Opérateur : {{ operateur.id }}</h5>
              </div>
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Nom : {{ operateur.name }}</h5>
              </div>
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">
                  Nombre de ticket en cours : {{ operateur.ticket_list.length }}
                </h5>
              </div>
              <h5 class="mb-1">Compétences :</h5>
              <b-list-group class="w-100">
                <b-list-group-item
                  v-for="canResolve in operateur.can_resolve"
                  :key="canResolve.id"
                  >{{ canResolve.libelle }}
                </b-list-group-item>
              </b-list-group>
            </b-col>
            <b-col>
              <b-button
                class="float-right"
                variant="outline-primary"
                v-if="$route().current() == 'listOperateur'"
                :href="
                  $route('relocateTicketOperator', {
                    ticket: ticket.id,
                    operatorId: operateur.id,
                  })
                "
                >Attribuer</b-button>
                
              <b-button
                class="float-right"
                variant="outline-primary"
                v-if="$route().current() == 'ticketReallocationOperator'"
                :href="
                  $route('relocateTicketOperator', {
                    ticket: ticket.id,
                    operatorId: operateur.id,
                  })
                "
                >Attribuer</b-button
              >
              <b-button
                class="float-right"
                variant="outline-primary"
                v-if="$route().current() == 'userTicket'"
                :href="$route('displayDetailOperateur', { id: operateur.id })"
                >Détails</b-button
              >
            </b-col>
          </b-row>
        </b-container>
      </b-list-group-item>
      <p v-if="listOperateur.length == 0">pas d'opérateur</p>
    </b-list-group>
  </div>
</template>

<script>
export default {
  name: "List",
  props: {
    listOperateur: {
      type: Array,
      required: true,
    },
    ticket: {
      type: Object,
    },
  },
  methods: {},
  data() {
    return {};
  },
  mounted() {
    //quand tout est créé
  },
};
</script>
<style scoped>
.scrollable {
  overflow-y: scroll;
  max-height: 60vh;
}
.element {
  min-height: 150px;
}

.list-group {
  display: block;
}
</style>