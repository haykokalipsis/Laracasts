<template>
    <div class="container text-center" style="color: black; font-weight: bold;">
        <h1 class="text-center">
            <button class="btn btn-primary" @click="createNewLesson()">
                Create New Lesson
            </button>
        </h1>

        <ul class="list-group">
            <li class="list-group-item" v-for="lesson in formattedLessons">
                {{ lesson.title}}
            </li>
        </ul>

        <create-lesson/>

    </div>
</template>

<script>
    export default {
        name: 'Lessons',
        props: ['default_lessons'],
        data() {
            return {
                lessons: this.default_lessons
            }
        },
        computed: {
            formattedLessons() {
                return JSON.parse(this.lessons)
            }
        },
        methods: {
            createNewLesson() {
                this.$emit('create_new_lesson')
            }
        },
        components: {
            "create-lesson": require('./children/CreateLesson.vue')
        }
    }
</script>

<style scoped>

</style>