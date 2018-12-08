<template>
    <div :data-vimeo-id="lesson.video_id" data-vimeo-width="640" v-if="lesson" id="handstick"></div>
</template>

<script>
    import Player from '@vimeo/player';
    import Swal from 'sweetalert';

    export default {
        name: "Player",
        props: ['default_lesson', 'next_lesson_url'],
        data() {
            return {
                lesson: JSON.parse(this.default_lesson)
            }
        },
        methods: {
            displayVideoEndedAlert() {
                swal("Good job!", "You completed this lesson, go to next one!", "success")
                    .then( () => window.location = this.next_lesson_url );
            }
        },
        mounted() {
            const player = new Player('handstick');
            player.on('ended', () => {
                this.displayVideoEndedAlert();
            });
        }
    }
</script>

<style scoped>

</style>