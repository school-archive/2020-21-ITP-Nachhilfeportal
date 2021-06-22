<template>
  <div>
    <img src="@/assets/images/aboutus.jpg" alt="aboutus" class="crop-center">
    <h1 class="u1">Über Uns</h1>
    <div class="wrapper">

      <div class="el1">
        <div class="half">
          <div class="text">
            <h2 class="u2">Idee</h2>
            <p>Nachhilfe ist heutzutage an Schulen ein wichtiges Thema, deshalb bieten wir Schüler*innen und Tutoren eine
              schnelle und effiziente Möglichkeit Nachhilfe innerhalb der Schule zu finden. Das Projekt soll die
              Organisation und Vermittlung der Nachhilfe verbessern und eine einfach zu bedienende digitale Alternative
              darstellen. Das Ziel unseres Nachhilfeportals ist, allen Schüler*innen jeglichen Jahrganges eine passende
              Nachhilfe zu finden. Sie haben die Möglichkeit einen passenden Tutor nach Jahrgang und benötigtem Fach
              auszuwählen. Unser Nachhilfeportal ist ein schulinternes Projekt, bei welchem sich alle
              Schüler*innen der HTL Rennweg mit ihrer Schulemail anmelden können. Jeder User besitzt eine Profilseite, auf
              welcher wichtige Personendaten vorhanden sind: Name, Telefonnummer, E-Mail, persönlicher Stundenplan für die
              Terminplanung.
            </p>
          </div>
        </div>
        <div class="half">
          <img class="icons" src="@/assets/images/idee.png" alt="idee">
        </div>
      </div><br>

      <div class="el2">
        <div class="half">
          <img class="icons" src="@/assets/images/onedrive.png" alt="onedrive">
        </div>
        <div class="half">
          <div class="text">
            <h2 class="u2">HTL-Rennweg</h2>
            <p>Tutorlink ist ein Projekt der HTL-Rennweg, welches ausschließlich für Schüler*innen dieser Schuleinrichtung
              verwendet werden kann. Das Projekt soll Schüler*innen unserer Schule helfen und diese beim Lernprozess unterstützen.
              Mit der Zusammenarbeit der HTL-Rennweg und der Bildungsberatung kann dies ermöglicht werden und in Zukunft an allen Schulen Wiens verwendet werden.
            </p>
          </div>
        </div>
      </div>

    </div>

    <div class="people">
      <div>
        <img class="team" src="@/assets/images/group.png" alt="team">
      </div>
      <div class="oben">
        <div>
          <img src="@/assets/images/man.png" alt="man"><br>
          <label>Dietrich Kops</label>
        </div>
        <div>
          <img src="@/assets/images/man.png" alt="man"><br>
          <label>Nils Schneider-Sturm</label>
        </div>
      </div>

      <div class="unten">
        <div>
          <img  src="@/assets/images/woman.png" alt="frau"><br>
          <label>Nicoletta Sarzi Sartori</label>
        </div>
        <div>
          <img src="@/assets/images/man.png" alt="man"><br>
          <label>Matthias Stummer</label>
        </div>
        <div>
          <img  src="@/assets/images/woman.png" alt="frau"><br>
          <label>Johanna Kronfuß</label>
        </div>
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
  padding-bottom: 10px;
}


@media (min-width: 950px) {
  .u1{
    font-weight: 200;
    font-style: initial;
    font-size: 40px;
    padding-left: 2em;
    letter-spacing: 2.5px;
    color: colors.$fourth;
    margin-top: 20px;
  }

  .u2 {
    letter-spacing: 2.5px;
    color: colors.$fourth;
    font-style: initial;
    font-size: 30px;

  }
  .people img{
    width:250px;
  }

  .wrapper {
    display: flex;
    flex-direction: column;
    align-content: space-around;
    justify-content: space-around;
  }

  .el1{
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-evenly;
  }

  .el2{
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
  }
  .text{
    text-align: justify;
  }

  .icons {
    width: 20em;
    height: 20em;
  }
  .half{
    display: flex;
    justify-content: center;
    width:40%
  }

  p {
    font-size: 1.3em;

  }


  .team{
    width: 210px;
    padding-top: 50px;
  }

  .people{
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    margin-bottom: 20px;
  }

  .oben,.unten{
    display: flex;
    flex-direction: row;
    align-content: center;
    text-align: center;
    padding-bottom: 20px;
  }

}
@media (max-width: 949px) {
  .u1{
    font-weight: 200;
    font-style: initial;
    font-size: 30px;
    padding-left: 0.5em;
    letter-spacing: 2.5px;
    color: colors.$fourth;
    margin-top: 20px;
  }

  .u2 {
    letter-spacing: 2.5px;
    color: colors.$fourth;
    font-style: initial;
    font-size: 1.5em;
  }
  .wrapper{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    align-content: center;
    line-height: 0px;
  }
  p {
    font-size: 1.4em;
  }
  .half{
    display: flex;
    justify-content: center;
    width:80%
  }

  .text{
    text-align: justify;
  }
  .el1{
    display: flex;
    flex-direction: column-reverse;
    justify-content: center;
    align-items: center;
    align-content: center;
  }
  .el2{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    align-content: center;
  }
  .icons {
    width: 15em;
    height: 15em;
  }
  .people{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    align-content: center;
  }
  .people img{
    width:250px;
  }
  .oben{
    text-align: center;
  }

  .unten{
    text-align: center;
    padding-bottom: 1em;
  }
}

@media (max-width: 700px) {
  .u1{
    font-weight: 200;
    font-style: initial;
    font-size: 30px;
    padding-left: 0.5em;
    letter-spacing: 2.5px;
    color: colors.$fourth;
    margin-top: 20px;
  }

  .u2 {
    letter-spacing: 2.5px;
    color: colors.$fourth;
    font-style: initial;
    font-size: 1.5em;

  }
  .wrapper{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    align-content: center;
  }
  p {
    font-size: 1.2em;
  }
  .text{
    text-align: justify;

  }
  .el1{
    display: flex;
    flex-direction: column-reverse;
    justify-content: center;
    align-items: center;
    align-content: center;
  }
  .el2{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    align-content: center;
  }
  .icons {
    width: 15em;
    height: 15em;
  }
  .people{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    align-content: center;
  }
  .people img{
    width:250px;
  }
  .oben{
    text-align: center;
  }

  .unten{
    text-align: center;
    padding-bottom: 1em;
  }
}

</style>