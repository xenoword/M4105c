<template>
    <div>
        <h1>Mes tickets</h1>
        <br>

        <label for="emeteur">Emeteur : </label>
        <b-form-select id="emeteur" v-model="selectedEmeteur" :options="optionsEmeteur"></b-form-select>

        <label for="statut">Statut : </label>
        <b-form-select id="statut" v-model="selectedStatut" :options="optionsStatut"></b-form-select>

        <label for="urgence">Urgence (1 : pas urgent 5 : très urgent) : </label>
        <b-form-select id="urgence" v-model="selectedUrgence" :options="optionsUrgence"></b-form-select>

        <label for="dateSort">Trie en fonction de la date de création : </label>
        <b-form-select id="dateSort" v-model="selectedUrgence" :options="optionsDateSort"></b-form-select>

        <br><br>

        <ticket-list-view :ticketList="ticketList" class="ticketListView"></ticket-list-view>

       <!-- 
        <b-button>Envoyer à un autre opérateur</b-button>
        <b-button>Envoyer au responsable du service</b-button>
        <b-button>Répertorier une intervention</b-button>
         -->

    </div>
</template>

<script>
import ticketListView from "../Components/ticketListView.vue";
export default {
    name: "Ticket",
    components: {
        ticketListView
    },
    props: {
        ticketList: {
            type : Array,
            defaultValue(){
                return [];
            }
        }
    },
    mounted(){
        this.selectedStatut = this.$route().params.resolved ?? "Tous";
        this.selectedUrgence = this.$route().params.urgence ?? "Tous";
        this.selectedDateSort = this.$route().params.dateSort ?? "Plus recents";
    },
    watch: {
        selectedStatut: function(){
        this.$inertia.reload({ data: {
            resolved : this.selectedStatut 
        }});
        },
        selectedUrgence: function(){
        this.$inertia.reload({ data: {
            urgence : this.selectedUrgence 
        }});
        },
        selectedDateSort: function(){
            this.$inertia.reload({ data: {
                dateSort : this.selectedDateSort
            }})
        }
    },
    data(){
        return {
            selectedEmeteur: 'Tous',
            optionsEmeteur: [
                { value: 'Tous', text: 'Tous' }
            ],
            selectedStatut: 'Tous',
            optionsStatut: [
                {value: 'Tous', text: 'Tous'},
                {value: 'Résolus', text: 'Résolus'},
                {value: 'Non résolus', text: 'Non résolus'}
            ],
            selectedUrgence: 'Tous',
            optionsUrgence: [
                {value: 'Tous', text: 'Tous'},
                {value: '1', text: '1'},
                {value: '2', text: '2'},
                {value: '3', text: '3'},
                {value: '4', text: '4'},
                {value: '5', text: '5'}
            ],
            selectedDateSort: 'Plus recents',
            optionsDateSort: [
                {value: 'Plus recents', text: 'Plus récents'},
                {value: 'Plus ancients', text: 'Plus ancients'}
            ]

        }
    }
}
</script>

<style scoped>
.ticketListView{
    max-height: 49vh;
}
</style>