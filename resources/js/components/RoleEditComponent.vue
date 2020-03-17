<template>
    <div>
        <table style="width:50%;margin: 30px 0">
            <thead>
            <tr>
                <th>Permission</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="permission in permissions">
                <td>{{ permission.name }}</td>
                <td>
                    <input type="checkbox" :id="permission.id" :checked="hasPermission(permission)">
                </td>
            </tr>
            </tbody>
        </table>

        <button class="btn btn-primary" @click="updatePermissions($event)">Update role</button>
    </div>
</template>

<script>
    export default {
        props: ['role', 'permissions'],
        methods: {
            hasPermission(permission) {
                return this.role.permissions.find(p => p.id === permission.id) !== undefined;
            },
            updatePermissions(event) {
                event.target.disabled = true;

                const permissions = [];
                document.querySelectorAll('input[type=checkbox]').forEach(permission => {
                    if (permission.checked) {
                        permissions.push(parseInt(permission.id));
                    }
                });

                axios.post(`/admin/roles/${this.role.name}/edit/permissions`, {
                    permissions: permissions
                })
                    .then(() => event.target.disabled = false);
            }
        }
    }
</script>
