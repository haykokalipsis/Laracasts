<template>
    <div :data-vimeo-id="lesson.video_id" data-vimeo-width="640" v-if="lesson" id="handstick"></div>
</template>

<script>
    import Player from '@vimeo/player';

    export default {
        name: "Player",
        props: ['default_lesson'],
        data() {
            return {
                lesson: JSON.parse(this.default_lesson)
            }
        },
        mounted() {
            const player = new Player('handstick');
            player.on('play', () => console.log('video is playing'))
        }
    }
</script>

<style scoped>

</style>