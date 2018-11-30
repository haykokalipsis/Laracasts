<template>
    <div class="container text-center" style="color: black; font-weight: bold;">
        <h1 class="text-center">
            <button class="btn btn-primary" @click="createNewLesson()">
                Create New Lesson
            </button>
        </h1>

        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between" v-for="lesson, key in lessons">
                <p>{{ lesson.title}}</p>
                <p>
                    <button class="btn btn-primary btn-xs">Edit</button>
                    <button class="btn btn-danger btn-xs" @click="deleteLesson(lesson.id, key)">Delete</button>
                </p>
            </li>
        </ul>

        <create-lesson/>

    </div>
</template>

<script>
    import Axios from 'axios';

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
            },
            deleteLesson(lesson_id, key) {
                if(confirm('Are you sure you wanna delete?') ) {
                    Axios.delete(`/admin/${this.series_id}/lessons/${lesson_id}`)
                        .then( response => this.lessons.splice(key, 1))
                        .catch( error => console.error(error));
                }
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