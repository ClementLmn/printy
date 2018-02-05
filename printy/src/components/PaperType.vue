<template>
    <div class='type-paper paper-options'>
        <h3>Type</h3>
        <div>
            <div class='vertical-slider'>
                <span v-on:click='prevSlide' class='prev'></span>
                <div ref='sliderSize' class="inner-slider">
                    <span class='slide near' v-for='slide in afterNextSize' :data-index='slide.index'>{{slide.txt}}</span>

                    <span v-on:click='prevSlide' :class='prevClass' class='slide' v-for='slide in nextSize' :data-index='slide.index'>{{slide.txt}}</span>

                    <span class='slide' :class='currClass' v-for='slide in currentSize' :data-index='slide.index'>{{slide.txt}}</span>

                    <span v-on:click='nextSlide' :class='nextClass' class='slide' v-for='slide in prevSize' :data-index='slide.index'>{{slide.txt}}</span>

                    <span class='slide near' v-for='slide in beforePrevSize' :data-index='slide.index'>{{slide.txt}}</span>
                </div>
                <span v-on:click='nextSlide' class='next'></span>
            </div>
        </div>
        
        <div>
            <div class="ref">
                <span class="ref-title">Stuff Reference</span>
                <div class='ref-numbers'>
                    <span>3.</span>
                    <span>7.</span>
                    <span>11.</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PaperType',
    props : ['productId'],
    components: {
        
    },
    computed: {
        prevClass(){
            return{
                'active': this.preving
            }
        },
        nextClass(){
            return{
                'active': this.nexting
            }
        },
        currClass(){
            return{
                'active': !this.nexting && !this.preving
            }
        }
    },
    methods : {
        calculNewSlides() {
            const ci = this.currentSize[0].index;
            let a, b, c, d, e;
            if(this.state == 'prev'){
                this.preving = false;
                c = ci >= this.totalSlides - 1 ? 0 : ci + 1;
            }else if(this.state == 'next'){
                this.nexting = false;
                c = ci <= 0 ? this.totalSlides - 1 : ci - 1;
            }

            b = c - 1 < 0 ? this.totalSlides - 1 : c - 1;
            a = b - 1 < 0 ? this.totalSlides - 1 : b - 1;


            d = c + 1 > this.totalSlides - 1 ? 0 : c + 1;
            e = d + 1 > this.totalSlides - 1 ? 0 : d + 1;

    

            console.log(a, b, c, d, e);
            
            this.beforePrevSize = [{
                index: a,
                txt: this.sizes[a]
            }];
            this.prevSize = [{
                index: b,
                txt: this.sizes[b]
            }];
            this.currentSize = [{
                index: c,
                txt: this.sizes[c]
            }];
            this.nextSize = [{
                index: d,
                txt: this.sizes[d]
            }];
            this.afterNextSize = [{
                index: e,
                txt: this.sizes[e]
            }];
            TweenMax.set(this.slides, {y : -this.slideHeight});
            
        },
        nextSlide() {
            console.log('next');
            this.state = 'next';
            this.nexting = true;
            TweenMax.staggerTo(this.slides, 0.3, {y:"-="+ this.slideHeight, ease: Power1.easeInOut}, 0.05, this.calculNewSlides);
            
        },
        prevSlide() {
            console.log('prev');
            this.state = 'prev';
            this.preving = true;
            TweenMax.staggerTo(this.slides, 0.3, {y:"+="+ this.slideHeight, ease: Power1.easeInOut}, -0.05, this.calculNewSlides);
            
        }
    },
    created(){
        this.sizes = ['Uncoated', 'Coated Matte', 'Coated Gloss'];
        this.testRef = false;

        this.totalSlides = this.sizes.length;

        this.beforePrevSize = [{
            index: this.sizes.length - 2,
            txt: this.sizes[this.sizes.length - 2]
        }];
        this.prevSize = [{
            index: this.sizes.length - 1,
            txt: this.sizes[this.sizes.length - 1]
        }];
        this.currentSize = [{
            index: 0,
            txt: this.sizes[0]
        }];
        this.nextSize = [{
            index: 1,
            txt: this.sizes[1]
        }];
        this.afterNextSize = [{
            index: 2,
            txt: this.sizes[2]
        }];
        
    },
    mounted(){
        this.slides = this.$refs.sliderSize.querySelectorAll('.slide');
        this.slideHeight = this.slides[0].clientHeight;
        TweenMax.set(this.slides, {y : -this.slideHeight});
    },
    data () {
        return {
            sizes: [],
            sizesDom: [],
            slides: null,
            activeS : null,
            slideHeight: 0,
            totalSlides: 0,
            beforePrevSize: null,
            prevSize: null,
            currentSize: null,
            nextSize: null,
            afterNextSize: null,
            testRef: null,
            state: null,
            preving: false,
            nexting: false
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
