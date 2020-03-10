<template>
    <div>
        <div class="form-group">
            <label for="title">Title</label>
            <input v-model="title" type="text" name="title" id="title" class="form-control" required @keyup="makeSlug(title)">
        </div>

        <div class="form-group">
            <label for="slug">Article slug (used in links)</label>
            <input v-model="slug" type="text" name="slug" id="slug" class="form-control" required @change="makeSlug(slug)">

            <div>
                <small v-if="this.duplicateSlug" style="color:red">This slug is already in use</small>
            </div>

            <small>
                Example:
                <a href="#">{{ this.slugifiedUrl }}</a>
            </small>
        </div>
    </div>
</template>

<script>
    import slugify from 'slugify';

    export default {
        props: ['article'],
        data() {
            return {
                title: this.article !== undefined ? this.article.title : '',
                slug: this.article !== undefined ? this.article.slug : '',
                baseUrl: `https://${window.location.host}/articles/`,
                slugifiedUrl: `https://${window.location.host}/articles/`,
                duplicateSlug: false,
                options: {
                    lower: true,
                    strict: true
                }
            }
        },
        mounted() {
            if (this.article !== undefined) {
                this.slugifiedUrl = this.baseUrl + this.slug;
            }

            const submitButtons = document.querySelectorAll('button[type="submit"]');

            submitButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    if (this.duplicateSlug) {
                        e.preventDefault();
                    }
                });
            })
        },
        methods: {
            makeSlug(source) {
                this.slug = slugify(source, this.options);
                this.slugifiedUrl = this.baseUrl + this.slug;

                this.checkForDuplicateSlugs();
            },
            checkForDuplicateSlugs: _.debounce(function () {
                const id = this.article !== undefined ? this.article.id : null;
                axios.post('/article/duplicate_slug', { slug: this.slug, id: id })
                    .then(res => this.duplicateSlug = res.data)
            }, 500)
        }
    }
</script>
