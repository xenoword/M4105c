<template>
  <div>
    <b-form @reset="onReset">
      <div id="formClose">
        <label for="example-datepicker"
          >Choisir une date de cloture de ticket</label
        >
        <b-form-datepicker
          dropdown="true"
          id="example-datepicker"
          v-model="form.value"
          class="mb-2"
          placeholder="Selectionner une date"
        ></b-form-datepicker>
        <div>
          <label for="comment">Description :</label>
          <textarea id="pb" name="desc" v-model="form.desc"></textarea>
        </div>
        <div class="button">
          <b-button type="submit" variant="primary">Submit</b-button>
          <b-button type="reset" variant="danger">Reset</b-button>
        </div>
      </div>
    </b-form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: this.$inertia.form({
        value: this.value ?? "",
        desc: this.desc ?? "",
      }),
      }
    },
  methods: {
        onReset() {
          this.form.value = null, (this.form.desc = "");
        },
  }
};
</script>

<style scoped>
.dropdown {
  position: initial; 
}
</style>