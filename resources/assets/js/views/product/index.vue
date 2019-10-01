<template>
<div>
<div class="panel panel-default">
<div class="panel-heading">
<span class="panel-title">{{title}}</span>
	<div align="right">
<button class="btn btn-info btn-sm" >Pdf</button>
<button class="btn btn-info btn-sm">Excel</button>
<button class="btn btn-info btn-sm" @click="initAddTask()">Create</button>
	<button class="btn btn-default btn-sm" @click="showFilter = !showFilter">Search</button>

	</div>
	</div>
	<div class="panel-body">
	<div class="filter xp" v-if="showFilter">
			<div class="filter-column">

				<select class="form-control" v-model="params.search_column">
					<option v-for="column in filter" :value="column">{{column}}</option>

				</select>
			</div>
			<div class="filter-operator">
				<select class="form-control" v-model="params.search_operator">
					<option v-for="(value, key) in operators" :value="key">{{value}}</option>
				</select>
			</div>
			<div class="filter-input">
					<input type="text" class="form-control" v-model="params.search_query_1" 
					@keyup.enter="fetchData()" placeholder="search">

			</div>

			<div class="filter-input" v-if="params.search_operator === 'between'">
					<input type="text" class="form-control" v-model="params.search_query_2"
					 @keyup.enter="fetchData()" placeholder="search">

			</div>

			<div class="filter-btn">
				<button @click="fetchData()" class="btn btn-primary btn-sm btn-block">Filter</button>
				</div>
			<div class="filter-btn">
				<button @click="reseto()" class="btn btn-default btn-sm btn-block">Reset</button>
			</div>
		</div>
		<table class="table table-striped">
		<thead>
		<tr>
			<th v-for="item in thead">
			<div class="dataviewer-th" @click="sort(item.key)" v-if="item.sort">
				<span>{{item.title}}</span>
				<span v-if="params.column === item.key">
						<span v-if="params.direction === 'asc'">&#x25B2;</span>
						<span v-else>&#x25BC;</span>
				 </span>
			</div>
			<div v-else>
				<span>{{item.title}}</span>

			</div>
			</th>
		</tr>
		</thead>
	<tbody>
	<tr v-for="classe in model.data">
		<td>{{ classe.id}}</td>
		<td>{{ classe.name}}</td>
		<td>{{ classe.description}}</td>
		<td>{{ classe.qty}}</td>
		<td>
 <button @click="viewdata(classe)" class="btn btn-info btn-xs">view</span></button>
 <button @click="initUpdate(classe)" class="btn btn-success btn-xs">edit</span></button>
 <button @click="deleteTask(classe)" class="btn btn-danger btn-xs">delete</span></button>
 </td>
 </tr>
</tbody>

		</table>
<div class="panel-footer pagiantion-footer xp">
<div class="pagination-item">
	<span>per page</span>
	<select v-model="params.per_page" @change="fetchData()">
		<option>7</option> 
		<option>10</option> 
		<option>25</option> 
		<option>50</option> 
	</select> 

</div>
<div class="pagination-item">
<small>Showing {{model.from}} - {{model.to}} of {{model.total}}</small>
</div>
<div class="pagination-item">
	<small>Current page:</small>
	<input type="text" class="pagination-input" v-model="params.page"
	@keyup.enter="fetchData()">
	<small>of {{model.last_page}}</small>
</div>
<div class="pagination-item">
		<button @click="prev()" class="btn btn-default btn-sm">prev</button>
		<button @click="next()" class="btn btn-default btn-sm">Next</button>


</div>
</div>


</div></div>
<div class="modal fade" tabindex="-1" role="dialog" id="add_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add New Task</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group ">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                                   v-model="classe.name">
                                   <span v-if="errors.name" class="alert-danger">{{errors.name[0]}}</span>
                        </div>
                        <div class="form-group ">
                            <label for="description">Description:</label>
                            <input type="text" name="description" id="description" placeholder="description" class="form-control"
                                   v-model="classe.description">
                                   <span v-if="errors.description" class="alert-danger">{{errors.description[0]}}</span>
                        </div>
                        
                        <div class="form-group ">
                            <label for="type">Type:</label>
                            <input type="text" name="type" id="type" placeholder="type" class="form-control"
                                   v-model="classe.type">
                                   <span v-if="errors.type" class="alert-danger">{{errors.type[0]}}</span>
                        </div>
                        <div class="form-group ">
                            <label for="qty">Quantity:</label>
                            <input type="number" name="qty" id="qty" placeholder="qty" class="form-control"
                                   v-model="classe.qty">
                                   <span v-if="errors.qty" class="alert-danger">{{errors.qty[0]}}</span>
                        </div>
                        <div class="form-group ">
                            <label for="price1">Price 1:</label>
                            <input type="number" name="price1" id="price1" placeholder="price1" class="form-control"
                                   v-model="classe.price1">
                                   <span v-if="errors.price1" class="alert-danger">{{errors.price1[0]}}</span>
                        </div>
                        <div class="form-group ">
                            <label for="price2">Price 2:</label>
                            <input type="number" name="price2" id="price2" placeholder="price2" class="form-control"
                                   v-model="classe.price2">
                                   <span v-if="errors.price2" class="alert-danger">{{errors.price2[0]}}</span>
                        </div>
                        <div class="form-group ">
                            <label for="price3">Price 3:</label>
                            <input type="number" name="price3" id="price3" placeholder="price3" class="form-control"
                                   v-model="classe.price3">
                                   <span v-if="errors.price3" class="alert-danger">{{errors.price3[0]}}</span>
                        </div>
                        <div class="form-group ">
                            <label for="cost">Cost:</label>
                            <input type="number" name="cost" id="cost" placeholder="cost" class="form-control"
                                   v-model="classe.cost">
                                   <span v-if="errors.cost" class="alert-danger">{{errors.cost[0]}}</span>
                        </div>
                     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="createTask(classe)" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" tabindex="-1" role="dialog" id="view_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">View data</h4>
                    </div>
                    <div class="modal-body">
 
                       <div class="form-group">
                            <label for="name">Name:</label>
                            <p v-text="classe.name"></p>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <p v-text="classe.description"></p>
                        </div>
                        <div class="form-group">
                            <label for="type">Type:</label>
                            <p v-text="classe.type"></p>
                        </div>
                        <div class="form-group">
                            <label for="price1">price 1:</label>
                            <p v-text="classe.price1"></p>
                        </div>
                        <div class="form-group">
                            <label for="price2">price 2:</label>
                            <p v-text="classe.price2"></p>
                        </div>
                        <div class="form-group">
                            <label for="price3">price 3:</label>
                            <p v-text="classe.price3"></p>
                        </div>
                        <div class="form-group">
                            <label for="cost">cost:</label>
                            <p v-text="classe.cost"></p>
                        </div>
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" tabindex="-1" role="dialog" id="update_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Task</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" placeholder="Name" class="form-control"
                                   v-model="update_classe.name">
                                   <span v-if="errors.name" class="alert-danger">{{errors.name[0]}}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text" name="description" placeholder="description" class="form-control"
                                   v-model="update_classe.description">
                                   <span v-if="errors.description" class="alert-danger">{{errors.description[0]}}</span>
                        </div>
                        <div class="form-group">
                            <label for="type">Type:</label>
                            <input type="text" name="type" placeholder="type" class="form-control"
                                   v-model="update_classe.type">
                                   <span v-if="errors.type" claddressass="alert-danger">{{errors.type[0]}}</span>
                        </div>
                        <div class="form-group">
                            <label for="price1">price 1:</label>
                            <input type="number" name="price1" placeholder="price1" class="form-control"
                                   v-model="update_classe.price1">
                                   <span v-if="errors.price1" class="alert-danger">{{errors.price1[0]}}</span>
                        </div>
                        <div class="form-group">
                            <label for="price2">price 2:</label>
                            <input type="number" name="price2" placeholder="price2" class="form-control"
                                   v-model="update_classe.price2">
                                   <span v-if="errors.price2" class="alert-danger">{{errors.price2[0]}}</span>
                        </div>
                        <div class="form-group">
                            <label for="price3">price 3:</label>
                            <input type="number" name="price3" placeholder="price3" class="form-control"
                                   v-model="update_classe.price3">
                                   <span v-if="errors.price3" class="alert-danger">{{errors.price3[0]}}</span>
                        </div>
                        <div class="form-group">
                            <label for="cost">Cost:</label>
                            <input type="number" name="cost" placeholder="cost" class="form-control"
                                   v-model="update_classe.cost">
                                   <span v-if="errors.cost" class="alert-danger">{{errors.cost[0]}}</span>
                        </div>
                                               
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="updateTask(update_classe)" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        </div>
</template>
<script>

  		import Vue from 'vue'
  		import axios from 'axios'
     import router from 'vue-router'

export default {
	name: 'Products',
	data(){
		return{
            showFilter: false,
			title: 'Product List',
			source: 'http://localhost/stock/public/api/product',
            classe: {      
                    name: '',
                    description: '',
                    type: '',
                    price1: '',
                    price2: '',
                    price3: '',
                    cost: ''
                },  
            
            model:{
                data:[],
            }, 
            errors:[],
            update_classe:{},     
			 params:{
  					 	page: 1,
						column: 'id',
						direction: 'desc',
						per_page:7,
						search_column: 'id',
  						search_operator:'equal_to',
  						search_query_1:'',
  						search_query_2:'',
						router:{},

  					},
			thead:[
				{title: 'ID', key: 'id', sort: true},
				{title: 'Name', key: 'name', sort: true},
				{title: 'Description', key: 'description', sort: true},
				{title: 'Quantity', key: 'qty', sort: true}
			],

			filter: [
				'id', 'name', 'description', 'qty', 'price1', 'price2', 'price3', 'cost'
			],
		
        operators:{
  						equal_to: '=',
  						not_equal: '<>',
  						less_than: '<',
  						greater_than: '>',
  						less_than_or_equal_to: '<=',
  						greater_than_or_equal_to: '>=',
  						in: 'IN',
  						not_in: 'NOT_IN',
  						like: 'LIKE',
  						between: 'BETWEEN'

  					}
        }
	},
    
			  beforeMount(){
				this.fetchData();
			},
			  
		 methods: {
             next(){
  					if(this.model.next_page_url){
						this.params.page++
						this.fetchData()
					}
				},
  				prev(){ 
  					if(this.model.prev_page_url){
						this.params.page--
						this.fetchData()
					}
  				},
				  
				 reseto()
					{ 	
						
  					var p = this.params		
						p.page = 1,
								p.column = 'id',
								p.direction = 'desc',
								p.per_page = 7,
								p.search_column = 'id',
								p.search_operator = 'equal_to',
								p.search_query_1 = '',
								p.search_query_2 = ''
								
  					this.fetchData()
				},
                
  				sort(column){
  					if(column === this.params.column){
  						if(this.params.direction === 'desc'){
  							this.params.direction = 'asc'

  						} else{
  							this.params.direction = 'desc'
  						}
  					}else{
  						this.params.column = column
  						this.params.direction = 'asc'
  					}
  					this.fetchData()
  				},
  				fetchData(){
  					var vm = this
  					axios.get(this.buildURL())

  					.then(function(response){
  						Vue.set(vm.$data, 'model', response.data.model)
  					})
  					.catch(function(error){
  						console.log(error)
  					})
  				},
  				buildURL(){
  					var p = this.params
  					return `http://localhost/stock/public/api/product?column=${p.column}&direction=${p.direction}&per_page=${p.per_page}&page=${p.page}
  					&search_column=${p.search_column}&search_operator=${p.search_operator}&search_query_1=${p.search_query_1}
					  &search_query_2=${p.search_query_2}`
  				},

             
            initAddTask()
            {
                    this.errors = [];
                $("#add_task_model").modal("show");
            },
            createTask(classe)
            {
                axios.post('http://localhost/stock/public/api/product', {
                   name: classe.name,
                    description: classe.description,
                    type: classe.type,
                    price1: classe.price1,
                    price2: classe.price2,
                    price3: classe.price3,
                    cost: classe.cost,
                    qty: classe.qty,
                })
                    .then(response => {
 
                        this.reset();
                        
                       this.model.data.push(response.data.classe);
 
                        $("#add_task_model").modal("hide");
 
                    })
                    .catch(error => {
                    this.errors = [];
                    if (error.response.status = 422){
                        this.errors = error.response.data;
                    }
                    });
            },
            reset()
            {
                this.classe.name = '';
                this.classe.description = '';
                this.classe.type = '';
                this.classe.price1 = '';
                this.classe.price2 = '';
                this.classe.price3 = '';
                this.classe.cost = '';
                this.classe.qty = '';
            },
            
               viewdata(classe)
            {
                $("#view_task_model").modal("show");
                this.classe = classe;
            },
               initUpdate(classe)
            {
               
                $("#update_task_model").modal("show");
                this.update_classe = classe;
            },
            updateTask(update_classe)
            {
                axios.patch('http://localhost/stock/public/api/product/' + update_classe.id, {
                   
                    name: update_classe.name,
                    description: update_classe.description,
                    type: update_classe.type,
                    qty: update_classe.qty,
                    price1: update_classe.price1,
                    price2: update_classe.price2,
                    price3: update_classe.price3,
                    cost: update_classe.cost,
                })
                    .then(response => {
                         
                        $("#update_task_model").modal("hide");
                    })
                    .catch(error => {
                    this.errors = [];
                    if (error.response.status = 422){
                        this.errors = error.response.data;
                    }
                    });
            },
			deleteTask(classe)
            {
                let conf = confirm("Are you ready to delete : " + classe.name + " details?");
                if (conf === true) {
 
                    axios.delete('http://localhost/stock/public/api/product/' + classe.id)
                        .then(response => {classe
 
                           
                           this.model.splice(classe, 1);
 
 
                        })
                        .catch(error => {
 
                        });
                }
            },
        
            
         }

}
</script>
