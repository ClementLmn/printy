<template>
    <div id="app">
        <transition
            v-on:enter="enter"
            v-on:leave="leave"
            v-on:before-leave="beforeLeave"
            v-bind:css="false"
            mode="out-in"
        >
            <router-view :key="$route.fullPath" class="content-page"/>
        </transition>
        <div ref="stripes" class="stripes">
            <div ref="black" class="black"></div>
            <div ref="magenta" class="magenta"></div>
            <div ref="yellow" class="yellow"></div>
            <div ref="cyan" class="cyan"></div>
        </div>
        <svg style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <defs>
                <symbol id="icon-cart" viewBox="0 0 32 32">
                    <title>cart</title>
                    <path d="M10.667 32c-2.209 0-4-1.791-4-4s1.791-4 4-4 4 1.791 4 4-1.791 4-4 4zM10.667 29.333c0.736 0 1.333-0.597 1.333-1.333s-0.597-1.333-1.333-1.333-1.333 0.597-1.333 1.333 0.597 1.333 1.333 1.333zM26.667 32c-2.209 0-4-1.791-4-4s1.791-4 4-4 4 1.791 4 4-1.791 4-4 4zM26.667 29.333c0.736 0 1.333-0.597 1.333-1.333s-0.597-1.333-1.333-1.333-1.333 0.597-1.333 1.333 0.597 1.333 1.333 1.333zM8.716 6.667h21.951c0.84 0 1.472 0.769 1.307 1.595l-2.24 11.187c-0.376 1.899-2.061 3.256-3.973 3.219h-14.083c-2.020 0.017-3.737-1.476-4-3.48l-2.024-15.36c-0.089-0.663-0.653-1.16-1.32-1.16h-3c-0.736 0-1.333-0.597-1.333-1.333s0.597-1.333 1.333-1.333h3.003c2.005 0.003 3.699 1.491 3.96 3.48l0.419 3.187zM10.323 18.84c0.087 0.667 0.659 1.165 1.344 1.16h14.12c0.644 0.013 1.207-0.44 1.333-1.075l1.92-9.592h-19.973l1.256 9.507z"></path>
                </symbol>
                <symbol id="icon-user" viewBox="0 0 29 32">
                    <title>user</title>
                    <path d="M28.8 30.4v-3.2c0-4.416-3.584-8-8-8h-12.8c-4.416 0-8 3.584-8 8v3.2c0 0.883 0.717 1.6 1.6 1.6s1.6-0.717 1.6-1.6v-3.2c0-2.651 2.149-4.8 4.8-4.8h12.8c2.651 0 4.8 2.149 4.8 4.8v3.2c0 0.883 0.717 1.6 1.6 1.6s1.6-0.717 1.6-1.6zM14.4 16c-4.416 0-8-3.584-8-8s3.584-8 8-8 8 3.584 8 8-3.584 8-8 8zM14.4 12.8c2.651 0 4.8-2.149 4.8-4.8s-2.149-4.8-4.8-4.8-4.8 2.149-4.8 4.8 2.149 4.8 4.8 4.8z"></path>
                </symbol>
                <symbol id="icon-grid" viewBox="0 0 32 32">
                    <title>grid</title>
                    <path d="M3.2 3.2v8h8v-8h-8zM1.6 0h11.2c0.883 0 1.6 0.717 1.6 1.6v11.2c0 0.883-0.717 1.6-1.6 1.6h-11.2c-0.883 0-1.6-0.717-1.6-1.6v-11.2c0-0.883 0.717-1.6 1.6-1.6zM20.8 11.2h8v-8h-8v8zM19.2 0h11.2c0.883 0 1.6 0.717 1.6 1.6v11.2c0 0.883-0.717 1.6-1.6 1.6h-11.2c-0.883 0-1.6-0.717-1.6-1.6v-11.2c0-0.883 0.717-1.6 1.6-1.6zM20.8 28.8h8v-8h-8v8zM19.2 17.6h11.2c0.883 0 1.6 0.717 1.6 1.6v11.2c0 0.883-0.717 1.6-1.6 1.6h-11.2c-0.883 0-1.6-0.717-1.6-1.6v-11.2c0-0.883 0.717-1.6 1.6-1.6zM3.2 28.8h8v-8h-8v8zM1.6 17.6h11.2c0.883 0 1.6 0.717 1.6 1.6v11.2c0 0.883-0.717 1.6-1.6 1.6h-11.2c-0.883 0-1.6-0.717-1.6-1.6v-11.2c0-0.883 0.717-1.6 1.6-1.6z"></path>
                </symbol>
            </defs>
        </svg>
    </div>
</template>

<script>
import HeaderTop from '@/components/HeaderTop'
import TweenMax from 'gsap'
export default {
    name: 'app',

    components: {
		HeaderTop
	},
    methods: {
        beforeLeave: function(el){
            const stripes = [this.$refs.yellow, this.$refs.magenta, this.$refs.cyan, this.$refs.black]
            TweenMax.set(stripes, {transformOrigin:'50% bottom'})
        },
        leave: function (el, done) {
            const stripes = [this.$refs.yellow, this.$refs.magenta, this.$refs.cyan, this.$refs.black]
            TweenMax.staggerTo(stripes, 0.4, {scaleY: 1, ease: Power2.easeInOut}, 0.1, function(){
                TweenMax.set(stripes, {transformOrigin:'50% top'})
                done();

            })
        },
        enter: function (el) {
            const stripes = [this.$refs.yellow, this.$refs.magenta, this.$refs.cyan, this.$refs.black]
            TweenMax.staggerTo(stripes, 0.4, {scaleY: 0, delay: 0.1, ease: Power2.easeInOut}, 0.1)
        }
    }
}
</script>

<style lang='scss'>
    @import './styles/main.scss';
</style>
