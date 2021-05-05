<template>
	<footer class="footer">
		<div class="footer-links">
			<div class="links-top-row">
				<router-link :to="{name: 'Imprint'}">Impressum</router-link>
				<router-link :to="{name: 'Privacy'}">Datenschutz</router-link>
			</div>
			<div class="links-bottom-row">
				<span><font-awesome-icon :icon="faEnvelope"/> <a href="mailto:tutorlink.project@gmail.com">tutorlink.project@gmail.com</a></span>
				<span><font-awesome-icon :icon="faPhoneAlt"/> <a href="tel:+43 650 9879007">+43 650 9879007</a></span>
				<span><font-awesome-icon :icon="faInstagram"/> <a href="https://instagram.com/tutorlink.project" target="_blank">tutorlink.project</a></span>
			</div>
		</div>
		<div class="footer-copyright">
			<p>Copyright @ <a href="https://htlrennweg.at">HTL Rennweg</a></p>
		</div>
	</footer>
</template>

<script>
import {faEnvelope} from '@fortawesome/free-regular-svg-icons';
import {faPhoneAlt} from '@fortawesome/free-solid-svg-icons';
import {faInstagram} from '@fortawesome/free-brands-svg-icons';


export default {
	name: "CustomFooter",
	data() {
		return {
			faEnvelope,
			faInstagram,
			faPhoneAlt,
		}
	}
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

.footer-links {
	padding-top: 1rem;
	padding-bottom: 1rem;
}

.links-top-row {
	display: flex;
	justify-content: center;
}

.links-top-row > * {
	margin-left: .25rem;
	margin-right: .25rem;
}

.links-bottom-row {
	display: flex;
	justify-content: center;
	flex-wrap: wrap;
	width: 80%;
	margin-left: auto;
	margin-right: auto;
	margin-top: .75rem;
}

.links-bottom-row > * {
	margin: .25rem;
}

.footer-copyright {
	background-color: colors.$primary;
	display: flex;
	justify-content: center;
	padding-top: 1rem;
	padding-bottom: 1rem;
}
</style>