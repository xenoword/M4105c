<template>
  <b-list-group class="scrollable">
    <b-list-group-item v-for="ticket in ticketList" :key="ticket.id" class="element">
      <b-container>
        <b-row>
          <b-col cols="1" v-if="ticket.date_end != null">
            <b-icon icon="check" variant="success" shift-h="-4" font-scale="6" ></b-icon>
            <p>Fermé</p>
          </b-col>
          <b-col cols="1" v-if="ticket.date_end == null">
            <b-icon icon="x" variant="danger" shift-h="-4" font-scale="6" v-if="ticket.date_end == null"></b-icon>
            <small v-if="ticket.date_end_guess" class="text-nowrap">En cours</small>
            <small v-if="!ticket.date_end_guess" class="text-nowrap">Ouvert</small>
          </b-col>
          <b-col>
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Ticket Numéro {{ ticket.id }}</h5>
            <small class="float-right" v-if="ticket.date_end_guess" >résolution prévu le : {{ getDateEnd(ticket) }} jour(s)</small>
            <small >envoyé il y a {{ getDaySinceCreation(ticket) }} jour(s) et {{ getHourSinceCreation(ticket) }} heure(s)</small>
          </div>

          <p class="mb-1">
            {{ticket.description}}
          </p>
          <b-button class="float-right" variant="outline-primary" v-if="$route().current() == 'userTicket' && ticket.date_end == null" :href="$route('displayEditTicket',{id:ticket.id})">Editer</b-button>
          <b-button class="float-right" variant="outline-primary" v-if="$route().current() == 'listTicketUnassigned'" :href="$route('listOperateur',{id:ticket.id})">Attribuer à un Opérateur</b-button>
          <div class="float-right" v-if="$route().current() == 'ticketOperateur'">
            <b-button variant="outline-primary" v-if="!ticket.date_end_guess" v-b-modal.modal-take-over-ticket @click="form.id = ticket.id">prendre en charge</b-button>
            <b-button variant="outline-danger" v-if="!ticket.date_end_guess" :href="$route('abortTicket',{id:ticket.id})">incompétent</b-button>
            <b-button variant="outline-primary" v-if="$route().current() == 'ticketOperateur'" :href="$route('detailTicketOperateur', {id:ticket.id})" >Voir</b-button>

            
          </div>
          </b-col>
        </b-row>
      </b-container>
    </b-list-group-item>

    <b-modal
              id="modal-take-over-ticket"
              ref="modalTakeOverTicket"
              title="Quand estimez-vous résoudre ce ticket"
              @ok="handleOkTakeOverTicket">
              <form ref="formTakeOverTicket" @submit.prevent="handleSubmitTakeOverTicket">

              <b-form-group
                  label="Date de résolution : "
                  label-for="date-input"
                  invalid-feedback="Saisissez la date de fin estimé">
                <b-calendar id="date-input" locale="fr-FR" :min="min" v-model="form.dateEndGuess"></b-calendar>

              </b-form-group>

              </form>
            </b-modal>
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
    },
    getDateEnd: function (ticket){
      return ticket.date_end_guess.toString().substring(0,10);
    },
    handleOkTakeOverTicket: function (bvModalEvt){
      bvModalEvt.preventDefault()
      this.handleSubmitTakeOverTicket()
    },
    handleSubmitTakeOverTicket() {
        if (!this.checkFormValidity()) {
          return
        }

        this.form.post(this.$route('takeOverTicket',{ticket:this.form.id}));

        this.$nextTick(() => {
          this.$bvModal.hide('modal-take-over-ticket')
        })
    },
    checkFormValidity() {
        const valid = this.$refs.formTakeOverTicket.checkValidity()
        return valid
    }
  },
  data() {
    return {
    min : new Date(),
    form: this.$inertia.form({
        id: "",
        dateEndGuess : new Date(),
      }),
    };
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