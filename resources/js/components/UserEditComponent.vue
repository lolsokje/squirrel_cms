<template>
    <div>
        <h3>Roles:</h3>
        <form action="#">
            <div v-for="role in roles" class="form-group">
                <label :for="role.id">{{ role.name }}</label>
                <input type="checkbox" :id="role.id" v-model="role.id">
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['user', 'roles'],
        data() {
            return {

            }
        },
        methods: {
            removeRole(roleId) {
                console.log(roleId);
            }
        }
    }
</script>

