new Vue({
    el: '#app',
    data: {
        textareaHeight: 40, // Initial height of the textarea
    },
    methods: {
        expandTextarea() {
            // Toggle between normal and expanded sizes
            this.textareaHeight = (this.textareaHeight === 40) ? 120 : 40;
        },
    },
});