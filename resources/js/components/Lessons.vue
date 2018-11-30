<template>
    <div class="container text-center" style="color: black; font-weight: bold;">
        <h1 class="text-center">
            <button class="btn btn-primary" @click="createNewLesson()">
                Create New Lesson
            </button>
        </h1>

        <ul class="list-group">
            <li class="list-group-item" v-for="lesson in lessons">
                {{ lesson.title}}
            </li>
        </ul>

        <create-lesson/>

    </div>
</template>

<script>
    export default {
        name: 'Lessons',
        props: ['default_lessons', 'series_id'],
        data() {
            return  {
                lessons: JSON.parse(this.default_lessons)
            }
        },
        // computed: {
        //     formattedLessons() {
        //         return JSON.parse(this.lessons)
        //     }
        // },
        methods: {
            createNewLesson() {
                this.$emit('create_new_lesson', this.series_id)
            }
        },
        components: {
            "create-lesson": require('./children/CreateLesson.vue')
        },
        mounted() {
            this.$on('lesson_created', (payLoad) => {
                this.lessons.push(payLoad);
            });
        }
    }
</script>

<style scoped>

</style>