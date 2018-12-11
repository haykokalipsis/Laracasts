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
                    <button class="btn btn-primary btn-xs" @click="editLesson(lesson)">Edit</button>
                    <button class="btn btn-danger btn-xs" @click="deleteLesson(lesson.id, key)">Delete</button>
                </p>
            </li>
        </ul>

        <create-lesson></create-lesson>

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
                        .then( (response) => {
                            this.lessons.splice(key, 1);
                            window.noty({
                                message: 'Lesson deleted successfully',
                                type: 'success'
                            });
                        })
                        .catch( error => window.handleErrors(error));
                }
            },
            editLesson(lesson) {
                let seriesId = this.series_id;
                this.$emit('edit_lesson', {lesson, seriesId});
            }
        },
        components: {
            "create-lesson": require('./children/CreateLesson.vue')
        },
        mounted() {
            this.$on('lesson_created', (payload) => {
                window.noty({
                    message: 'Lesson created successfully',
                    type: 'success'
                });
                this.lessons.push(payload);
            });

            this.$on('lesson_updated', (payload) =>{
                let lessonIndex = this.lessons.findIndex(L => {
                    return payload.id === L.id;
                });

                this.lessons.splice(lessonIndex, 1, payload)
            });
        }
    }
</script>

<style scoped>

</style>