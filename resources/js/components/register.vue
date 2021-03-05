<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Register User</h5>
                        <form method="post" @submit.prevent="register">
                            <div class="form-label-group">
                                <input type="text" id="name" class="form-control" placeholder="Name..." v-model="user.name" required autofocus>
                                <label for="name">Name</label>
                            </div>
                            <div class="form-label-group">
                                <input type="email" id="inputEmail" class="form-control" placeholder="Email address..." v-model="user.email" required autofocus>
                                <label for="inputEmail">Email address</label>
                            </div>

                            <div class="form-label-group">
                                <input type="password" id="inputPassword" class="form-control" placeholder="Password..." v-model="user.password" required>
                                <label for="inputPassword">Password</label>
                            </div>
                            <div class="form-label-group">
                                <input type="password" id="inputRepeatPassword" class="form-control" placeholder="Repeat Password..." v-model="password" required>
                                <label for="inputRepeatPassword">Repeat password</label>
                            </div>
                            <div class="alert alert-success" v-if="status" role="alert">
                            Usuario registrado!
                            </div>
                            <div class="alert alert-danger" v-if="status_error" role="alert">
                            Error al ingreso de los datos
                            </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Confirm</button>
                            <hr class="my-4">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['type'],
    data(){
        return{
            user:{
                name : '',
                email: '',
                password: ''
            },
            password: '',
            status: false,
            status_error: false
        }
    },
    methods:{
        async register(){
            if(this.password == this.user.password){
                axios.post(`/register_user/${this.type}`, this.user).then(res=>{
                    if(res.data.saved){
                        this.user.name = ''
                        this.user.email = ''
                        this.user.password = ''
                        this.password = ''
                        this.status = true
                        this.status_error = false
                    }else{
                        this.status = false
                        this.status_error = true
                    }
                }).catch(error=>{

                });
            }else{
                this.user.password = ''
                this.password = ''
                this.status = false
                this.status_error = true
            }

		}
    }
}
</script>
