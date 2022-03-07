<template>
  <b-list-group class="scrollable">
    <b-list-group-item v-for="ticket in ticketList" :key="ticket.id" class="element">
      <b-container>
        <b-row>
          <b-col cols="1" v-if="ticket.date_end != null">
            <b-icon icon="check" variant="success" shift-h="-4" font-scale="6" ></b-icon>
            <p>résolu</p>
          </b-col>
          <b-col cols="1" v-if="ticket.date_end == null">
            <b-icon icon="x" variant="danger" shift-h="-4" font-scale="6" v-if="ticket.date_end == null"></b-icon>
            <small class="text-nowrap">non résolu</small>
          </b-col>
          <b-col>
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Ticket Numéro {{ ticket.id }}</h5>
            <small >envoyé il y a {{ getDaySinceCreation(ticket) }} jour(s) et {{ getHourSinceCreation(ticket) }} heure(s)</small>
          </div>

          <p class="mb-1">
            {{ticket.description}}
          </p>
            <b-button class="float-right" variant="outline-primary" v-if="$route().current() == 'userTicket'" :href="$route('displayEditTicket',{id:ticket.id})">Editer</b-button>

            <b-button class="float-right" variant="outline-primary" v-if="$route().current() == 'ticketOperateur'" :href="$route('detailTicketOperateur', {id:ticket.id})" >Voir</b-button>

          </b-col>
        </b-row>
      </b-container>
    </b-list-group-item>
    <p v-if="ticketList.length == 0">pas de ticket</p>
  </b-list-group>
</template>

<script>
export default {
  name: "List",
  props: {
    ticketList: {
      type: Array,
      required: true,
    },
  },
  methods: {
    getHourSinceCreation: function (ticket){
      let nbDay = this.getDaySinceCreation(ticket);
      let nbHour = Math.floor((new Date().getTime() - 3600000 - new Date(ticket.date_start).getTime())/3600000);
      return nbHour - nbDay * 24;
    },
    getDaySinceCreation: function (ticket){
      return Math.floor((new Date().getTime() - 3600000 - new Date(ticket.date_start).getTime())/84600000);
    }
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