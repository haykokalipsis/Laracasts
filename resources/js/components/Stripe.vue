<template>
    <div>
        <button class="btn btn-success" @click="subscribe('monthly')">Subscribe to $9.99 Monthly</button>
        <button class="btn btn-info" @click="subscribe('yearly')">Subscribe to $99.99 Yearly</button>
    </div>
</template>

<script>
    import Swal from 'sweetalert';
    import Axios from 'axios';

    export default {
        name: "Stripe",
        props: ['email'],
        mounted() {
            this.handler = StripeCheckout.configure({
                key: 'pk_test_YfIsNjYBg5qDNRc54KRSkaj8',
                image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
                locale: 'auto',
                token(token) {
                    Swal({ text: 'Please wait while we subscribe you to a plan ...', buttons: false});
                    Axios.post('/subscribe', {
                        stripeToken: token.id,
                        plan: window.stripePlan
                    }).then( () => {
                        Swal({ text: 'Successfully subscribed to a plan', icon: 'success'})
                            .then( () => window.location = '');
                    });

                }
            });
        },
        data() {
            return {
                plan: '',
                amount: 0,
                handler: null
            }
        },
        methods: {
            subscribe(plan) {
                if(plan === 'monthly') {
                    window.stripePlan = 'monthly';
                    this.amount = 9.99;
                } else {
                    window.stripePlan = 'yearly';
                    this.amount = 99.99;
                }

                this.handler.open({
                    name: 'App',
                    description: 'App subscription',
                    amount: this.amount,
                    email: this.email
                })
            }
        }
    }
</script>

<style scoped>

</style>