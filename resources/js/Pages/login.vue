<template>
  <div>
    <form id="formLogin" @submit.prevent="form.post($route('login'))">
      <div class="formDiv">
        <label id="emailLabel" for="email">E-mail :</label>
        <input
          id="email"
          type="email"
          v-model="form.email"
          autocomplete="off"
        />
        <b v-if="form.errors.email" class="text-danger">{{
          form.errors.email
        }}</b>
      </div>
 
      <div class="formDiv">
        <label id="passwordLabel" for="password">Mot de passe :</label>
        <input id="password" type="password" v-model="form.password" />
        <b v-if="form.errors.password" class="text-danger">{{
          form.errors.password
        }}</b>
      </div>

      <b-button id="sub" type="submit" :disable="form.processing">
        Login
        <b-spinner small v-if="form.processing"></b-spinner>
      </b-button>
    </form>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      form: this.$inertia.form({
        email: "",
        password: "",
      }),
    };
  },
};
</script>

