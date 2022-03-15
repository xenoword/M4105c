<template>
    <div>
        <h1>Problème sur le poste {{ticket.computer}}</h1>
        <br>

        <div>
            <p>Description du problème : </p>
            <p>{{ticket.description}}</p>
        </div>

        <div>
            <p>Image du problème : </p>
            <p v-if="ticket.link_attached_file != null">{{ticket.link_attached_file}}</p>
            <p v-else>Aucune image n'as été fournie</p>
        </div>

        <div>
            <p>Urgence du problème (1 : pas urgent 5 : très urgent) : </p>
            <p>{{ticket.urgency}}</p>
        </div>

        <div>
            <p>Type de problème : </p>
            <p>{{ticket.probleme.libelle}} : {{ticket.probleme_precision.libelle}}</p>
        </div>

        <div>
            <p>Date de création du ticket : </p>
            <p>{{ticket.date_start}}</p>
        </div>

        <div>
            <p>Date de fermeture du ticket : </p>
            <p v-if="ticket.date_end != null">Le ticket a été résolu le {{ticket.date_end}}</p>
            <p v-else>Le ticket est toujours en cour de résolution</p>
        </div>

        <div>
            <p>Commentaire :</p>
            <p>{{ticket.comment}}</p>
        </div>

        <div>
            <b-button v-b-modal.modal-prevent-closing>Fermer le ticket</b-button>

            <b-modal
            id="modal-prevent-closing"
            ref="modal"
            title="Fermeture du ticket"
            @ok="handleOkClosing">
                <p>Etes-vous sûr(e) de vouloir fermer le ticket ?</p>
            </b-modal>

            <b-button v-b-modal.modal-prevent-addComment>Ajouter un commentaire</b-button>

            <b-modal
                id="modal-prevent-addComment"
                ref="modal"
                title="Saisissez votre commentaire"
                @ok="handleOkAddComment">
                <form ref="form" @submit.stop.prevent="handleSubmit">

                    <b-form-group
                        label="Comment"
                        label-for="comment-input"
                        invalid-feedback="Saisissez votre commentaire">

                        <b-form-input
                        id="comment-input"
                        v-model="comment"
                        required></b-form-input>

                    </b-form-group>

                </form>
            </b-modal>

            <b-button :href="$route('ticketReallocationOperator', {id:ticket.id})">Envoyer à un autre opérateur</b-button>
        </div>

    </div>
</template>

<script>
export default {
    name: "TicketDetailOperator",
    data() {
      return {
        comment: ''
      }
    },
    props: {
        ticket : Object
    },
    methods:{

        handleOkClosing(){        
            this.$inertia.post('/closeTicket/'+this.ticket.id);
        },

        handleOkAddComment(){
            this.$inertia.post('/addCommentOperator/'+this.comment+'/'+this.ticket.id);
        }

    }
};
</script>