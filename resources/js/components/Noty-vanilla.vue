<template>
    <div
            class="alert alert-noty"
            :class="type"
            v-if="notification"
    >
        <p class="text-center">{{ notification.message }}</p>
    </div>
</template>

<script>
    export default {
        name: "Noty",
        created() {
            window.events.$on('notification', (payload) => {
                this.notification = payload;
                setTimeout( () => this.notification = null, 2500);
            });
        },
        data() {
            return {
                notification: null
            }
        },
        computed: {
            type() {
                return `alert-${this.notification.type}`;
            }
        }
    }
</script>

<style scoped>
    .alert-noty {
        position: fixed;
        right: 20px;
        bottom: 40px;
        z-index: 1;
    }
</style>