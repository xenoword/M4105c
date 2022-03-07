<template>
  <div>
    <div id="formLogin">
      <b-form @submit.prevent="ticket ? form.post($route('addTicket')): form.post($route('editTicket'))" @reset="onReset">
        <b-form-group
          id="urgencyList"
          label="Numéro de poste :"
          label-for="computer"
        >
          <b-form-input
          name="computer"
            id="computer"
            v-model="form.computer"
            type="text"
            placeholder="Numéro de poste"
            required 
          ></b-form-input>
        </b-form-group>

        <div>
          <label for="comment">Description du problème :</label>
          <textarea v-model="form.comment" name="comment" id="pb" cols="30" rows="10"></textarea>
        </div>

        <div>
          <label for="screenshot">Ajouter une capture d'ecran :</label>
          <input ref="inputFile" name="link_attached_file" id="file" type="file" accept="image/*" />
        </div>

        <label for="urgency">Urgence du problème :</label>
        <b-form-select name="urgency" v-model="form.urgency" :options="urgencyList"></b-form-select>

        <label for="probleme">Type de problème :</label>
        <b-form-select name="probleme" v-model="form.probleme_id" :options="problemeList" text-field="libelle" value-field="id"></b-form-select>

        <label for="precision_probleme" v-if="form.probleme_id">Precision :</label>
        <b-form-select name="precision_probleme" v-model="form.precisionProbleme_id" :options="materialList" text-field="libelle" value-field="id" v-if="form.probleme_id == '1'"></b-form-select>
        <b-form-select name="precision_probleme" v-model="form.precisionProbleme_id"  :options="softList" text-field="libelle" value-field="id"    v-if="form.probleme_id == '2'"></b-form-select>
        <b-form-select name="precision_probleme" v-model="form.precisionProbleme_id"  :options="userList" text-field="libelle" value-field="id"    v-if="form.probleme_id == '3'"></b-form-select>
        <p>{{ userList }}</p>
        <div class="button">
          <b-button type="submit" variant="primary">Submit</b-button>
          <b-button type="reset" variant="danger">Reset</b-button>
        </div>
      </b-form>
    </div>
  </div>
</template>

<script>
export default {
  name: "SaisiTicket",
  props: {
    ticket: Object,
    problemeList: Array,
    materialList: Array,
    softList: Array,
    userList: Array
  },
  data() {
    return {
      form: this.$inertia.form({
        computer: this.ticket?.computer ?? "",
        comment: this.ticket?.comment ?? "",
        urgency: this.ticket?.urgency ?? "",
        probleme_id: this.ticket?.probleme_id ?? "",

      }),
      urgencyList: [
        { value: "1", text: "1" },
        { value: "2", text: "2" },
        { value: "3", text: "3" },
        { value: "4", text: "4" },
        { value: "5", text: "5" },
      ]
    };
  },
  /*computed: {
    problemeListFormated(){
      return Array.from(this.problemeList).map((probleme) => {
        return {value:probleme.id, label:probleme.libelle}
      })
    }
  },*/
  methods: {
    onReset() {
      this.computer = "";
      this.comment = "";
      this.urgency = "";
      this.probleme = "";
      this.$refs.inputFile.reset();
    }
  }
};
</script>
