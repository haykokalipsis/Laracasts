<template>
    <div>
        <button class="btn btn-success" @click="update">Update card details</button>
    </div>
</template>

<script>
    import Swal from 'sweetalert';
    import Axios from 'axios';

    export default {
        name: "Update Card",
        props: ['email'],
        mounted() {
            this.handler = StripeCheckout.configure({
                key: 'pk_test_YfIsNjYBg5qDNRc54KRSkaj8',
                image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
                locale: 'auto',
                allowRmemberMe: false,
                token(token) {
                    Swal({ text: 'Please wait while we update your card details...', buttons: false});
                    Axios.post('/card/update', {
                        stripeToken: token.id,
                    }).then( () => {
                        Swal({ text: 'Successfully updated card details.', icon: 'success'})
                            .then( () => window.location = '');
                    });

                }
            });
        },
        data() {
            return {
                handler: null
            }
        },
        methods: {
            update() {


                this.handler.open({
                    name: 'App',
                    description: 'App subscription',
                    email: this.email,
                    panelLabel: 'Update card details'
                })
            }
        }
    }
</script>

<style scoped>

</style>