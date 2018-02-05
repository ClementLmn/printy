<template>
    <div class='thickness paper-options'>
        <h3>Thickness</h3>
        <div>
            <div class="thick-meter">
                <span class="thick-wrapper">
                    <div class='thick'></div>
                </span>
                <div class="thick-slider">
                    <span class='prev'></span>
                    <div class='thick-inner'>
                        <span class='gsm'>150gsm</span>
                        <span class='gsm'>250gsm</span>
                        <span class='gsm'>350gsm</span>
                    </div>
                    <span class='next'></span>
                </div>
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
    name: 'PaperThickness',
    components: {
        
    },
    data () {
        return {
        
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
