<template>
    <div class="your-design">
        <h2>Your design</h2>
        <div class="uploads">
            <vue-dropzone class='zone' ref="myVueDropzone" v-on:vdropzone-file-added="success" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
            <vue-dropzone class='zone' v-if='hasVerso' ref="myVueDropzone" v-on:vdropzone-file-added="successVerso" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
        </div>
    </div>
</template>

<script>
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.css'
export default {
    name: 'DesignZone',
    props: ['productId'],
    components: {
        vueDropzone: vue2Dropzone
    },
    methods: {
        template(){
            return `<div class="dz-preview dz-file-preview">
                <div class="dz-image">
                    <img data-dz-thumbnail>
                </div>
                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
            </div>
        `;
        },
        success(file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                this.$emit('update', e.target.result);
            }.bind(this)

            reader.readAsDataURL(file);
            
        },
        successVerso(file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                this.$emit('updateV', e.target.result);
            }.bind(this)

            reader.readAsDataURL(file);
            
        }
    },
    created(){
        switch(this._props.productId){
            case '2':
                this.hasVerso = true

            break;
            default:
                this.hasVerso = false

            break;
        }
    },
    data () {
        return {
            dropzoneOptions: {
                url: 'https://httpbin.org/post',
                thumbnailWidth: 200,
                previewTemplate: this.template(),
                dictDefaultMessage: "Recto"
            },
            dropzoneOptions2: {
                url: 'https://httpbin.org/post',
                thumbnailWidth: 200,
                previewTemplate: this.template(),                
                dictDefaultMessage: "Verso"
            },
            hasVerso: null
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
