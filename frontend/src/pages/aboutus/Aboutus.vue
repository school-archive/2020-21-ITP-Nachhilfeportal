<template>
  <div>
    <img src="@/assets/images/aboutus.jpg" alt="aboutus" class="crop-center">
    <span class="u1">Über Uns</span>
    <div class="wrapper">
      <div class="el1">
        <span class="u2">Idee</span>
        <p>Lorem ipsum dolor sit amet, consetetur sadipscing
          elitr, sed diam nonumy eirmod tempor invidunt
          ut labore et dolore magna aliquyam erat,
          sed diam voluptua. At vero eos et accusam
          et justo duo dolores et ea rebum. Stet clita kasd
          gubergren, no sea takimata sanctus est
          Lorem ipsum dolor sit amet. Lorem ipsum
          dolor sit amet, consetetur sadipscing elitr,
          Lorem ipsum dolor sit amet, consetetur
          sadipscing elitr, Lorem ipsum
          dolor sit amet,
        </p>
        <img class="icons" src="@/assets/images/idee.png" alt="idee">
      </div>

    </div>
  </div>
</template>

<script>

export default {
  name: "Aboutus"
}
</script>

<style scoped lang="scss">

@use "src/assets/styles/colors";
img.crop-center {
  height: 250px;
  width: 100% !important;
  object-fit: cover;
  object-position: top center;
}

.u1{
  font-weight: 200;
  font-style: initial;
  font-size: 40px;
  padding-left: 4em;
  letter-spacing: 2.5px;
  color: colors.$fourth;
}

.u2 {
  letter-spacing: 2.5px;
  color: colors.$fourth;
  font-style: initial;
  font-size: 30px;

}
.wrapper{
  padding-left: 300px;
  padding-right: 300px;
}

.el1{

}
.icons{
  width: 15%;


}

p{
  font-size: 18px;
  width: 50%;

}


</style>