<template>
  <div>
    <header>
      <b-nav class="float-right">
        <b-nav-item href="/ticket">Tickets</b-nav-item>
        <b-nav-item
          href="/ticketOperateur"
          v-if="$page.props.auth.user.type_user_id != 1"
          >A faire</b-nav-item
        >
        <b-nav-item
          href="/listOperateur"
          v-if="$page.props.auth.user.type_user_id == 3"
          >Liste opérateurs</b-nav-item
        >
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
