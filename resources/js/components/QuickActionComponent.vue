<template>
    <div>
        <button class="btn btn-primary" @click="toggleQuickActions($event)">
            <span>Quick Actions</span>
            |
            <i class="fa fa-caret-down"></i>
        </button>

        <div class="quick-actions">
            <ul>
                <li @click="edit">Edit</li>
                <li v-show="draft" @click="publish($event)">Publish</li>
                <li v-show="!deleted" @click="remove($event)">Delete</li>
                <li v-show="deleted && !draft" @click="republish($event)">Re-publish</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['article'],
        data() {
            return {
                deleted: this.article.deleted_at !== null,
                draft: this.article.status.name === 'draft'
            }
        },
        methods: {
            toggleQuickActions(event) {
                const wrapper = event.target.closest('div');
                const quickActions = wrapper.querySelector('.quick-actions');

                this.hideAllQuickActionDropdowns(quickActions);

                quickActions.classList.contains('open') ? quickActions.classList.remove('open') : quickActions.classList.add('open');
            },
            edit() {
                window.location.href = `articles/${this.article.id}/edit`;
            },
            publish(event) {
                axios.put(`articles/${this.article.id}/publish`);

                this.changeStatusText(event, 'Published');
                this.draft = false;
            },
            remove(event) {
                axios.delete(`articles/${this.article.id}`);

                this.changeStatusText(event, 'Deleted');
                this.deleted = true;
            },
            republish(event) {
                axios.put(`articles/${this.article.id}/republish`);

                this.changeStatusText(event, 'Published');
                this.deleted = false;
            },
            changeStatusText(event, text) {
                const tr = event.target.closest('tr');
                tr.querySelector('.status').innerText = text;
                this.hideAllQuickActionDropdowns();
            },
            hideAllQuickActionDropdowns(currentQuickAction = null) {
                const allQuickActions = document.querySelectorAll('.quick-actions');
                allQuickActions.forEach((el) => {
                    if (currentQuickAction !== null) {
                        if (el !== currentQuickAction) {
                            el.classList.remove('open');
                        }
                    } else {
                        el.classList.remove('open');
                    }
                });
            }
        }
    }
</script>

<style>
    .quick-actions {
        box-sizing: border-box;
        width: 125px;
        position: absolute;
        background-color: white;
        display: none;
        border: 1px solid #CCCCCC;
    }

    .open {
        display: block;
    }

    .quick-actions ul {
        padding: 5px;
    }

    .quick-actions li {
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .quick-actions li:hover {
        cursor: pointer;
    }
</style>
