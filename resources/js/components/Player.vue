<template>
    <div :data-vimeo-id="lesson.video_id" data-vimeo-width="640" v-if="lesson" id="handstick"></div>
</template>

<script>
    import Player from '@vimeo/player';
    import Swal from 'sweetalert';
    import Axios from 'axios';

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
                if(this.next_lesson_url) {
                    Swal("Good job!", "You completed this lesson, go to next one!", "success")
                        .then( () => window.location = this.next_lesson_url );
                } else {
                    Swal("Congratulations!", "You completed this series!");
                }
            },
            completeLesson() {
                Axios.post(`/series/complete-lesson/${this.lesson.id}`, {})
                    .then( () =>  this.displayVideoEndedAlert() );
            }
        },
        mounted() {
            const player = new Player('handstick');
            player.on('ended', () => {
                this.completeLesson();
            });
        }
    }
</script>

<style scoped>

</style>