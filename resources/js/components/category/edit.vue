<template>
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
                    <form @submit.prevent="edit">
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
</template>
<script>
export default {
    props: ['category'],
    data(){
        return{
            items:{

            }
        }
    },
    methods:{
        async edit(){
            this.items = this.category
			axios.post(`/Category/update/${this.category.id}`, this.items).then(res=>{
                $("#modalEdit").modal('hide');
			})
		},
    }

}
</script>
