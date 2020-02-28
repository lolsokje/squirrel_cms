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
                <li @click="remove($event)">Delete</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['article'],
        methods: {
            toggleQuickActions(event) {
                const allQuickActions = document.querySelectorAll('.quick-actions');
                const wrapper = event.target.closest('div');
                const quickActions = wrapper.querySelector('.quick-actions');

                allQuickActions.forEach((el) => {
                    if (el !== quickActions) {
                        el.classList.remove('open');
                    }
                });

                quickActions.classList.contains('open') ? quickActions.classList.remove('open') : quickActions.classList.add('open');
            },
            edit() {
                window.location.href = `articles/${this.article.id}/edit`;
            },
            remove(event) {
                axios.delete(`articles/${this.article.id}`);

                const tr = event.target.closest('tr');
                tr.parentNode.removeChild(tr);
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
