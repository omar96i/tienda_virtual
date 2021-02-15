<template>
    <div class="container mt-5">
        <hr>
        <form @submit.prevent="register">
            <h4>Add category</h4>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Name category</label>
                <div class="col-sm-10">
                    <input type="text" @click="change" class="form-control" v-model="category.name" placeholder="Name...">
                </div>
            </div>
            <div :class="['alert', color]" v-if="aux" role="alert">
                {{ msg }}
            </div>
            <button class="btn btn-success" type="submit">Confirm</button>
        </form>
        <hr>
    </div>
</template>
<script>
export default {
    data(){
        return{
            category: {
                name: ''
            },
            color: '',
            aux: false,
            msg: ''
        }
    },

    methods:{
        async register(){
			axios.post(`/register_category`, this.category).then(res=>{
                if(res.data.saved){
                    this.category.name = ""
                    this.color = "alert-success"
                    this.aux = true
                    this.msg = "Category added!"
                    this.$root.$children[1].categories_i.push(res.data.category);
                }else{
                    this.category.name = ""
                    this.color = "alert-danger"
                    this.msg = "Error!"
                    this.aux = true
                }
			})
		},
        change(){
            if(this.aux){
                this.aux = false;
            }
        }
    }
}
</script>
