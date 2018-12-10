<template>
    <div>
        <button class="btn btn-success" @click="subscribe('monthly')">Subscribe to $9.99 Monthly</button>
        <button class="btn btn-info" @click="subscribe('yearly')">Subscribe to $99.99 Yearly</button>
    </div>
</template>

<script>
    export default {
        name: "Stripe",
        mounted() {
            this.handler = StripeCheckout.configure({
                key: 'pk_test_YfIsNjYBg5qDNRc54KRSkaj8',
                image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
                locale: 'auto',
                token(token) {
                    // You can access the token ID with `token.id`.
                    // Get the token ID to your server-side code for use.
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
                    this.plan = 'monthly';
                    this.amount = 9.99;
                } else {
                    this.plan = 'yearly';
                    this.amount = 99.99;
                }

                this.handler.open({
                    name: 'App',
                    description: 'App subscription',
                    amount: this.amount
                })
            }
        }
    }
</script>

<style scoped>

</style>