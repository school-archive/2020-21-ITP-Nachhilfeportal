module.exports = {
    smoothScroll(query) {
        document.querySelector(query).scrollIntoView({
            behavior: 'smooth'
        });
    },
};