<template>
    <div>
        <div id="article-filter">
            <label for="text"></label><input @keyup="fetchArticles" type="text" id="text" name="text" placeholder="Filter by title or body content" class="article-filter" v-model="params.text">

            <div id="selects">
                <label for="category"></label><select @change="fetchArticles" class="styled-select article-filter" name="category" id="category" v-model="params.category">
                    <option value="">Filter by category</option>
                    <option v-for="category in categories" v-bind:value="category.id">{{ category.name }}</option>
                </select>

                <label for="editor"></label><select @change="fetchArticles" class="styled-select article-filter" name="editor" id="editor" v-model="params.editor">
                    <option value="">Filter by editor</option>
                    <option v-for="{display_name, twitch_id} in editors" v-bind:value="twitch_id">{{ display_name }}</option>
                </select>

                <label for="status"></label><select @change="fetchArticles" class="styled-select article-filter" name="status" id="status" v-model="params.status">
                    <option value="">Filter by status</option>
                    <option v-for="status in statuses" v-bind:value="status.id">{{ statusName(status.name) }}</option>
                </select>
            </div>
        </div>

        <table class="table-border">
            <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Author</th>
                <th>Created</th>
                <th>Last edited</th>
                <th>Status</th>
                <th>Quick Actions</th>
            </tr>
            </thead>
            <tbody id="articles">
            <tr v-for="article in this.articleList">
                <td>
                    <a :href="article['articleUrl']">{{ article.title }}</a>
                </td>
                <td>{{ article.category.name }}</td>
                <td>{{ article.user["display_name"]}}</td>
                <td>{{ article["createdAtForHumans"] }}</td>
                <td>{{ article["updatedAtForHumans"] }}</td>
                <td class="status">{{ statusName(article.status.name) }}</td>
<!--                <td><quick-action :article="article"></quick-action></td>-->
                <td>
                    <div>
                        <button class="btn btn-primary" @click="toggleQuickActions($event, article)">
                            <span>Quick Actions</span>
                            |
                            <i class="fa fa-caret-down"></i>
                        </button>

                        <div class="quick-actions">
                            <ul>
                                <li @click="edit(article)">Edit</li>
                                <li v-show="article.status.name === 'draft'" @click="publish($event, article)">
                                    Publish <i v-if="publishing" class="fa fa-spinner fa-pulse"></i>
                                </li>
                                <li v-show="article.status.name !== 'deleted'" @click="remove($event, article)">
                                    Delete <i v-if="removing" class="fa fa-spinner fa-pulse"></i>
                                </li>
                                <li v-show="article.status.name === 'deleted' && article.status.name !== 'draft'" @click="republish($event, article)">
                                    Re-publish <i v-if="republishing" class="fa fa-spinner fa-pulse"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['articles', 'editors', 'categories', 'statuses'],
        data() {
            return {
                articleList: this.articles,
                publishing: false,
                removing: false,
                republishing: false,
                params: {
                    category: '',
                    editor: '',
                    text: '',
                    status: ''
                }
            }
        },
        methods: {
            statusName(name) {
                return name.charAt(0).toUpperCase() + name.slice(1);
            },
            fetchArticles() {
                const query = {};

                for (const param in this.params) {
                    if (this.params[param] !== '') {
                        query[param] = this.params[param];
                    }
                }

                const queryParams = Object.keys(query).map(key => key + '=' + query[key]).join('&');
                const url = `filters/articles?${queryParams}`;

                axios.get(url)
                .then((response) => {
                    this.articleList = response.data;
                    this.$forceUpdate();
                });
            },
            toggleQuickActions(event) {
                const wrapper = event.target.closest('div');
                const quickActions = wrapper.querySelector('.quick-actions');

                this.hideAllQuickActionDropdowns(quickActions);

                quickActions.classList.contains('open') ? quickActions.classList.remove('open') : quickActions.classList.add('open');
            },
            edit(article) {
                window.location.href = `articles/${article.id}/edit`;
            },
            publish(event, article) {
                this.publishing = true;
                axios.put(`articles/${article.id}/publish`)
                    .then((response) => {
                        this.handleRequestCallback(article, response);
                        this.publishing = false;
                    });
            },
            remove(event, article) {
                this.removing = true;
                axios.delete(`articles/${article.id}`)
                    .then((response) => {
                        this.handleRequestCallback(article, response);
                        this.removing = false;
                    });
            },
            republish(event, article) {
                this.republishing = true;
                axios.put(`articles/${article.id}/republish`)
                    .then((response) => {
                        this.handleRequestCallback(article, response);
                        this.republishing = false;
                    });
            },
            handleRequestCallback(article, response) {
                const index = this.articleList.indexOf(article);
                this.articleList[index] = response.data;
                this.hideAllQuickActionDropdowns();

                if (this.params.status !== '' && this.params.status !== response.data.status.id) {
                    this.articleList.splice(index, 1);
                }
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
