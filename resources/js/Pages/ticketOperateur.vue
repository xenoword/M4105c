<template>
    <b-container>
        <b-row>
            <b-col offset-md="1">
                <h1>Mes tickets</h1>
            </b-col>
        </b-row>
        <b-row>
            <b-col md="2">
                <label for="emeteur">Emeteur : </label>
            </b-col>
            <b-col md="3">
                <b-form-select id="emeteur" v-model="selectedEmeteur" :options="optionsEmeteur" text-field="name" value-field="id">
                    <b-form-select-option :value="0">Tous</b-form-select-option>
                </b-form-select>
            </b-col>
            <b-col md="4">
                <label for="dateSort">Trie en fonction de la date de création : </label>
            </b-col>
            <b-col md="3">
                <b-form-select id="dateSort" v-model="selectedDateSort" :options="optionsDateSort"></b-form-select>
            </b-col>

            <b-col md="4">
                <label for="urgence">Urgence (1 : pas urgent 5 : très urgent) : </label>
            </b-col>
            <b-col md="3">
                <b-form-select id="urgence" v-model="selectedUrgence" :options="optionsUrgence"></b-form-select>
            </b-col>
            <b-col md="2">
                <label for="statut">Statut : </label>
            </b-col>
            <b-col md="3">
                <b-form-select id="statut" v-model="selectedStatut" :options="optionsStatut"></b-form-select>
            </b-col>

        </b-row>
        <ticket-list-view :ticketList="ticketList" class="ticketListView"></ticket-list-view>

    </b-container>
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
        },
        optionsEmeteur: {
            type : Array,
            defaultValue(){
                return [/*{value: 'tous', text: 'Tous'}*/];
            }
        }
    },
    mounted(){
        this.selectedEmeteur = this.$route().params.emeteur ?? "0";
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
        },
        selectedEmeteur: function(){
            this.$inertia.reload({ data: {
                emeteur : this.selectedEmeteur
            }})
        }
    },
    data(){
        return {
            selectedEmeteur: 'Tous',
            
            selectedStatut: 'Tous',
            optionsStatut: [
                {value: 'Tous', text: 'Tous'},
                {value: 'Résolus', text: 'Fermé'},
                {value: 'Non résolus', text: 'Ouvert'}
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
    max-height: 80vh;
}
</style>