<template>
    <div>
        <h1>Bonjour !</h1>
        <Link :href="$route('index')">Home</Link>
        <!-- <a href="https://www.annexe.clement-turlure.fr" target="blank_">Annexe</a> -->
    </div>
</template>

<script>
export default {
    name: "Bonjour"
}
</script>
