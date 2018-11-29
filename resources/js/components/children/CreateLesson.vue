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
                    <button type="button" class="btn btn-primary">Save Lesson</button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {

        name: "CreateLesson",
        data() {
            return {
                title: '',
                video_id: '',
                episode_number: '',
                description: ''
            }
        },
        mounted() {
            this.$parent.$on('create_new_lesson', () =>{
                console.log('Hello parent');
                $('#createLesson').modal();
            });
        }
    }
</script>

<style scoped>

</style>