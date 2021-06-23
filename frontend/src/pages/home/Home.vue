<template>
  <div>
    <section class="section-landing-page">
      <div class="title">
        <div class="logo">
          <img src="@/assets/images/logo_red.png">
        </div>
        <h1 class="font-weight-bold">Tutorlink</h1>
      </div>
    </section>

    <section class="section-searchbar">
      <search-bar @submit="$router.push({
        name: 'Search',
        params: {
          searchData: $event
        }
      })"/>
    </section>

    <section class="section-text" style="  display: table;
  margin: 0 auto; width: 70%">
      <div class="section-text-left">
        <div class="text">
          <h3>Wie funktioniert es?</h3>
          <p>Um unsere Webseite benutzen zu können, ist es wichtig sich anzumelden.
            Danach haben Sie die Möglichkeit Ihr individuelles Profil zu erstellen,
            bei welchem Sie Eigenschaften wie zum Beispiel: Profilbild, Name, Abteilung, Klasse etc. angeben können.
            Nachdem Sie das erledigt haben, können Sie nun die Hauptfunktion unserer Webseite nutzen, nämlich eine/n passende/n Tutor/in suchen.
            Um dies zu tun, haben Sie die Möglichkeit mittels spezifischer Filter nach Tutoren/Tutorinnen zu suchen und anschließend,
            nach betätigen des Suchen Buttons, diese auszuwählen.
          </p>
        </div>
        <img class="bild1" src="@/assets/images/work-731198_1920.jpg"/>
      </div>
      <div class="section-text-right">
        <div class="text">
          <h3>Was bietet Tutorlink?</h3>
          <p>Nachhilfe ist heutzutage an Schulen ein wichtiges Thema, deshalb bieten wir Schüler*innen und Tutoren/Tutorinnen
            eine schnelle und effiziente Möglichkeit Nachhilfe innerhalb der Schule zu finden.
            Tutorlink soll die Organisation und Vermittlung der Nachhilfe verbessern und eine einfach zu bedienende digitale Alternative darstellen.
            Das Ziel unseres Nachhilfeportals ist es, allen Schüler*innen jeglichen Jahrganges eine passende Nachhilfe zu finden.
            Sie haben die Möglichkeit eine/n passende/n Tutor/in nach Jahrgang und benötigtem Fach auszuwählen.
            Zusätzlich kann man auch nach Tutoren*innen einer andern Abteilung suchen. </p>
        </div>
        <img class="bild2" src="@/assets/images/green-chameleon-s9CC2SKySJM-unsplash.jpg" alt="bild"/>
      </div>
    </section>

    <section class="section-faq">
      <h3 class="fragen">Häufig gestellte Fragen</h3>
      <div class="faqs">
        <faq-tile class="single-faq" question="Muss ich angemeldet sein?" answer="Um alle Funktionen von Tutorlink verwenden zu können, müssen Sie sich mit Ihrem Schul-Microsoft Konto anmelden."/>
        <faq-tile class="single-faq" question="Geht es auch außerhalb von der HTL Rennweg?" answer="Zurzeit ist Tutorlink nur für Schüler*innen der HTL Rennweg verfügbar."/>
        <faq-tile class="single-faq" question="Kann ich Tutor*in sein und gleichzeitig Nachhilfe bekommen?" answer="Ja, es gibt keine Beschränkungen dafür."/>
        <faq-tile class="single-faq" question="Wie werde ich Tutor*in?" answer="Um Tutor*in zu werden müssen Sie einfach auf Ihrer Profilseite bei den Einstellungen den Status „Tutor“ zu „Ja“ ändern."/>
      </div>
    </section>

  </div>
</template>

<script>

import FaqTile from "@/pages/home/FaqTile";
import 'vue-slider-component/theme/antd.css'
import SearchBar from "../../components/SearchBar";

export default {
  name: "Home",
  components: {
    SearchBar,
    FaqTile
  },
  metaInfo: {
    title: "Home",
    meta: []
  }
}
</script>

<style lang="scss" scoped>
@use "src/assets/styles/colors";

img {
  object-fit: cover;
}

.section-landing-page {
  height: calc(100vh - 50px);
  background-image: url("~@/assets/images/Startseite_lowres.png");
  background-position: center;
  background-size: cover;

  .title {
    display: flex;
    height: 100%;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    .logo {
      width: 15rem;
      margin: 2rem;
      margin-top:    .125rem;
      margin-bottom: .125rem;
      img {
        height: 100%;
        width: 100%;
      }
    }
    h1 {
      display: inline-block;
      font-size: 6rem;
      color: white;
      margin-left: 2rem;
      margin-right: 2rem;
      margin-top: 0;
      margin-bottom: 0;
      letter-spacing: 2px;
    }
  }
}

.section-faq {
  margin-bottom: 3rem;
  margin-top: 4rem;

  h3 {
    text-align: center;
  }

  .faqs {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    .single-faq {
      margin-top: .1rem;
    }
  }
}

.section-searchbar {
  display: flex;
  justify-content: center;
  padding-top: 3rem;
  padding-bottom: 3rem;
}

.section-text > div {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;


  .text, img{
    width: max(min(90%, 30rem), 50%);
    box-sizing: border-box;
  }


  h3{
    color: colors.$secondary;
    font-size: 30px;
    font-weight: bold;
  }

  .text {
    padding: 2rem;
    display: flex;
    flex-direction: column;
    font-size: 1.5em;
    line-height: 1.5;
    text-align: justify;

  }
}

.section-text {
  .section-text-right {
    flex-direction: row-reverse;
  }
}

.fragen{
  font-size: 30px;
}

.bild1{
  padding:32px;
}

.bild2{
  padding:32px;
}

</style>
