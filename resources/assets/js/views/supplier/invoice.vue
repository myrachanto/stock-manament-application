<template>
<div>
<div class="panel panel-default">
<div class="panel-heading">
<span class="panel-title">{{title}}</span>
	<div align="right">
<button class="btn btn-info btn-sm" >Pdf</button>
<button class="btn btn-info btn-sm">Excel</button>
<router-link to="/supplier/invoice/create"><button class="btn btn-info btn-sm">New Invoice</button></router-link>
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
		<td>{{ classe.supplier.name}}/{{ classe.supplier.company}}</td>
		<td>{{ classe.due_date}}</td>
		<td>{{ classe.discount}}</td>
		<td>{{ classe.total}}</td>
		<td>
<router-link :to="'/supplier/invoice/' + classe.id"><button class="btn btn-info btn-xs">view</span></button></router-link>
 </td>

 </tr>
</tbody>

		</table>
		<div class="modal fade" tabindex="-1" role="dialog" id="view_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">View data</h4>
                    </div>
                    <div class="modal-body">
 
             
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
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

        </div>
</template>
<script>

  		import Vue from 'vue'
  		import axios from 'axios'
     import router from 'vue-router'

export default {
	name: 'SupplierInvoices',
	data(){
		return{
            showFilter: false,
			title: 'Suppliers Invoices',
			source: 'http://localhost/stock/public/api/sinvoice',
            model:{
                data:[],
            },    
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
				{title: 'Supplier', key: 'supplier_id', sort: true},
				{title: 'Due Date', key: 'due_date', sort: true},
				{title: 'Discount', key: 'discount', sort: true},
				{title: 'Amount', key: 'total', sort: true}
			],

			filter: [
				'id', 'supplier_id', 'due_date', 'discount', 'total', 'date'
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
			    viewdata(classe)
            {
                $("#view_task_model").modal("show");
                this.classe = classe;
            },
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
  					return `http://localhost/stock/public/api/sinvoice?column=${p.column}&direction=${p.direction}&per_page=${p.per_page}&page=${p.page}
  					&search_column=${p.search_column}&search_operator=${p.search_operator}&search_query_1=${p.search_query_1}
					  &search_query_2=${p.search_query_2}`
  				},
         }


             
           
}
</script>
