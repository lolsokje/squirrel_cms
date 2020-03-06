<template>
    <div>
        <trumbowyg v-model="content" :config="config" class="form-control" name="body"></trumbowyg>
    </div>
</template>

<script>
    import Trumbowyg from 'vue-trumbowyg';
    import 'trumbowyg/dist/ui/trumbowyg.css';
    import 'trumbowyg/dist/plugins/fontfamily/trumbowyg.fontfamily.js';
    import 'trumbowyg/dist/plugins/table/trumbowyg.table.min.js';
    import 'trumbowyg/dist/plugins/table/ui/trumbowyg.table.min.css';

    export default {
        props: ['article'],
        data() {
            return {
                content: this.article !== undefined ? this.article.body : '',
                config: {
                    resetCss: true,
                    btnsAdd: ['fontfamily', 'table'],
                    btns:   [
                        ['viewHTML'],
                        ['fontfamily'],
                        ['undo', 'redo'],
                        ['formatting'],
                        ['strong', 'em', 'del'],
                        // ['superscript', 'subscript'],
                        ['link'],
                        // ['insertImage'],
                        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                        ['unorderedList', 'orderedList'],
                        ['horizontalRule', 'table'],
                        ['removeformat'],
                        ['fullscreen']
                    ],
                    plugins: {
                        table: {
                            styler: 'editor-table'
                        }
                    }
                }
            }
        },
        components: {
            Trumbowyg
        }
    }
</script>

<style>
    blockquote {
        background: #f9f9f9!important;
        border-left: 10px solid #ccc!important;
        margin: 1.5em 10px!important;
        padding: 0.5em 10px!important;
        quotes: "\201C""\201D""\2018""\2019"!important;
    }

    blockquote p {
        display: inline!important;
    }
</style>
