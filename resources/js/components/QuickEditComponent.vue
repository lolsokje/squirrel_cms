<template>
    <select name="action" id="action" @change="parseSelection($event)">
        <option value="">Select</option>
        <option value="delete">Delete</option>
        <option value="edit">Edit</option>
    </select>
</template>

<script>
    export default {
        props: ['article'],
        methods: {
            parseSelection(event) {
                const action = event.target.value;

                if (!action) return;

                if (action === 'edit') {
                    this.edit()
                } else if (action === 'delete') {
                    this.delete(event.target);
                }
            },
            edit() {
                window.location.href = `articles/${this.article.id}/edit`;
            },
            delete(target) {
                axios.delete(`articles/${this.article.id}`);

                const tr = target.closest('tr');
                tr.parentNode.removeChild(tr);
            }
        }
    }
</script>
