<template>
  <div>
    <header>
      <b-nav class="float-right">
        <b-nav-item href="/ticket" v-if="[1,4].includes($page.props.auth.user.type_user_id)">Tickets</b-nav-item>
        <b-nav-item href="/ticketOperateur" v-if="[2,3,4].includes($page.props.auth.user.type_user_id)" >Ticket à résoudre</b-nav-item>
        <b-nav-item href="/ticketUnassigned" v-if="[3,4].includes($page.props.auth.user.type_user_id)">Ticket à attribuer</b-nav-item>
        <b-nav-item href="/disconnect">Déconnexion</b-nav-item>
      </b-nav>
    </header>
    <article>
      <slot />
    </article>
  </div>
</template>

<script>
export default {
  //$page.props.auth.user accèder à l'utilisateur connecté
};
</script>
