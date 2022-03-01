<template>
  <div>
    <div id="formLogin">
      <b-form @submit.prevent="form.post($route('addTicket'))" @reset="onReset" v-if="show">
        <b-form-group
          id="input-group-1"
          label="Numéro de poste :"
          label-for="input-1"
        >
          <b-form-input
          name="computer"
            id="input-1"
            v-model="form.poste"
            type="text"
            placeholder="Numéro de poste"
            required
          ></b-form-input>
        </b-form-group>

        <div>
          <label for="desc">Description du problème :</label>
          <textarea v-model="form.descPb" name="description" id="pb" cols="30" rows="10"></textarea>
        </div>

        <div>
          <label for="screenshot">Ajouter une capture d'ecran :</label>
          <input ref="inputFile" name="link_attached_file" id="file" type="file" accept="image/*" />
        </div>

        <label for="urgence">Urgence du problème :</label>
        <b-form-select name="urgency" v-model="form.urgency" :options="urgence"></b-form-select>

        <label for="urgence">Type de problème :</label>
        <b-form-select name="probleme" v-model="type" :options="typeList"></b-form-select>

        <label for="urgence" v-if="type">Precision :</label>
        <b-form-select :options="MaterialList" v-if="type == 'material'"></b-form-select>
        <b-form-select :options="SoftList" v-if="type == 'software'"></b-form-select>
        <b-form-select :options="UserList" v-if="type == 'user'"></b-form-select>

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
  data() {
    return {
      form: this.$inertia.form({
        poste: "",
        descPb: "",
        urgency: "",
        type: null,

      }),
      urgence: [
        { value: "1", text: "1" },
        { value: "2", text: "2" },
        { value: "3", text: "3" },
        { value: "4", text: "4" },
        { value: "5", text: "5" },
      ],

      type: "",
      typeList: [
        {value: "", text: "Sélectionner un problème"},
        { value: "material", text: "Materiel" },
        { value: "software", text: "Logiciel" },
        { value: "user", text: "Utilisateur" },
      ],

      MaterialList: [
        { value: "2", text: "Licence expirée" }
      ],
      SoftList: [
        { value: "1", text: "Lol ça marche pas" }
      ],
      UserList: [
        { value: "3", text: "Problème de connexion" }
      ],

      show: true,
    };
  },
  methods: {
    onReset() {
      this.type = ""
      this.poste = ""
      this.descPb = ""
      this.$refs.inputFile.reset();
    }
  }
};
</script>
