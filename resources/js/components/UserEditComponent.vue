<template>
    <div>
        <h3>Roles:</h3>
        <ul>
            <li v-for="role in this.user.roles">{{ role.name }} <i class="fa fa-minus-circle" @click="removeRole(role.id)"></i></li>
        </ul>
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

