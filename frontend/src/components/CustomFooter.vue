<template>
  <footer class="footer">
    <div class="footer-top-part">
      <p>asdsa</p>
    </div>
    <div class="footer-bottom-part">
      <p>Copyright @ <a href="https://htlrennweg.at">HTL Rennweg 1030 Wien</a></p>
      <router-link :to="{name:'Data'}">
        <p>Datenschutz</p>
      </router-link>
      <router-link :to="{name: 'Imprint'}">
        <p>Impressum</p>
      </router-link>
    </div>
  </footer>
</template>

<script>
export default {
  name: "CustomFooter"
}
</script>

<style lang="scss" scoped>
@use "src/assets/styles/colors";

.footer {
  color: white;
  background-color: lighten(colors.$primary, 10%);
  box-sizing: content-box;
}
.footer p {
  margin: 0;
}
.footer-top-part {
  padding-top: 1rem;
  padding-bottom: 1rem;
}
.footer-bottom-part {
  background-color: colors.$primary;
  display: flex;
  justify-content: center;
  padding-top: 1rem;
  padding-bottom: 1rem;
}
</style>