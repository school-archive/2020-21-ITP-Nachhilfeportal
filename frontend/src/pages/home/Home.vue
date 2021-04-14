<template>
  <div>

    <section class="section-landing-page">
      <div class="title">
        <div class="logo">
          <img src="@/assets/images/logo_white.svg">
        </div>
      </div>
    </section>

  </div>
</template>

<script>
export default {
  name: "Home"
}
</script>

<style lang="scss" scoped>

  .section-landing-page {
    height: calc(100vh - 50px);
    background-image: url("~@/assets/images/logo.png");
  }

</style>