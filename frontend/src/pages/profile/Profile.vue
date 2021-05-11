<template>
  <div>
    <div>
      <div class="profile">
        <div>
          <img src="@/assets/images/mensch.png" alt="mensch">
        </div>
        <div class="info">
          <span class="icon">&#9881;</span>
          <h1>Max Mustermann</h1>
          <p class="text">Informationstechnologie</p>
          <span>4.Klasse</span><br><br>
          <span>Unterricht : </span>
          <button class="button">vor Ort</button> <button class="button">Online</button>
          <br><br>
          <span>Fächer :</span> <br>
          <button class="button">Angewandte Mathematik</button> <button class="button">Physik</button> <button class="button">SYT/GINF</button>
          <br><br>
          <span>Über mich :</span> <br>
          <p class="übermich">Hallo! Ich bin Max und ein sehr toller Mathematiker. Abgesehen davon habe ich einen IQ von
            1200 und meine Stärken liegen beim Integrieren, weniger gut bin ich beim Vektorrechnen.
            Falls Du Fragen zu einem bestimmten Thema hast, vielleicht auch etwas lehrerspezifisches wissen willst,
            schreibe mich einfach an!

            Ich freue mich auf Deine Nachricht!</p>
        </div>
      </div>
    </div>
    <Calendar></Calendar>
  </div>
</template>

<script>

import Calendar from "../../components/Calendar";

export default {
  name: "Profile",
  components: {Calendar}
}
</script>

<style lang="scss" scoped>
@use "src/assets/styles/colors";

.button {
  background-color: colors.$secondary;
  border-color: transparent;
  color: #fff;
  cursor: pointer;
  border-radius: 999px;
  font-size: 17px;
}

.text {
  font-size: 25px;
  margin: 0px;

}

img {
  border-radius: 50%;
  float: left;
  margin: 10px;
  margin-right: 100px;

}

.profile {
  display: flex;
  justify-content: center;
  margin-top: 20px;
}

.übermich {
  width: 620px;
  background-color: #F8F8F8;
  border-radius: 10px;
  padding: 4px;
  font-size: 20px;
}

span {
  font-size: 20px;
}

h1 {
  margin: 0px;
  letter-spacing: 2px;
  font-size: 45px;
}

.icon {
  font-size: 50px;
  float: right;
  color: colors.$secondary
}


</style>