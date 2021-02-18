<template>
<div>
    <div class="col-md-12 ">
        <div class="row ">

            <div class="col-sm-6">
                <validation-errors v-if="validationErrors"
                                   :errors="validationErrors"
                >
                </validation-errors>
                <h3 v-if="edit === false">Добавить Item</h3>
                <h3 v-if="edit === true">Редактировать Item</h3>
                <form @submit.prevent="addItem()" class="mb-4">
                    <div class="form-group">
                        <label for="title">Название</label>
                        <input v-model="item.name" type="text" class="form-control" id="title" >
                    </div>
                    <div v-if="edit === true" class="form-group">
                        <label for="key">Key</label>
                        <input v-model="item.key" type="text" class="form-control" id="key" >
                    </div>

                    <button v-if="edit === false" type="submit" class="btn btn-primary">Добавить</button>
                    <button v-if="edit === true" type="submit" class="btn btn-success">Сохранить Изменения</button>
                    <button v-if="edit === true" type="button"
                            @click="deleteForever(item.id)"
                            class="btn btn-danger ml-5">Удалить Навсегда</button>
                </form>

            </div>
        </div>

            <h1 v-if="loading">загрузка...</h1>
            <h1 v-else class="mt-3">Items</h1>
            <table  class="table table-striped">

                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Key</th>
                    <th scope="col">Операции</th>

                </tr>
                </thead>
                <tbody>
                <tr v-for="item in items" :key="item.id">
                    <th >{{ item.id }}</th>

                    <td>{{ item.name }}</td>
                    <td>{{ item.key }}</td>

                    <td>
                        <div class="d-inline-block">
                            <button @click="editItem(item)" class="btn mt-2 btn-success">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button @click="deleteItem(item.id)" class="btn ml-2 mt-2 btn-danger">
                                <i class="far fa-times-circle"></i>
                            </button>
                        </div>
                    </td>

                </tr>

                </tbody>
            </table>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li :class="{disabled: ! pagination.prev_page_url}" class="page-item"
                    @click.prevent="getItems(pagination.prev_page_url)"
                >
                    <a class="page-link" href="#">Назад</a>
                </li>

                <li class="page-item disabled">
                    <a class="page-link" href="#">Страница {{ pagination.current_page }} из {{ pagination.last_page }}</a>
                </li>


                <li :class="{disabled: ! pagination.next_page_url}" class="page-item"
                    @click.prevent="getItems(pagination.next_page_url)" >
                    <a class="page-link" href="#">Следующая</a>
                </li>
            </ul>
        </nav>


    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            items: [],
            item: {
                id: '',
                name: '',
                key: ''
            },
            errored: false,
            loading: true,
            edit: false,
            pagination: {},
            validationErrors: ''
        }
    },
    mounted() {
        this.getItems()
    },
    methods: {
        getItems(page_url) {
            page_url = page_url || '/api/items'
            axios
            .get(page_url)
            .then(response => {
               this.items = response.data.data
               this.makePagination(response.data)
            })
            .catch(error => {
                console.log(error)
                this.errored = true;
            })
            .finally(() => this.loading = false)
        },
        makePagination(response) {
            let pagination = {
                current_page: response.current_page,
                last_page: response.last_page,
                prev_page_url: response.prev_page_url,
                next_page_url: response.next_page_url,
            }

            this.pagination = pagination
        },
        addItem() {
            if (this.edit === false)
            {
                //добавление
                axios
                    .post('/api/items', {
                        name: this.item.name,
                    })
                    .then(response => {
                        this.item.name = ''
                        this.getItems()
                    })
                    .catch(error => {
                        if (error.response.status === 422)
                        {
                            this.validationErrors = error.response.data.errors
                        }
                        console.log(error)
                    })
            }else {
                axios
                    .put(`api/items/${this.item.id}`, {
                        name: this.item.name,
                        key: this.item.key
                    })
                    .then(response => {
                        this.item.name = ''
                        this.item.key = ''
                        this.getItems()
                    })
                    .catch(error => {
                        if (error.response.status === 422)
                        {
                            this.validationErrors = error.response.data.errors
                        }
                        console.log(error)
                    })
                    .finally(() => this.edit = false);
            }

        },
        editItem(item) {
            this.edit = true
            this.item.id = item.id
            this.item.name = item.name
            this.item.key = item.key
        },
        deleteItem(id){
            axios
                .delete(`/api/items/${id}`)
                .then(response => {
                    this.getItems()
                })
                .catch(error => console.log(error))
                .finally(() => {
                    this.edit = false
                    this.item.name = ''
                });
        },
        deleteForever(id){
            axios
                .delete(`/deleteForever/${id}`)
                .then(response => {
                    this.item.name = ''
                    this.getItems()
                })
                .catch(error => console.log(error))
                .finally(() => {this.edit = false})
        },
    }
}
</script>

<style scoped>

</style>
