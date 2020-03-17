<template>
    <div>
        <h2>Roles:</h2>
        <ul>
            <li v-for="role in roles">
                <input type="checkbox" :id="role.id" :checked="hasRole(role)">
                <label :for="role.id">{{ role.name }}</label>
            </li>
        </ul>

        <button class="btn btn-primary" @click="saveRoles($event)">Update roles</button>
    </div>
</template>

<script>
    export default {
        props: ['user', 'roles'],
        methods: {
            hasRole (role) {
                return this.user.roles.find(r => r.id === role.id) !== undefined;
            },
            saveRoles(event) {
                event.target.disabled = true;
                const roles = [];
                document.querySelectorAll('input[type=checkbox]').forEach(input => {
                    if (input.checked) {
                        roles.push(parseInt(input.id));
                    }
                });

                axios.post(`/admin/users/${this.user.login_name}/edit/roles`, {
                    roles: roles
                })
                    .then(() => event.target.disabled = false);
            }
        }
    }
</script>

