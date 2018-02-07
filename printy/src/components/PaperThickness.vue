<template>
    <div class='thickness paper-options'>
        <h3>Weight</h3>
        <div>
            <div class='vertical-slider'>
                <span v-on:click='prevSlide' class='prev'></span>
                <div ref='sliderSize' class="inner-slider">
                    <span class='slide' v-for='slide in beforePrevSize' :data-index='slide.index'>{{slide.txt}}</span>

                    <span v-on:click='prevSlide' class='slide' v-for='slide in prevSize' :data-index='slide.index'>{{slide.txt}}</span>

                    <span class='slide active' v-for='slide in currentSize' :data-index='slide.index'>{{slide.txt}}</span>

                    <span v-on:click='nextSlide' class='slide' v-for='slide in nextSize' :data-index='slide.index'>{{slide.txt}}</span>

                    <span class='slide' v-for='slide in afterNextSize' :data-index='slide.index'>{{slide.txt}}</span>
                </div>
                <span v-on:click='nextSlide' class='next'></span>
            </div>
        </div>
        <div>
            <div class="ref">
                <span class="ref-title">Stuff Reference</span>
                <div class='ref-numbers'>
                    <span v-html='this.sizes[currentSize[0].index].refer'></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PaperThickness',
    components: {
        
    },
    methods : {
        setSize(a,b,c,d,e) {
            this.beforePrevSize = [{
                index: a,
                txt: this.sizes[a].name
            }];
            this.prevSize = [{
                index: b,
                txt: this.sizes[b].name
            }];
            this.currentSize = [{
                index: c,
                txt: this.sizes[c].name
            }];
            this.nextSize = [{
                index: d,
                txt: this.sizes[d].name
            }];
            this.afterNextSize = [{
                index: e,
                txt: this.sizes[e].name
            }];
        },
        nextSlide() {
            const ci = this.currentSize[0].index;
            let a, b, c, d, e;

            c = ci >= this.totalSlides - 1 ? 0 : ci + 1;
            b = c - 1 < 0 ? this.totalSlides - 1 : c - 1;
            a = b - 1 < 0 ? this.totalSlides - 1 : b - 1;
            d = c + 1 > this.totalSlides - 1 ? 0 : c + 1;
            e = d + 1 > this.totalSlides - 1 ? 0 : d + 1;
            
            this.setSize(a,b,c,d,e);
            

            TweenMax.staggerFromTo(this.slides, 0.3, {y:"+="+ this.slideHeight}, {y:"-="+ this.slideHeight, ease: Power1.easeInOut}, 0.05);
            
        },
        prevSlide() {
            const ci = this.currentSize[0].index;
            let a, b, c, d, e;

            c = ci <= 0 ? this.totalSlides - 1 : ci - 1;
            b = c - 1 < 0 ? this.totalSlides - 1 : c - 1;
            a = b - 1 < 0 ? this.totalSlides - 1 : b - 1;
            d = c + 1 > this.totalSlides - 1 ? 0 : c + 1;
            e = d + 1 > this.totalSlides - 1 ? 0 : d + 1;

            this.setSize(a,b,c,d,e);

            TweenMax.staggerFromTo(this.slides, 0.3, {y:"-="+ this.slideHeight}, {y:"+="+ this.slideHeight, ease: Power1.easeInOut}, -0.05);
            
        }
    },
    
    created(){
            
        this.sizes = [{name :"300gsm", refer: "2."}, {name :"350gsm", refer: "6."}, {name :"400gsm", refer: "4."}, {name :"450gsm", refer: "1."}, {name :"500gsm", refer: "3."}, {name :"550gsm", refer: "5."},];

        this.totalSlides = this.sizes.length;

        this.beforePrevSize = [{
            index: this.sizes.length - 2,
            txt: this.sizes[this.sizes.length - 2].name
        }];
        this.prevSize = [{
            index: this.sizes.length - 1,
            txt: this.sizes[this.sizes.length - 1].name
        }];
        this.currentSize = [{
            index: 0,
            txt: this.sizes[0].name
        }];
        this.nextSize = [{
            index: 1,
            txt: this.sizes[1].name
        }];
        this.afterNextSize = [{
            index: 2,
            txt: this.sizes[2].name
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
            nexting: false,
            refer: 'No reference'
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
