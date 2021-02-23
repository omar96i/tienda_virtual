<template>
    <div class="container mt-5" >
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(category, index) in categories_i" :key="index">
                    <th scope="row">{{ (index+1) }}</th>
                    <td>{{ category.name }}</td>
                    <td>
                        <button class="btn btn-info mr-2" @click.prevent="asignar(category)" data-toggle="modal" data-target="#modalEdit">Edit</button>
                        <button class="btn btn-danger" @click.prevent="borrar(category, index)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <edit-category :category = items></edit-category>
    </div>
</template>
<script>
import EditCategory from './edit.vue';
export default {
    props: ['categories'],
    data(){
        return{
            categories_i:{

            },
            items:{

            }
        }
    },
    created(){
        this.categories_i = this.categories;
    },
    methods:{
        async borrar(category, index){
			axios.post(`/Category/delete/${category.id}`).then(res=>{
                if(res.data.status){
                    this.categories_i.splice(index, 1)
                }else{
                    console.log("Algo paso")
                }
			})
		},
        asignar(category){
            this.items = category
        }
    },
    components:{
        EditCategory
    }
}
</script>
