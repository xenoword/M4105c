<template>
  <div>
    <header id="nav">
      <b-card title="Card Title" no-body>
        <b-card-header header-tag="nav">
          <b-nav card-header tabs align="right">
            <b-nav-item disabled>{{ $page.props.auth.user.name }}</b-nav-item>
            <b-nav-item
              exact
              exact-active-class="active"
              to="/ticket"
              v-if="[1, 4].includes($page.props.auth.user.type_user_id)"
              >Tickets</b-nav-item
            >
            <b-nav-item
              to="/ticketOperateur"
              v-if="[2, 3, 4].includes($page.props.auth.user.type_user_id)"
              >Ticket à résoudre</b-nav-item
            >
            <b-nav-item
              to="/ticketUnassigned"
              v-if="[3, 4].includes($page.props.auth.user.type_user_id)"
              >Ticket à attribuer</b-nav-item
            >
            <b-nav-item
              to="/stats"
              v-if="[3, 4].includes($page.props.auth.user.type_user_id)"
              >Stats</b-nav-item
            >
            <b-nav-item to="/disconnect">Déconnexion</b-nav-item>
          </b-nav>
        </b-card-header>
      </b-card>
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
<style scoped>
#nav {
  width: 100vw;
}
</style>