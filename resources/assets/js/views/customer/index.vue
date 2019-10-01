<template>
<div>
<div class="panel panel-default">
<div class="panel-heading">
<span class="panel-title">{{title}}</span>
	<div align="right">
<router-link to="/customer/invoice"><button class="btn btn-info btn-sm">Invoices</button></router-link>
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
		<td>{{ classe.company}}</td>
		<td>{{ classe.email}}</td>
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
                            <label for="company">Company:</label>
                            <input type="text" name="company" id="company" placeholder="company" class="form-control"
                                   v-model="classe.company">
                                   <span v-if="errors.company" class="alert-danger">{{errors.company[0]}}</span>
                        </div>
                        <div class="form-group ">
                            <label for="phone">Phone:</label>
                            <input type="number" name="phone" id="phone" placeholder="phone" class="form-control"
                                   v-model="classe.phone">
                                   <span v-if="errors.phone" class="alert-danger">{{errors.phone[0]}}</span>
                        </div>
                        <div class="form-group ">
                            <label for="email">Email:</label>
                            <input type="text" name="email" id="email" placeholder="email" class="form-control"
                                   v-model="classe.email">
                                   <span v-if="errors.email" class="alert-danger">{{errors.email[0]}}</span>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" name="address" id="address" placeholder="address" class="form-control"
                                   v-model="classe.address">
                                   <span v-if="errors.address" class="alert-danger">{{errors.address[0]}}</span>
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
                            <label for="company">Company:</label>
                            <p v-text="classe.company"></p>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <p v-text="classe.email"></p>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <p v-text="classe.phone"></p>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <p v-text="classe.address"></p>
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
                            <label for="company">Company:</label>
                            <input type="text" name="company" placeholder="company" class="form-control"
                                   v-model="update_classe.company">
                                   <span v-if="errors.company" class="alert-danger">{{errors.company[0]}}</span>
                        </div>
                        <div class="form-group">
                            <label for="phone">phone:</label>
                            <input type="number" name="phone" placeholder="phone" class="form-control"
                                   v-model="update_classe.phone">
                                   <span v-if="errors.phone" class="alert-danger">{{errors.phone[0]}}</span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" placeholder="email" class="form-control"
                                   v-model="update_classe.email">
                                   <span v-if="errors.email" claddressass="alert-danger">{{errors.email[0]}}</span>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" name="address"  class="form-control" placeholder="Address"
                                   v-model="update_classe.address">
                                   <span v-if="errors.address" class="alert-danger">{{errors.address[0]}}</span>
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
	name: 'Customers',
	data(){
		return{
            showFilter: false,
			title: 'Customers',
			source: 'http://localhost/stock/public/api/customer',
            classe: {      
                    name: '',
                    company: '',
                    email: '',
                    phone: '',
                    address:''
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
				{title: 'Company', key: 'company', sort: true},
				{title: 'Name', key: 'name', sort: true},
				{title: 'Email', key: 'email', sort: true}
			],

			filter: [
				'id', 'company', 'name', 'email', 'phone', 'address'
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
  					return `http://localhost/stock/public/api/customer?column=${p.column}&direction=${p.direction}&per_page=${p.per_page}&page=${p.page}
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
                axios.post('http://localhost/stock/public/api/customer', {
                   name: classe.name,
                    company: classe.company,
                    email: classe.email,
                    phone: classe.phone,
                    address: classe.address,
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
                this.classe.company = '';
                this.classe.email = '';
                this.classe.phone = '';
                this.classe.address = '';;
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
                axios.patch('http://localhost/stock/public/api/customer/' + update_classe.id, {
                   
                    name: update_classe.name,
                    company: update_classe.company,
                    phone: update_classe.phone,
                    email: update_classe.email,
                    address: update_classe.address,
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
 
                    axios.delete('http://localhost/stock/public/api/customer/' + classe.id)
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
