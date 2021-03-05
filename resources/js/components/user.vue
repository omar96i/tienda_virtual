<template>
    <div class="container-fluid" >
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>

                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in users" :key="index">
                    <th scope="row">{{ (index+1) }}</th>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.role_user[0] }}</td>
                    <td>
                        <button class="btn btn-info mr-2">Edit</button>
                        <button class="btn btn-danger" @click="borrar(user, index)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
    </div>
</template>
<script>
export default {
    props:['users'],
    methods:{
        async borrar(user, index){
            axios.get(`/User/delete/${user.id}`).then(res=>{
                console.log(res.data)
            })
        }
    }
}
</script>
