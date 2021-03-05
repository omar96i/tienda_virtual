<template>
    <div class="container mt-5" v-if="type=='insert'">
        <hr>
        <form @submit.prevent="action">
            <h4>Add category</h4>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Name category</label>
                <div class="col-sm-10">
                    <input type="text" @click="change" class="form-control" v-model="insert_category.name" placeholder="Name...">
                </div>
            </div>
            <div :class="['alert', color]" v-if="aux" role="alert">
                {{ msg }}
            </div>
            <button class="btn btn-success" type="submit">Confirm</button>
        </form>
        <hr>
    </div>
    <div v-else>
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="action">
                            <h4>Edit category</h4>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name category</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" v-model="category.name" >
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['category', 'type'],
    data(){
        return{
            insert_category: {
                name: ''
            },
            color: '',
            aux: false,
            msg: ''
        }
    },

    methods:{
        async action(){
            if(this.type == "insert"){
                axios.post(`/Category/store`, this.insert_category).then(res=>{
                    if(res.data.saved){
                        this.insert_category.name = ""
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
            }else{
                var items = this.category
                axios.post(`/Category/update/${this.category.id}`, items).then(res=>{
                    $("#modalEdit").modal('hide');
                })
            }

		},
        change(){
            if(this.aux){
                this.aux = false;
            }
        }
    }
}
</script>
