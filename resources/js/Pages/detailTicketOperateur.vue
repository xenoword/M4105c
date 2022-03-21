<template>
  <div class="detailDiv">
    <h1>Problème sur le poste {{ ticket.computer }}</h1>
    <br />

    <div>
      <p>Description du problème :</p>
      <p>{{ ticket.description }}</p>
    </div>

    <div>
      <p>Image du problème :</p>
      <p v-if="ticket.link_attached_file != null">
        {{ ticket.link_attached_file }}
      </p>
      <p v-else>Aucune image n'a été fournie</p>
    </div>

    <div>
      <p>Urgence du problème (1 : pas urgent 5 : très urgent) :</p>
      <p>{{ ticket.urgency }}</p>
    </div>

    <div>
      <p>Type de problème :</p>
      <p>
        {{ ticket.probleme.libelle }} : {{ ticket.probleme_precision.libelle }}
      </p>
    </div>

    <div>
      <p>Date de création du ticket :</p>
      <p>{{ ticket.date_start }}</p>
    </div>

    <div>
      <p>Date prévue pour la fermeture du ticket :</p>
      <p v-if="ticket.date_end_guess">{{ getDateEnd(ticket) }}</p>
      <p v-else>
        Il n'y pas encore de date de fin de prévu car aucun opérateur ne
        s'occupe de ce ticket pour le moment
      </p>
    </div>

    <div>
      <p>Date de fermeture du ticket :</p>
      <p v-if="ticket.date_end != null">
        Le ticket a été résolu le {{ ticket.date_end }}
      </p>
      <p v-else>Le ticket est toujours en cours de résolution</p>
    </div>

    <div>
      <p>Commentaire :</p>
      <p>{{ ticket.comment }}</p>
    </div>

    <div>
      <b-button
        v-b-modal.modal-prevent-closing
        v-if="ticket.date_end == null && ticket.date_end_guess != null && $page.props.auth.user.id != ticket.user_id"
        >Fermer le ticket</b-button
      >

      <b-modal
        id="modal-prevent-closing"
        ref="modal"
        title="Fermeture du ticket"
        @ok="handleSolved"
        ok-title="Oui"
        @cancel="handleNotSolved"
        cancel-title="Non"
      >
        <p>Le ticket a t-il été résolu ?</p>
        
        <!-- <template #modal-footer="">
            <b-button size="sm" variant="success" @click="handleSolved()">
                Oui
            </b-button>

            <b-button size="sm" variant="danger" @click="handleNotSolved()">
                Non
            </b-button>
        </template> -->

      </b-modal>

      <b-button
        v-b-modal.modal-prevent-addComment
        v-if="ticket.date_end == null && ticket.date_end_guess != null && $page.props.auth.user.id != ticket.user_id"
        >Ajouter un commentaire</b-button
      >

      <b-modal
        id="modal-prevent-addComment"
        ref="modal"
        title="Saisissez votre commentaire"
        @show="resetModalAddComment"
        @hidden="resetModalAddComment"
        @ok="handleOkAddComment"
      >
        <form
          ref="formAddComment"
          @submit.stop.prevent="handleSubmitAddComment"
        >
          <b-form-group
            invalid-feedback="Saisissez votre commentaire"
            :state="commentState"
          >
            <label for="comment-input">Commentaire : </label>
            <b-form-input
              id="comment-input"
              v-model="comment"
              :state="commentState"
              placeholder="Saisissez votre commentaire"
              required
            ></b-form-input>
          </b-form-group>
        </form>
      </b-modal>

      <b-button
        :href="$route('ticketReallocationOperator', { id: ticket.id })"
        v-if="
          ticket.date_end == null &&
          ticket.date_end_guess != null &&
          ticket.operateur_id != 1 &&
          $page.props.auth.user.id != ticket.user_id
        "
        >Envoyer à un autre opérateur</b-button
      >

      <b-button
        v-b-modal.modal-prevent-addIntervention
        v-if="ticket.date_end == null && ticket.date_end_guess != null && $page.props.auth.user.id != ticket.user_id"
        >Répertorier une intervention</b-button
      >

      <b-modal
        id="modal-prevent-addIntervention"
        title="Saisissez votre intervention"
        @ok="handleOkAddIntervention"
        @show="resetModalIntervention"
        @hidden="resetModalIntervention"
      >
        <form ref="formIntervention">
          <b-form-group
            invalid-feedback="Saisissez une description de l'intervention"
            :state="descriptionState"
          >
            <label for="description-input"
              >Description de l'intervention :</label
            >
            <b-form-textarea
              name="description-input"
              placeholder="Saisissez une description"
              v-model="description"
              :state="descriptionState"
              required
              maxlength="255"
            ></b-form-textarea>

            <label for="date-input"
              >Date à laquelle a eu lieu l'intervention :</label
            >
            <b-form-input
              name="date-input"
              v-model="date"
              type="date"
              :max="maxDate"
            ></b-form-input>
          </b-form-group>
        </form>
      </b-modal>

      <b-button
        v-b-modal.modal-prevent-modifyTicket
        v-if="ticket.date_end == null && ticket.date_end_guess != null && $page.props.auth.user.id != ticket.user_id"
        >Modifier le ticket</b-button
      >

      <b-modal
        id="modal-prevent-modifyTicket"
        title="Saisissez vos modifications"
        @show="resetModifyTicketModal"
        @hidden="resetModifyTicketModal"
        @ok="handleOkModifyTicket"
      >
        <form ref="modifyTicketForm">
          <b-form-group
            invalid-feedback="Choississez une précision pour le problème"
            :state="precisionProblemState"
          >
            <label for="problemType">Type de problème :</label>
            <b-form-select
              name="problemType"
              v-model="form.probleme_id"
              :options="problemeList"
              text-field="libelle"
              value-field="id"
            ></b-form-select>

            <label for="precision_problem" v-if="form.probleme_id"
              >Précision :</label
            >
            <b-form-select
              name="precision_problem"
              v-model="form.precision_probleme_id"
              :options="materialList"
              text-field="libelle"
              value-field="id"
              v-if="form.probleme_id == '1'"
              :state="precisionProblemState"
              required
            ></b-form-select>
            <b-form-select
              name="precision_problem"
              v-model="form.precision_probleme_id"
              :options="softList"
              text-field="libelle"
              value-field="id"
              v-if="form.probleme_id == '2'"
              :state="precisionProblemState"
              required
            ></b-form-select>
            <b-form-select
              name="precision_problem"
              v-model="form.precision_probleme_id"
              :options="userList"
              text-field="libelle"
              value-field="id"
              v-if="form.probleme_id == '3'"
              :state="precisionProblemState"
              required
            ></b-form-select>

            <label for="urgency">Urgence du problème :</label>
            <b-form-select
              name="urgency"
              v-model="form.urgency"
              :options="urgencyList"
            ></b-form-select>

            <label for="urgency">Date de fermeture prévue</label>
            <b-calendar
              id="date-input"
              locale="fr-FR"
              :min="min"
              v-model="form.date_end_guess"
            ></b-calendar>
          </b-form-group>
        </form>
      </b-modal>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import VueSimpleAlert from "vue-simple-alert";

Vue.use(VueSimpleAlert);
export default {
  name: "TicketDetailOperator",
  data() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();

    if (dd < 10) {
      dd = "0" + dd;
    }
    if (mm < 10) {
      mm = "0" + mm;
    }

    today = yyyy + "-" + mm + "-" + dd;

    return {
      form: this.$inertia.form({
        probleme_id: this.ticket?.probleme_id ?? "",
        precision_probleme_id: this.ticket?.precision_probleme_id ?? "",
        urgency: this.ticket?.urgency ?? "",
        date_end_guess: this.ticket?.date_end_guess ?? "",
      }),
      comment: "",
      description: "",
      descriptionState: null,
      commentState: null,
      date: today,
      maxDate: today,
      precisionProblemState: null,
      urgencyList: [
        { value: "1", text: "1" },
        { value: "2", text: "2" },
        { value: "3", text: "3" },
        { value: "4", text: "4" },
        { value: "5", text: "5" },
      ],
      min: new Date(),
    };
  },
  props: {
    ticket: Object,
    problemeList: Array,
    materialList: Array,
    softList: Array,
    userList: Array,
  },
  methods: {
    //Date formater
    getDateEnd: function (ticket) {
      return ticket.date_end_guess.toString().substring(0, 10);
    },

    //Pour fermer le ticket
    handleSolved() {
      this.$inertia.post("/closeTicket/" + this.ticket.id+ "/", { solved: true });
    },
    
    handleNotSolved() {
      this.$inertia.post("/closeTicket/" + this.ticket.id+ '/', { solved: false });
    },
    //Pour ajouter un commentaire
    handleOkAddComment(bvModalEvt) {
      bvModalEvt.preventDefault();
      this.handleSubmitAddComment();
    },
    resetModalAddComment() {
      this.comment = "";
      this.commentState = null;
    },
    handleSubmitAddComment() {
      if (!this.checkAddCommentFormValidity()) {
        return;
      }

      this.$inertia.post(
        "/addCommentOperator/" + this.comment + "/" + this.ticket.id
      );

      this.$nextTick(() => {
        this.$bvModal.hide("modal-prevent-addComment");
      });
    },
    checkAddCommentFormValidity() {
      const valid = this.$refs.formAddComment.checkValidity();
      this.commentState = valid;
      return valid;
    },

    //Pour ajouter une intervention
    handleOkAddIntervention(bvModalEvt) {
      bvModalEvt.preventDefault();
      this.handleSubmitIntrvention();
    },
    checkInterventionFormValidity() {
      const valid = this.$refs.formIntervention.checkValidity();
      this.descriptionState = valid;
      return valid;
    },
    resetModalIntervention() {
      this.description = "";
      this.descriptionState = null;
    },
    handleSubmitIntrvention() {
      if (!this.checkInterventionFormValidity()) {
        return;
      }

      this.$inertia.post(
        "/addIntervention/" +
          this.ticket.id +
          "/" +
          this.description +
          "/" +
          this.date
      );

      this.$alert("Votre intervention a bien été enregistrée");

      this.$nextTick(() => {
        this.$bvModal.hide("modal-prevent-addIntervention");
      });
    },

    //Pour modifier le ticket
    handleOkModifyTicket(bvModalEvt) {
      bvModalEvt.preventDefault();

      this.handleSubmitModifyTicket();
    },
    checkModifyTicketFormValidity() {
      const valid = this.$refs.modifyTicketForm.checkValidity();
      this.precisionProblemState = valid;
      return valid;
    },
    handleSubmitModifyTicket() {
      if (!this.checkModifyTicketFormValidity()) {
        return;
      }

      this.$inertia.post(
        "/modifyTicketOperator/" +
          this.form.probleme_id +
          "/" +
          this.form.precision_probleme_id +
          "/" +
          this.form.urgency +
          "/" +
          this.form.date_end_guess +
          "/" +
          this.ticket.id
      );

      this.$nextTick(() => {
        this.$bvModal.hide("modal-prevent-modifyTicket");
      });
    },
    resetModifyTicketModal() {
      this.precisionProblemState = null;
      this.form.probleme_id = this.ticket.probleme_id;
      this.form.precision_probleme_id = this.ticket.precision_probleme_id;
      this.form.urgency = this.ticket.urgency;
    },
  },
};
</script>
<style scoped>
.detailDiv {
  margin: 10px;
}
</style>