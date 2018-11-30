<template>
    <!-- Modal -->
    <div class="modal fade" id="createLesson" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Lesson</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Lesson title" v-model="title">
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Vimeo video id" v-model="video_id">
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="number" placeholder="Episode number" v-model="episode_number">
                    </div>

                    <div class="form-group">
                        <textarea cols="30" rows="10" class="form-control" v-model="description"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="createLesson()">Create Lesson</button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import Axios from 'axios';

    export default {

        name: "CreateLesson",
        data() {
            return {
                title: '',
                video_id: '',
                episode_number: '',
                description: '',
                seriesId: ''
            }
        },
        methods: {
            createLesson() {
                let newLesson = {
                    title: this.title,
                    video_id: this.video_id,
                    episode_number: this.episode_number,
                    description: this.description
                };

                Axios.post(`/admin/${this.seriesId}/lessons`, newLesson)
                    .then( (response) => console.log(response))
                    .catch( (error) => console.error(error));
            }
        },
        mounted() {
            this.$parent.$on('create_new_lesson', (seriesId) =>{
                this.seriesId = seriesId;
                $('#createLesson').modal();
            });
        }
    }
</script>

<style scoped>

</style>